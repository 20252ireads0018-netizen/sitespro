<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onboarding_requests', function (Blueprint $table) {
            $table->id();

            $table->string('business_type');
            $table->string('business_size');
            $table->string('sales_volume');
            $table->string('organization_method');
            $table->text('message')->nullable();

            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();

            $table->enum('request_type', ['teste', 'completo']);
            $table->json('images')->nullable(); // caminhos das imagens enviadas

            $table->string('status')->default('pendente'); // pendente, em_andamento, concluido...
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onboarding_requests');
    }
};