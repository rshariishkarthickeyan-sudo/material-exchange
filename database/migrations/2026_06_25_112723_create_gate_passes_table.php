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

            $table->string('taken_by');

            $table->string('destination');

            $table->string('transport_mode');

            $table->date('due_date')->nullable();

            $table->date('actual_return_date')->nullable();

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