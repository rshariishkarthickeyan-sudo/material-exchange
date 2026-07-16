<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('username')->unique()->after('id');

            $table->string('designation')->nullable();

            $table->string('unit')->nullable();

            $table->enum('role', [
                'Employee',
                'Approver',
                'Security',
                'Admin'
            ])->default('Employee');

        });
    }

    public function down(): void
    {
            Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'username',
                'designation',
                'unit',
                'role'
            ]);

        });
    }
};
