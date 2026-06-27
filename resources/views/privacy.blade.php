@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-3xl mx-auto px-4">

        {{-- Branded header --}}
        <header class="mb-6 rounded-2xl border border-slate-200 bg-white px-6 py-4 shadow-sm">
            <a href="{{ route('kyc.form') }}" class="inline-block">
                <img src="{{ asset('images/logo-switch.png') }}" alt="Switch&Save Business Services Ltd" class="h-10 w-auto">
            </a>
        </header>

        <article class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="h-1.5 bg-gradient-to-r from-blue-600 via-blue-500 to-emerald-500"></div>
            <div class="px-6 py-8 sm:px-9">

                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Privacy Notice</h1>
                <p class="mt-1 text-xs text-slate-500">Last updated: {{ date('F Y') }}</p>

                <div class="mt-6 space-y-6 text-sm leading-relaxed text-slate-600">

                    <p>
                        This notice explains how <span class="font-medium text-slate-800">Switch&amp;Save Business Services Ltd</span>
                        (&ldquo;we&rdquo;, &ldquo;us&rdquo;) collects and uses the personal information you provide when completing our
                        Customer Onboarding &amp; Identity Verification form. We are the data controller for this information.
                    </p>

                    <section>
                        <h2 class="mb-2 text-base font-semibold text-slate-900">Who we are</h2>
                        <p>
                            Switch&amp;Save Business Services Ltd is a company registered in England &amp; Wales (Company No. 15051352,
                            VAT Reg No. GB504915794) and is authorised and regulated by the Financial Conduct Authority (FCA),
                            FRN 1052230.
                        </p>
                    </section>

                    <section>
                        <h2 class="mb-2 text-base font-semibold text-slate-900">What we collect</h2>
                        <ul class="list-disc space-y-1 pl-5">
                            <li>Personal details — name, date of birth, nationality, email and phone number.</li>
                            <li>Business details — business type, trading and registered company names, company number and addresses.</li>
                            <li>Bank details — account name, sort code and account number.</li>
                            <li>Identity and verification documents — proof of ID, proof of address, proof of bank and driving licence images.</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="mb-2 text-base font-semibold text-slate-900">Why we collect it &amp; our lawful basis</h2>
                        <p>
                            We use this information to verify your identity and business, to carry out our anti-money-laundering (AML)
                            and Know Your Customer (KYC) obligations, and to provide our services to you. Our lawful bases under UK GDPR
                            are <span class="font-medium text-slate-800">legal obligation</span> (meeting our regulatory and AML duties),
                            <span class="font-medium text-slate-800">performance of a contract</span>, and your
                            <span class="font-medium text-slate-800">consent</span> for the submission itself.
                        </p>
                    </section>

                    <section>
                        <h2 class="mb-2 text-base font-semibold text-slate-900">How we protect it</h2>
                        <p>
                            Your submission is transmitted over an encrypted connection. Sensitive fields (such as your email, phone and
                            bank details) are encrypted at rest, and uploaded documents are stored in a private, non-public location
                            accessible only to authorised staff. Access to your data is logged.
                        </p>
                    </section>

                    <section>
                        <h2 class="mb-2 text-base font-semibold text-slate-900">Who we share it with</h2>
                        <p>
                            We do not sell your data. We share it only where necessary with identity-verification and regulatory partners,
                            or where we are required to do so by law or by our regulator.
                        </p>
                    </section>

                    <section>
                        <h2 class="mb-2 text-base font-semibold text-slate-900">How long we keep it</h2>
                        <p>
                            We retain your information for as long as needed to provide our services and to meet our legal and regulatory
                            record-keeping obligations (typically a minimum of five years after our relationship ends), after which it is
                            securely erased.
                        </p>
                    </section>

                    <section>
                        <h2 class="mb-2 text-base font-semibold text-slate-900">Your rights</h2>
                        <p>
                            You have the right to access, correct, or request erasure of your personal data, to object to or restrict its
                            processing, and to data portability, subject to our legal obligations. You also have the right to complain to
                            the Information Commissioner&rsquo;s Office (ICO) at
                            <a href="https://ico.org.uk" class="font-medium text-blue-600 hover:text-blue-700">ico.org.uk</a>.
                        </p>
                    </section>

                    <section>
                        <h2 class="mb-2 text-base font-semibold text-slate-900">Contact us</h2>
                        <p>
                            To exercise any of your rights or to ask a question about this notice, please contact Switch&amp;Save Business
                            Services Ltd.
                        </p>
                    </section>
                </div>

                <div class="mt-8 border-t border-slate-100 pt-6">
                    <a href="{{ route('kyc.form') }}" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Back to the form
                    </a>
                </div>
            </div>
        </article>

        <p class="mt-6 text-center text-[11px] text-slate-400">
            &copy; {{ date('Y') }} Switch&amp;Save Business Services Ltd &middot; Company No. 15051352 &middot; FCA FRN 1052230
        </p>
    </div>
</div>
@endsection
