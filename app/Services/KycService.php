<?php

namespace App\Services;

use App\Http\Requests\StoreKycRequest;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\KycDocument;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KycService
{
    public function __construct(
        protected AuditLogService $auditLogService,
    ) {
    }

    public function storeKyc(StoreKycRequest $request, ?Authenticatable $user = null): Customer
    {
        return DB::transaction(function () use ($request, $user) {
            $customer = Customer::create([
                'first_name' => $request->string('first_name'),
                'last_name' => $request->string('last_name'),
                'email' => $request->string('email'),
                'email_hash' => Customer::hashEmail($request->string('email')),
                'phone' => $request->input('phone'),
                'business_phone' => $request->input('business_phone'),
                'date_of_birth' => $request->input('date_of_birth'),
                'nationality' => $request->input('nationality'),
                'business_type' => $request->input('business_type'),
                'trading_name' => $request->input('trading_name'),
                'company_name' => $request->input('company_name'),
                'company_number' => $request->input('company_number'),
                'nature_of_business' => $request->input('nature_of_business'),
                'bank_name_on_account' => $request->input('bank_name_on_account'),
                'bank_sort_code' => $request->input('bank_sort_code'),
                'bank_account_number' => $request->input('bank_account_number'),
                'created_by' => $user?->getAuthIdentifier(),
                'updated_by' => $user?->getAuthIdentifier(),
            ]);

            foreach (['trading_address' => 'trading', 'home_address' => 'home', 'registered_address' => 'registered'] as $key => $type) {
                $addressData = $request->input($key, []);
                if (!empty($addressData['line1'] ?? null)) {
                    CustomerAddress::create([
                        'customer_id' => $customer->id,
                        'type' => $type,
                        'line1' => $addressData['line1'] ?? null,
                        'line2' => $addressData['line2'] ?? null,
                        'line3' => $addressData['line3'] ?? null,
                        'city' => $addressData['city'] ?? null,
                        'state' => $addressData['state'] ?? null,
                        'postcode' => $addressData['postcode'] ?? null,
                        'country' => $addressData['country'] ?? null,
                    ]);
                }
            }

            $this->storeDocuments($request, $customer, $user);

            $this->auditLogService->log($user, $customer->id, 'kyc_submitted', [
                'email' => $customer->email,
            ]);

            return $customer;
        });
    }

    protected function storeDocuments(StoreKycRequest $request, Customer $customer, ?Authenticatable $user = null): void
    {
        $map = [
            'proof_id' => 'proof_id',
            'proof_bank' => 'proof_bank',
            'proof_address' => 'proof_address',
            'dl_front' => 'dl_front',
            'dl_back' => 'dl_back',
        ];

        foreach ($map as $inputName => $type) {
            $file = $request->file($inputName);
            if (!$file) {
                continue;
            }

            // We rely on Symfony's MIME type detection here, not on client-provided headers alone.
            $mimeType = $file->getMimeType();
            $size = $file->getSize();

            $randomName = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();
            $relativePath = $customer->id.'/'.$randomName;

            Storage::disk('secure_kyc')->putFileAs((string) $customer->id, $file, $randomName);

            KycDocument::create([
                'customer_id' => $customer->id,
                'type' => $type,
                'original_filename' => $file->getClientOriginalName(),
                'stored_filename' => $randomName,
                'disk' => 'secure_kyc',
                'path' => $relativePath,
                'mime_type' => $mimeType,
                'size' => $size,
                'uploaded_by' => $user?->getAuthIdentifier(),
            ]);
        }
    }
}
