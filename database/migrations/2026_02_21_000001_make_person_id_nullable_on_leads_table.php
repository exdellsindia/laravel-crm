<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            // Drop foreign key constraint if exists
            //$table->dropForeign(['person_id']);
            // Make person_id nullable
            $table->unsignedInteger('person_id')->nullable()->change();
            // Re-add foreign key constraint, but allow nulls
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['person_id']);
            $table->unsignedInteger('person_id')->nullable(false)->change();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
        });
    }
};
