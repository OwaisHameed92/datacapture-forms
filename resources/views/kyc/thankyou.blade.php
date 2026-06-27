@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-2xl mx-auto px-4">

        {{-- Branded header --}}
        <header class="mb-6 rounded-2xl border border-slate-200 bg-white px-6 py-4 shadow-sm text-center">
            <img src="{{ asset('images/logo-switch.png') }}" alt="Switch&Save Business Services Ltd" class="mx-auto h-10 w-auto max-w-[70%] object-contain">
        </header>

        {{-- Confirmation card --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="h-1.5 bg-gradient-to-r from-blue-600 via-blue-500 to-emerald-500"></div>
            <div class="px-6 py-10 sm:px-9 text-center">
                <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-full bg-emerald-50">
                    <svg class="h-7 w-7 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Thank you for submitting your details</h1>
                <p class="mt-3 text-sm text-slate-600">Your KYC information has been received securely and is now under review.</p>

                <p class="mt-3 mx-auto max-w-xl text-xs leading-relaxed text-slate-500">
                    Our team will verify the information and documents you have provided. If we require anything further, we will
                    contact you using the email or phone number supplied.
                </p>

                <div class="mt-8">
                    <a href="{{ route('kyc.form') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit another response
                    </a>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <p class="mt-6 text-center text-[11px] text-slate-400">
            &copy; {{ date('Y') }} Switch&amp;Save Business Services Ltd &middot; Company No. 15051352 &middot; Authorised &amp; regulated by the FCA, FRN 1052230
        </p>
    </div>
</div>
@endsection
