<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('email')->constrained('roles')->nullOnDelete();
            $table->timestamp('last_login_at')->nullable()->after('email_verified_at');
            $table->boolean('is_active')->default(true)->after('password');
            $table->boolean('two_factor_enabled')->default(false)->after('is_active');
            $table->text('two_factor_secret')->nullable()->after('two_factor_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
            $table->dropColumn([
                'last_login_at',
                'is_active',
                'two_factor_enabled',
                'two_factor_secret',
            ]);
        });
    }
};

