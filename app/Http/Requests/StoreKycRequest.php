<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKycRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $fileRules = ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120']; // 5MB

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'business_phone' => ['required', 'string', 'max:50'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'nationality' => ['required', 'string', 'max:255'],

            'business_type' => ['required', 'string', 'max:255'],
            'trading_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_number' => ['required', 'string', 'max:100'],

            'nature_of_business' => ['required', 'string', 'max:2000'],

            'bank_name_on_account' => ['required', 'string', 'max:255'],
            'bank_sort_code' => ['required', 'string', 'max:20'],
            'bank_account_number' => ['required', 'string', 'max:34'],

            // Addresses
            'trading_address.line1' => ['required', 'string', 'max:255'],
            'trading_address.*' => ['nullable', 'string', 'max:255'],

            'home_address.line1' => ['nullable', 'string', 'max:255'],
            'home_address.*' => ['nullable', 'string', 'max:255'],

            'registered_address.line1' => ['required', 'string', 'max:255'],
            'registered_address.*' => ['nullable', 'string', 'max:255'],

            // Files - server side is the source of truth, including MIME verification via Symfony validator.
            'proof_id' => $fileRules,
            'proof_bank' => $fileRules,
            'proof_address' => array_replace($fileRules, [0 => 'required']),
            'dl_front' => array_replace($fileRules, [0 => 'required']),
            'dl_back' => array_replace($fileRules, [0 => 'required']),

            // GDPR: explicit consent to process KYC data is the lawful basis for this submission.
            'consent' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'consent.accepted' => 'You must confirm the declaration and consent to your data being processed before submitting.',
            'business_phone.required' => 'Please provide a business phone number.',
        ];
    }
}
