@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-10">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white border border-slate-200 rounded-2xl shadow-md px-8 py-10 text-center">
            <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50">
                <svg class="h-6 w-6 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>

            <h1 class="text-2xl font-semibold text-slate-900 mb-2">Thank you for submitting your details</h1>
            <p class="text-sm text-slate-600 mb-4">Your KYC information has been received securely and is now under review.</p>

            <p class="text-xs text-slate-500 max-w-xl mx-auto mb-6">
                Our team will verify the information and documents you have provided. If we require anything further, we will contact you using the email or phone number supplied.
            </p>

            <div class="flex justify-center">
                <a href="{{ url('/') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-md bg-amber-700 text-white hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-amber-600">
                    Submit another response
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
