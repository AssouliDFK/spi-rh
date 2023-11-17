<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('name_sender')->nullable();
            $table->string('name_recipient');
            $table->string('company_name')->nullable();
            $table->string('status_invitation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('history');
    }
};
