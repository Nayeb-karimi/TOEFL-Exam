<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->boolean('selected')->default(false);
            $table->boolean('scored')->default(false);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('active_whatsapp_number');
            $table->string('email_address')->nullable();
            $table->integer('task_completion')->default(0);
            $table->integer('comprehensibility')->default(0);
            $table->integer('fluency')->default(0);
            $table->integer('vocabulary')->default(0);
            $table->integer('language_control')->default(0);
            $table->integer('score')->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
