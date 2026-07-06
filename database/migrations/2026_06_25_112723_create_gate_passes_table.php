<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gate_passes', function (Blueprint $table) {

            $table->id();

            $table->string('gate_pass_no')->unique();

            $table->enum('category', [
                'RETURNABLE',
                'NON_RETURNABLE'
            ]);

            $table->foreignId('created_by')
                  ->constrained('users');

            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users');

            $table->foreignId('security_by')
                  ->nullable()
                  ->constrained('users');

            /*
            |--------------------------------------------------------------------------
            | Prepared By
            |--------------------------------------------------------------------------
            */
            $table->string('prepared_name')->nullable();
            $table->string('prepared_ic_no')->nullable();
            $table->string('prepared_designation')->nullable();
            $table->string('prepared_group')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Taken Out By
            |--------------------------------------------------------------------------
            */
            $table->string('taken_name')->nullable();
            $table->string('taken_ic_no')->nullable();
            $table->string('taken_designation')->nullable();
            $table->string('taken_group')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Transport Details
            |--------------------------------------------------------------------------
            */
            $table->string('vehicle_no')->nullable();

            $table->string('destination')->nullable();

            $table->string('transport_mode')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Returnable Material
            |--------------------------------------------------------------------------
            */
            $table->date('due_date')->nullable();

            $table->date('actual_return_date')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */
            $table->text('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status Flow
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'PENDING_APPROVAL',
                'APPROVED',
                'REJECTED',
                'PENDING_SECURITY',
                'RELEASED',
                'RETURN_PENDING',
                'RETURNED',
                'CLOSED'
            ])->default('PENDING_APPROVAL');

            $table->text('remarks')->nullable();

            $table->timestamp('approval_date')->nullable();

            $table->timestamp('security_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gate_passes');
    }
};