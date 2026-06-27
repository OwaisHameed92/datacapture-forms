<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Blind index: deterministic hash of the email so admins can look up an
            // encrypted email by exact match without decrypting every row.
            $table->string('email_hash', 64)->nullable()->after('email')->index();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('email_hash');
        });
    }
};
