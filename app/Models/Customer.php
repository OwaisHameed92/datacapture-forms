<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_hash',
        'phone',
        'business_phone',
        'date_of_birth',
        'nationality',
        'business_type',
        'trading_name',
        'company_name',
        'company_number',
        'nature_of_business',
        'bank_name_on_account',
        'bank_sort_code',
        'bank_account_number',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        // Encrypt sensitive attributes at rest using Laravel's built-in encryption.
        'email' => 'encrypted',
        'phone' => 'encrypted',
        'business_phone' => 'encrypted',
        'bank_name_on_account' => 'encrypted',
        'bank_sort_code' => 'encrypted',
        'bank_account_number' => 'encrypted',
    ];

    /**
     * Deterministic blind-index hash for an email address, keyed to the app key
     * so the hash cannot be brute-forced without it. Used for exact-match lookups
     * of the encrypted `email` column.
     */
    public static function hashEmail(?string $email): ?string
    {
        $email = trim((string) $email);

        if ($email === '') {
            return null;
        }

        return hash_hmac('sha256', mb_strtolower($email), config('app.key'));
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function documents()
    {
        return $this->hasMany(KycDocument::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
