<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gate_passes', function (Blueprint $table) {
            $table->dropColumn('gate_pass_no');
        });
    }

    public function down(): void
    {
        Schema::table('gate_passes', function (Blueprint $table) {
            $table->string('gate_pass_no')->unique()->nullable();
        });
    }
};