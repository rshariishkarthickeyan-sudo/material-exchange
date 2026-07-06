<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gate_passes', function (Blueprint $table) {

            $table->string('prepared_name')->nullable();
            $table->string('prepared_ic_no')->nullable();
            $table->string('prepared_designation')->nullable();
            $table->string('prepared_group')->nullable();

            $table->string('taken_name')->nullable();
            $table->string('taken_ic_no')->nullable();
            $table->string('taken_designation')->nullable();
            $table->string('taken_group')->nullable();

            $table->string('vehicle_no')->nullable();

            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('gate_passes', function (Blueprint $table) {

            $table->dropColumn([
                'prepared_name',
                'prepared_ic_no',
                'prepared_designation',
                'prepared_group',

                'taken_name',
                'taken_ic_no',
                'taken_designation',
                'taken_group',

                'vehicle_no',

                'description',
            ]);
        });
    }
};