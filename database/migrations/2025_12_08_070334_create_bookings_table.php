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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // ห้องที่จอง
            $table->foreignId('room_id')
                  ->constrained('rooms')
                  ->onDelete('cascade');

            // ข้อมูลการใช้ห้อง
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('meeting_topic');      // หัวข้อการประชุม
            $table->string('department')->nullable(); // กลุ่มงาน / ส่วนงาน

            // ข้อมูลผู้จอง
            $table->string('name');
            $table->string('lastname');
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();

            // สถานะการจอง
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
