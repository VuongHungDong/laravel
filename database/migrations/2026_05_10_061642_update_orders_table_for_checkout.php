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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->after('id')->nullable();
            $table->string('email')->after('name')->nullable();
            $table->string('phone')->after('email')->nullable();
            $table->text('address')->after('phone')->nullable();
            $table->decimal('total_price', 15, 2)->after('address')->nullable();
            
            // Allow code to be nullable if we don't provide it initially
            $table->string('code', 45)->nullable()->change();
            
            // Allow user_id to be nullable for guest checkout
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'address', 'total_price']);
            $table->string('code', 45)->nullable(false)->change();
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};
