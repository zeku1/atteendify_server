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
        Schema::create('session_participants', function (Blueprint $table) {
            $table->unsignedBigInteger('class_session_id');
            $table->unsignedBigInteger('student_id');
            
            $table->primary(['class_session_id', 'student_id']);

            $table->foreign('class_session_id')
                ->references('id') 
                ->on('class_sessions') 
                ->onDelete('cascade');
            
            $table->foreign('student_id')
                ->references('id') 
                ->on('students')   
                ->onDelete('cascade');

            $table->time('time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_participants');
    }
};
