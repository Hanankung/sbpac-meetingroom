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
        Schema::table('rooms', function (Blueprint $table) {
            // ลบฟิลด์เดิม
            $table->dropColumn(['organization', 'department']);

            // เพิ่มฟิลด์ใหม่
            $table->unsignedInteger('quantity')->default(0);   // จำนวนที่นั่ง / ความจุ
            $table->text('description')->nullable();      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
             // ย้อนกลับ: ลบฟิลด์ใหม่
            $table->dropColumn(['quantity', 'description']);

            // เพิ่มฟิลด์เก่ากลับ (เผื่อใช้ migrate:rollback)
            $table->string('organization', 100)->nullable();
            $table->string('department', 100)->nullable();
        });
    }
};
