@extends('layouts.app')

@php
    $input = 'block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/25';
    $label = 'block text-sm font-medium text-slate-700 mb-1';
    $req = '<span class="text-rose-500">*</span>';
@endphp

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-4xl mx-auto px-4">

        {{-- Branded header --}}
        <header class="mb-6 rounded-2xl border border-slate-200 bg-white px-6 py-4 shadow-sm">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <img src="{{ asset('images/logo-switch.png') }}" alt="Switch&Save Business Services Ltd" class="h-10 w-auto">
                <span class="inline-flex w-fit items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-200">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    SSL Secured &amp; Encrypted
                </span>
            </div>
        </header>

        {{-- Title --}}
        <div class="mb-6 text-center">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">Customer Onboarding &amp; Identity Verification</h1>
            <p class="mt-2 mx-auto max-w-2xl text-sm text-slate-500 leading-relaxed">
                As an FCA-authorised business, Switch&amp;Save Business Services Ltd is required to verify the identity of every
                customer we work with. Please complete the form below and upload the requested documents — it only takes a few minutes.
            </p>
        </div>

        {{-- Trust strip --}}
        <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
            <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </span>
                <div>
                    <p class="text-xs font-semibold text-slate-800">Bank-grade encryption</p>
                    <p class="text-[11px] text-slate-500">Sent over a secure connection</p>
                </div>
            </div>
            <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </span>
                <div>
                    <p class="text-xs font-semibold text-slate-800">FCA authorised &amp; regulated</p>
                    <p class="text-[11px] text-slate-500">FRN 1052230</p>
                </div>
            </div>
            <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </span>
                <div>
                    <p class="text-xs font-semibold text-slate-800">GDPR compliant</p>
                    <p class="text-[11px] text-slate-500">Used only for verification</p>
                </div>
            </div>
        </div>

        {{-- Form card --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="h-1.5 bg-gradient-to-r from-blue-600 via-blue-500 to-emerald-500"></div>
            <div class="px-6 py-8 sm:px-9">

                @if (session('status'))
                    <div class="mb-6 flex items-start gap-2 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        <span class="mt-0.5 h-2 w-2 rounded-full bg-emerald-500"></span>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                        <p class="mb-1 font-semibold">Please check the following before submitting:</p>
                        <ul class="list-inside list-disc space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('kyc.store') }}" enctype="multipart/form-data" class="space-y-10">
                @csrf

                {{-- Personal Details --}}
                <section>
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <div>
                            <h2 class="text-base font-semibold text-slate-900">Personal Details</h2>
                            <p class="text-xs text-slate-500">Fields marked with <span class="text-rose-500">*</span> are required.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="{{ $label }}">First Name {!! $req !!}</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Last Name {!! $req !!}</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Email {!! $req !!}</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Phone {!! $req !!}</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Date of Birth {!! $req !!}</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Nationality {!! $req !!}</label>
                            <input type="text" name="nationality" value="{{ old('nationality') }}" class="{{ $input }}" required>
                        </div>
                    </div>
                </section>

                {{-- Business Details --}}
                <section class="border-t border-slate-100 pt-8">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                        </span>
                        <h2 class="text-base font-semibold text-slate-900">Business Details</h2>
                    </div>

                    <div class="mb-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="{{ $label }}">Business Phone Number {!! $req !!}</label>
                            <input type="text" name="business_phone" value="{{ old('business_phone') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Business Type {!! $req !!}</label>
                            <div class="mt-1.5 flex flex-wrap items-center gap-4 text-sm text-slate-700">
                                @foreach (['Sole Trader', 'Ltd', 'Partnership'] as $bt)
                                    <label class="inline-flex items-center gap-2">
                                        <input type="radio" name="business_type" value="{{ $bt }}" class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500" {{ old('business_type') === $bt ? 'checked' : '' }}>
                                        <span>{{ $bt }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                        <div>
                            <label class="{{ $label }}">Trading Name {!! $req !!}</label>
                            <input type="text" name="trading_name" value="{{ old('trading_name') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Registered Company Name {!! $req !!}</label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" class="{{ $input }}" required>
                            <p class="mt-1 text-[11px] text-slate-400">Only Companies House registered name.</p>
                        </div>
                        <div>
                            <label class="{{ $label }}">Company Number {!! $req !!}</label>
                            <input type="text" name="company_number" value="{{ old('company_number') }}" class="{{ $input }}" required>
                            <p class="mt-1 text-[11px] text-slate-400">Companies House registration number.</p>
                        </div>
                    </div>
                </section>

                {{-- Addresses --}}
                <section class="border-t border-slate-100 pt-8">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        <h2 class="text-base font-semibold text-slate-900">Addresses</h2>
                    </div>

                    <div class="space-y-6">
                        @foreach ([
                            ['key' => 'trading_address', 'title' => 'Trading Address', 'required' => true],
                            ['key' => 'home_address', 'title' => 'Home Address', 'required' => false],
                            ['key' => 'registered_address', 'title' => 'Company Registered Address', 'required' => true],
                        ] as $addr)
                            <div class="rounded-xl border border-slate-200 bg-slate-50/60 p-4">
                                <p class="mb-3 text-sm font-medium text-slate-700">{{ $addr['title'] }} @if($addr['required']) {!! $req !!} @endif</p>
                                <div class="space-y-3">
                                    <input class="{{ $input }}" type="text" name="{{ $addr['key'] }}[line1]" placeholder="Address Line 1" value="{{ old($addr['key'].'.line1') }}" @if($addr['required']) required @endif>
                                    <input class="{{ $input }}" type="text" name="{{ $addr['key'] }}[line2]" placeholder="Address Line 2 (optional)" value="{{ old($addr['key'].'.line2') }}">
                                    <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                                        <input class="{{ $input }}" type="text" name="{{ $addr['key'] }}[city]" placeholder="City" value="{{ old($addr['key'].'.city') }}">
                                        <input class="{{ $input }}" type="text" name="{{ $addr['key'] }}[postcode]" placeholder="Postal / Zip Code" value="{{ old($addr['key'].'.postcode') }}">
                                        <input class="{{ $input }}" type="text" name="{{ $addr['key'] }}[country]" placeholder="Country" value="{{ old($addr['key'].'.country') }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Bank Details --}}
                <section class="border-t border-slate-100 pt-8">
                    <div class="mb-5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                            </span>
                            <h2 class="text-base font-semibold text-slate-900">Bank Details</h2>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-emerald-700">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Encrypted at rest
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                        <div>
                            <label class="{{ $label }}">Name on Account {!! $req !!}</label>
                            <input type="text" name="bank_name_on_account" value="{{ old('bank_name_on_account') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Sort Code {!! $req !!}</label>
                            <input type="text" name="bank_sort_code" value="{{ old('bank_sort_code') }}" class="{{ $input }}" required>
                        </div>
                        <div>
                            <label class="{{ $label }}">Account Number {!! $req !!}</label>
                            <input type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" class="{{ $input }}" required>
                        </div>
                    </div>
                </section>

                {{-- Nature of Business --}}
                <section class="border-t border-slate-100 pt-8">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        </span>
                        <h2 class="text-base font-semibold text-slate-900">Nature of Business {!! $req !!}</h2>
                    </div>
                    <textarea name="nature_of_business" rows="4" class="{{ $input }}" placeholder="Please briefly describe what your business does and how funds will be used." required>{{ old('nature_of_business') }}</textarea>
                </section>

                {{-- Documents --}}
                <section class="border-t border-slate-100 pt-8">
                    <div class="mb-2 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            </span>
                            <h2 class="text-base font-semibold text-slate-900">Documents</h2>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-medium text-emerald-700">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Stored privately &amp; never shared
                        </span>
                    </div>
                    <p class="mb-5 text-xs text-slate-500">Upload clear copies of each document. Accepted formats: PDF, JPG, PNG (max 5MB each).</p>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach ([
                            ['name' => 'proof_id', 'label' => 'Proof of ID', 'required' => false],
                            ['name' => 'proof_bank', 'label' => 'Proof of Bank', 'required' => false],
                            ['name' => 'proof_address', 'label' => 'Proof of Address', 'required' => true],
                            ['name' => 'dl_front', 'label' => 'Driving Licence Front', 'required' => true],
                            ['name' => 'dl_back', 'label' => 'Driving Licence Back', 'required' => true],
                        ] as $doc)
                            <div class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/30">
                                <label class="mb-2 block text-xs font-medium text-slate-700">{{ $doc['label'] }} @if($doc['required']) {!! $req !!} @endif</label>
                                <input type="file" name="{{ $doc['name'] }}" accept=".pdf,.jpg,.jpeg,.png"
                                    class="block w-full text-xs text-slate-600 file:mr-3 file:cursor-pointer file:rounded-md file:border-0 file:bg-blue-600 file:px-3 file:py-2 file:text-xs file:font-medium file:text-white hover:file:bg-blue-700"
                                    @if($doc['required']) required @endif>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Declaration & consent --}}
                <section class="border-t border-slate-100 pt-8">
                    <div class="mb-3 flex items-center gap-3">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4"/><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </span>
                        <h2 class="text-base font-semibold text-slate-900">Declaration &amp; Consent</h2>
                    </div>
                    <label class="flex items-start gap-3 rounded-xl border border-slate-200 bg-slate-50/60 p-4 text-xs leading-relaxed text-slate-600">
                        <input type="checkbox" name="consent" value="1" class="mt-0.5 h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" {{ old('consent') ? 'checked' : '' }} required>
                        <span>
                            I confirm that the information provided is accurate and complete, and I consent to
                            <span class="font-medium text-slate-800">Switch&amp;Save Business Services Ltd</span> collecting and processing my
                            personal data and documents for the purpose of identity verification and anti-money-laundering (KYC) checks,
                            as described in the <a href="{{ route('privacy') }}" target="_blank" class="font-medium text-blue-600 underline hover:text-blue-700">Privacy Notice</a>.
                            I understand my data is held securely and is not shared with third parties except where required by law or our regulator.
                        </span>
                    </label>
                </section>

                {{-- Submit --}}
                <div class="flex flex-col items-stretch gap-4 border-t border-slate-100 pt-6 sm:flex-row sm:items-center sm:justify-between">
                    <p class="inline-flex items-center gap-1.5 text-[11px] text-slate-400">
                        <svg class="h-3.5 w-3.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Your information is transmitted securely and encrypted.
                    </p>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-7 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Submit Securely
                    </button>
                </div>
            </form>
            </div>
        </div>

        {{-- Company / regulatory footer --}}
        <footer class="mt-6 rounded-2xl border border-slate-200 bg-white px-6 py-6 text-center shadow-sm">
            <img src="{{ asset('images/logo-switch.png') }}" alt="" class="mx-auto h-8 w-auto">
            <p class="mt-3 text-xs font-medium text-slate-600">
                Company No: 15051352 &nbsp;&middot;&nbsp; VAT Reg No: GB504915794
            </p>
            <p class="mt-2 mx-auto max-w-2xl text-[11px] leading-relaxed text-slate-500">
                Switch&amp;Save Business Services Ltd is authorised and regulated by the Financial Conduct Authority (FCA), FRN 1052230.
                The personal data and documents you provide are processed solely for identity verification and regulatory (KYC/AML)
                purposes in accordance with UK GDPR and the Data Protection Act 2018.
            </p>
            <p class="mt-3 text-[11px] text-slate-400">&copy; {{ date('Y') }} Switch&amp;Save Business Services Ltd. All rights reserved.</p>
        </footer>
    </div>
</div>
@endsection
