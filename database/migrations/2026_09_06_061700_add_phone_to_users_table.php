<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Phone column already exists in the users table.
    }

    public function down(): void
    {
        // Do nothing because the phone column already existed.
    }
};