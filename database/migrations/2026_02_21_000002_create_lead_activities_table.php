<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('lead_activities')) {
            Schema::create('lead_activities', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('activity_id');
                $table->unsignedBigInteger('lead_id');
                $table->timestamps();

                $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
                $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('lead_activities');
    }
};
