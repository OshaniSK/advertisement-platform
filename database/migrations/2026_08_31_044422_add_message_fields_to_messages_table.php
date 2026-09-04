<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('messages', function (Blueprint $table) {
        $table->foreignId('sender_id')
            ->constrained('users')
            ->onDelete('cascade');

        $table->foreignId('receiver_id')
            ->constrained('users')
            ->onDelete('cascade');

        $table->foreignId('advertisement_id')
            ->constrained('advertisements')
            ->onDelete('cascade');

        $table->text('message');
    });
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropForeign(['sender_id']);
        $table->dropForeign(['receiver_id']);
        $table->dropForeign(['advertisement_id']);

        $table->dropColumn([
            'sender_id',
            'receiver_id',
            'advertisement_id',
            'message',
        ]);
    });
}
};
