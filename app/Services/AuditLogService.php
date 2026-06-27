<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Request;

class AuditLogService
{
    public function log(?Authenticatable $user, ?int $customerId, string $action, array $metadata = []): void
    {
        AuditLog::create([
            'user_id' => $user?->getAuthIdentifier(),
            'customer_id' => $customerId,
            'action' => $action,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'metadata' => $metadata,
        ]);
    }
}
