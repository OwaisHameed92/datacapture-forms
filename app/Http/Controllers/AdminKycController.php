<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminKycController extends Controller
{
    public function index(Request $request): View
    {
        $query = Customer::query()->withCount('documents');

        if ($search = $request->string('search')->toString()) {
            $query->where(function ($q) use ($search) {
                // Email/phone are encrypted (random ciphertext), so a LIKE never matches them.
                // Names are searched partially; a full email is matched exactly via its blind index.
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");

                if (str_contains($search, '@')) {
                    $q->orWhere('email_hash', Customer::hashEmail($search));
                }
            });
        }

        $customers = $query->latest()->paginate(20)->withQueryString();

        return view('admin.kyc.index', [
            'customers' => $customers,
            'search' => $search,
        ]);
    }

    public function show(Request $request, Customer $customer): View
    {
        $customer->load(['addresses', 'documents']);

        return view('admin.kyc.show', [
            'customer' => $customer,
        ]);
    }
}
