<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;

class BackfillEmailHashes extends Command
{
    protected $signature = 'kyc:backfill-email-hashes';

    protected $description = 'Populate the email_hash blind index for customers that predate the column.';

    public function handle(): int
    {
        $updated = 0;

        Customer::query()
            ->whereNull('email_hash')
            ->chunkById(200, function ($customers) use (&$updated) {
                foreach ($customers as $customer) {
                    $hash = Customer::hashEmail($customer->email);

                    if ($hash === null) {
                        continue;
                    }

                    // Avoid touching updated_at/updated_by for a maintenance backfill.
                    $customer->forceFill(['email_hash' => $hash])->saveQuietly();
                    $updated++;
                }
            });

        $this->info("Backfilled email_hash for {$updated} customer(s).");

        return self::SUCCESS;
    }
}
