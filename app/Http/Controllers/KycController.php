<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKycRequest;
use App\Mail\KycSubmittedMail;
use App\Models\Customer;
use App\Services\KycService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class KycController extends Controller
{
    public function __construct(
        protected KycService $kycService,
    ) {
    }

    public function create(): View
    {
        return view('kyc.form');
    }

    public function store(StoreKycRequest $request): RedirectResponse
    {
        $customer = $this->kycService->storeKyc($request, $request->user());

        $this->notifyAdmins($customer);

        return redirect()
            ->route('kyc.thankyou', $customer)
            ->with('status', 'KYC submitted successfully.');
    }

    /**
     * Email the configured admin address(es) that a new submission arrived.
     * A mail failure must never break the customer's submission.
     */
    protected function notifyAdmins(Customer $customer): void
    {
        $recipients = collect(explode(',', (string) config('kyc.notify_email')))
            ->map(fn ($email) => trim($email))
            ->filter()
            ->all();

        if (empty($recipients)) {
            return;
        }

        try {
            Mail::to($recipients)->send(new KycSubmittedMail($customer));
        } catch (\Throwable $e) {
            Log::error('KYC submission notification failed: '.$e->getMessage(), [
                'customer_id' => $customer->id,
            ]);
        }
    }

    public function thankyou(Customer $customer): View
    {
        return view('kyc.thankyou', [
            'customer' => $customer,
        ]);
    }
}
