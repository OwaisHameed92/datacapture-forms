<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\KycDocument;
use App\Services\AuditLogService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KycDocumentController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService,
    ) {
    }

    // Admin-only secure download endpoint.
    public function download(Request $request, Customer $customer, KycDocument $document): StreamedResponse|RedirectResponse
    {
        /** @var Authenticatable $user */
        $user = $request->user();

        if ($document->customer_id !== $customer->id) {
            abort(404);
        }

        if (! Storage::disk($document->disk)->exists($document->path)) {
            abort(404);
        }

        $this->auditLogService->log($user, $customer->id, 'kyc_document_downloaded', [
            'document_id' => $document->id,
            'type' => $document->type,
        ]);

        return Storage::disk($document->disk)->download($document->path, $document->original_filename);
    }

    // Admin-only hard delete of customer + files (GDPR erasure).
    public function destroyCustomer(Request $request, Customer $customer): RedirectResponse
    {
        /** @var Authenticatable $user */
        $user = $request->user();

        foreach ($customer->documents as $document) {
            Storage::disk($document->disk)->delete($document->path);
            $document->forceDelete();
        }

        $customer->addresses()->forceDelete();
        $customer->forceDelete();

        $this->auditLogService->log($user, null, 'customer_erased', [
            'customer_id' => $customer->id,
        ]);

        return redirect()->back()->with('status', 'Customer and related data erased.');
    }
}
