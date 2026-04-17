<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->nullable()->after('avatar');
            }
            if (!Schema::hasColumn('users', 'member_id')) {
                $table->string('member_id')->nullable()->unique()->after('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'member_id')) {
                $table->dropUnique(['member_id']);
                $table->dropColumn('member_id');
            }
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'avatar')) {
                $table->dropColumn('avatar');
            }
        });
    }
};
