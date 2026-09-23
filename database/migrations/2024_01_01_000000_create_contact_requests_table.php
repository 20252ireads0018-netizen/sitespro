<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();

            // Dados de contato
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company_name')->nullable();

            // Respostas do questionário de recepção
            $table->string('business_type')->nullable();      // Seu negócio atual
            $table->string('business_size')->nullable();      // Tamanho do negócio
            $table->string('sales_volume')->nullable();       // Volume de vendas
            $table->string('organization_method')->nullable();// Método de organização (Excel, avulso, etc.)

            // Detalhes livres do pedido
            $table->text('message')->nullable();
            $table->json('images')->nullable(); // caminhos das imagens enviadas

            // Origem/tipo da solicitação
            $table->enum('type', ['request', 'human_contact'])->default('request');
            $table->enum('status', ['new', 'contacted', 'closed'])->default('new');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
