<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    KYC Customers
                </h2>
                <p class="mt-1 text-sm text-gray-500">Review and manage all customer KYC submissions.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between gap-4">
                    <form method="GET" class="flex-1 flex gap-2">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search by name or email" class="flex-1 rounded-lg border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        <button type="submit" class="inline-flex items-center px-5 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Search
                        </button>
                    </form>
                    @if($search)
                        <a href="{{ route('admin.kyc.customers.index') }}" class="text-xs text-gray-500 hover:text-gray-700">Clear</a>
                    @endif
                </div>

                <div class="px-6 py-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">ID</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">Name</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">Trading Name</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">Phone</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">Email</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">Documents</th>
                                <th class="px-3 py-2 text-left font-medium text-gray-500">Created</th>
                                <th class="px-3 py-2 text-right font-medium text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2 text-gray-500">#{{ $customer->id }}</td>
                                <td class="px-3 py-2 font-medium text-gray-800">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                <td class="px-3 py-2 text-gray-700">{{ $customer->trading_name }}</td>
                                <td class="px-3 py-2 text-gray-700">{{ $customer->phone }}</td>
                                <td class="px-3 py-2 text-gray-700">{{ $customer->email }}</td>
                                <td class="px-3 py-2">
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-100">
                                        {{ $customer->documents_count }} docs
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-gray-500 text-xs">{{ $customer->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-3 py-2 text-right">
                                    <a href="{{ route('admin.kyc.customers.show', $customer) }}" class="inline-flex items-center rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 hover:bg-blue-100">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-3 py-6 text-center text-gray-500 text-sm">No customers found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
