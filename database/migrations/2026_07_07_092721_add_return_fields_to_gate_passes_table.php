<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('gate_passes', function ($table) {

        $table->date('returned_date')->nullable();

        $table->text('return_remarks')->nullable();

        $table->unsignedBigInteger('returned_by')
              ->nullable();

    });
}
};
