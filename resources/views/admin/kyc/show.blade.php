<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Customer #{{ $customer->id }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Full KYC profile and documents.</p>
            </div>
            <a href="{{ route('admin.kyc.customers.index') }}" class="text-xs font-medium text-blue-600 hover:text-blue-800">&larr; Back to list</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    @php
                        $docs = $customer->documents ?? collect();
                    @endphp

                    {{-- Document Status Summary --}}
                    <section class="bg-white shadow-sm sm:rounded-xl border border-gray-100 p-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800">Verification Status</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Overview of key documents on file for this customer.</p>
                        </div>
                        <div class="flex flex-wrap gap-1.5 text-[10px]">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 border {{ $docs->where('type', 'proof_id')->isNotEmpty() ? 'bg-emerald-50 border-emerald-100 text-emerald-700' : 'bg-gray-50 border-gray-100 text-gray-500' }}">ID</span>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 border {{ $docs->where('type', 'proof_bank')->isNotEmpty() ? 'bg-emerald-50 border-emerald-100 text-emerald-700' : 'bg-gray-50 border-gray-100 text-gray-500' }}">Bank</span>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 border {{ $docs->where('type', 'proof_address')->isNotEmpty() ? 'bg-emerald-50 border-emerald-100 text-emerald-700' : 'bg-gray-50 border-gray-100 text-gray-500' }}">Address</span>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 border {{ $docs->where('type', 'dl_front')->isNotEmpty() ? 'bg-emerald-50 border-emerald-100 text-emerald-700' : 'bg-gray-50 border-gray-100 text-gray-500' }}">DL Front</span>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 border {{ $docs->where('type', 'dl_back')->isNotEmpty() ? 'bg-emerald-50 border-emerald-100 text-emerald-700' : 'bg-gray-50 border-gray-100 text-gray-500' }}">DL Back</span>
                        </div>
                    </section>
                    {{-- Personal Details --}}
                    <section class="bg-white shadow-sm sm:rounded-xl border border-gray-100 p-6">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Personal Details</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            <div>
                                <dt class="text-gray-500">Name</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->first_name }} {{ $customer->last_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Email</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Phone</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Date of Birth</dt>
                                <dd class="font-medium text-gray-900">{{ optional($customer->date_of_birth)->format('Y-m-d') }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Nationality</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->nationality }}</dd>
                            </div>
                        </dl>
                    </section>

                    {{-- Business Details --}}
                    <section class="bg-white shadow-sm sm:rounded-xl border border-gray-100 p-6">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Business Details</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2 text-sm">
                            <div>
                                <dt class="text-gray-500">Business Type</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->business_type }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Business Phone</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->business_phone }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Trading Name</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->trading_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Company Name</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->company_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Company Number</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->company_number }}</dd>
                            </div>
                            <div class="md:col-span-2">
                                <dt class="text-gray-500">Nature of Business</dt>
                                <dd class="font-medium text-gray-900 whitespace-pre-line">{{ $customer->nature_of_business }}</dd>
                            </div>
                        </dl>
                    </section>

                    {{-- Addresses --}}
                    <section class="bg-white shadow-sm sm:rounded-xl border border-gray-100 p-6">
                        <h3 class="text-sm font-semibold text-gray-800 mb-4">Addresses</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            @foreach ($customer->addresses as $address)
                                <div class="border border-gray-100 rounded-lg p-3 bg-gray-50">
                                    <p class="text-xs font-semibold text-gray-600 uppercase mb-1">{{ ucfirst($address->type) }} Address</p>
                                    <p class="text-gray-800">{{ $address->line1 }}</p>
                                    @if($address->line2)
                                        <p class="text-gray-800">{{ $address->line2 }}</p>
                                    @endif
                                    @if($address->line3)
                                        <p class="text-gray-800">{{ $address->line3 }}</p>
                                    @endif
                                    <p class="text-gray-700">{{ $address->city }} {{ $address->state }} {{ $address->postcode }}</p>
                                    <p class="text-gray-700">{{ $address->country }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    {{-- Bank Details --}}
                    <section class="bg-white shadow-sm sm:rounded-xl border border-gray-100 p-6">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Bank Details</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-2 text-sm">
                            <div>
                                <dt class="text-gray-500">Name on Account</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->bank_name_on_account }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Sort Code</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->bank_sort_code }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Account Number</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->bank_account_number }}</dd>
                            </div>
                        </dl>
                    </section>

                    {{-- Documents --}}
                    <section class="bg-white shadow-sm sm:rounded-xl border border-gray-100 p-6">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Documents</h3>
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left font-medium text-gray-500">Type</th>
                                    <th class="px-3 py-2 text-left font-medium text-gray-500">Original Filename</th>
                                    <th class="px-3 py-2 text-left font-medium text-gray-500">Size</th>
                                    <th class="px-3 py-2 text-right font-medium text-gray-500">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($customer->documents as $document)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-2 text-gray-800">{{ $document->type }}</td>
                                    <td class="px-3 py-2 text-gray-700">{{ $document->original_filename }}</td>
                                    <td class="px-3 py-2 text-gray-500 text-xs">{{ number_format($document->size) }} bytes</td>
                                    <td class="px-3 py-2 text-right">
                                        <a href="{{ route('admin.kyc.documents.download', [$customer, $document]) }}" class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 hover:bg-blue-100">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-6 text-center text-gray-500 text-sm">No documents uploaded.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </section>
                </div>

                {{-- Sidebar: Meta (Danger Zone temporarily hidden) --}}
                <div class="space-y-6">
                    <section class="bg-white shadow-sm sm:rounded-xl border border-gray-100 p-6 text-sm">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">KYC Summary</h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Customer ID</dt>
                                <dd class="font-medium text-gray-900">#{{ $customer->id }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Documents</dt>
                                <dd class="font-medium text-gray-900">{{ $customer->documents->count() }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Created</dt>
                                <dd class="font-medium text-gray-900 text-xs">{{ $customer->created_at->format('Y-m-d H:i') }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Last Updated</dt>
                                <dd class="font-medium text-gray-900 text-xs">{{ $customer->updated_at->format('Y-m-d H:i') }}</dd>
                            </div>
                        </dl>
                    </section>

                    {{--
                    <section class="bg-red-50 border border-red-200 shadow-sm sm:rounded-xl p-6">
                        <h3 class="text-sm font-semibold text-red-800 mb-2">Danger Zone</h3>
                        <p class="mb-3 text-xs text-red-700">This will permanently delete this customer, their addresses, and all related KYC documents from storage (GDPR erasure).</p>
                        <form method="POST" action="{{ route('admin.kyc.customers.destroy', $customer) }}" onsubmit="return confirm('Are you sure you want to permanently delete this customer and all related KYC data?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                                Delete Customer
                            </button>
                        </form>
                    </section>
                    --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
