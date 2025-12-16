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
        Schema::table('users', function (Blueprint $table) {
            // เพิ่มฟิลด์พนักงาน
            if (!Schema::hasColumn('users', 'national_id')) {
                $table->string('national_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'lastname')) {
                $table->string('lastname')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('lastname');
            }
            if (!Schema::hasColumn('users', 'division')) {
                $table->string('division')->nullable()->after('phone'); // สำนักงาน/กอง
            }
            if (!Schema::hasColumn('users', 'department')) {
                $table->string('department')->nullable()->after('division'); // กลุ่มงาน
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $drop = [];
            foreach (['national_id','lastname','phone','division','department','is_active'] as $col) {
                if (Schema::hasColumn('users', $col)) $drop[] = $col;
            }
            if ($drop) $table->dropColumn($drop);
        });
    }
};
