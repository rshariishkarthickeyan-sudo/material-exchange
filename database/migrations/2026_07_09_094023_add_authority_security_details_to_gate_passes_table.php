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
    Schema::table('gate_passes', function (Blueprint $table) {

        // Authority
        $table->string('authority_name')->nullable();
        $table->string('authority_ic_no')->nullable();
        $table->string('authority_designation')->nullable();
        $table->string('authority_group')->nullable();

        // Security
        $table->string('security_name')->nullable();
        $table->string('security_ic_no')->nullable();
        $table->string('security_designation')->nullable();
        $table->string('security_group')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gate_passes', function (Blueprint $table) {
            //
        });
    }
};
