<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gate_pass_materials', function (Blueprint $table) {

            $table->text('description')
                  ->nullable();

            $table->decimal('price', 12, 2)
                  ->nullable()
                  ->after('unit');
        });
    }

    public function down(): void
    {
        Schema::table('gate_pass_materials', function (Blueprint $table) {

            $table->dropColumn('description');
            $table->dropColumn('price');

        });
    }
};