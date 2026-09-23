<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOnboardingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação para cada campo do formulário de onboarding.
     */
    public function rules(): array
    {
        return [
            // Etapa 1
            'business_type' => ['required', 'string', 'max:255'],

            // Etapa 2
            'business_size' => ['required', 'string', Rule::in([
                'Individual / autônomo',
                'Pequena empresa (2–10 pessoas)',
                'Média empresa (11–50 pessoas)',
                'Grande empresa (50+ pessoas)',
            ])],

            // Etapa 3
            'sales_volume' => ['required', 'string', Rule::in([
                'Ainda não vendo',
                'Até R$ 5 mil/mês',
                'R$ 5 mil – R$ 20 mil/mês',
                'R$ 20 mil – R$ 100 mil/mês',
                'Acima de R$ 100 mil/mês',
            ])],

            // Etapa 4
            'organization_method' => ['required', 'string', Rule::in([
                'Excel / Planilhas',
                'Caderno / Anotações avulsas',
                'Sistema de gestão (ERP/CRM)',
                'Não tenho um método definido',
            ])],

            // Etapa 5
            'message' => ['nullable', 'string', 'max:5000'],
            'images' => ['nullable', 'array', 'max:10'],
            'images.*' => ['image', 'max:5120'], // 5MB por imagem

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company_name' => ['nullable', 'string', 'max:255'],

            // Tipo de solicitação (vindo dos dois botões de envio)
            'request_type' => ['required', 'string', Rule::in(['teste', 'completo'])],
        ];
    }

    /**
     * Mensagens de erro customizadas em português.
     */
    public function messages(): array
    {
        return [
            'business_type.required' => 'Conte qual é o seu negócio atual.',
            'business_size.required' => 'Selecione o tamanho do seu negócio.',
            'sales_volume.required' => 'Selecione o volume de vendas aproximado.',
            'organization_method.required' => 'Selecione como você organiza seu negócio hoje.',
            'name.required' => 'Informe o seu nome.',
            'email.required' => 'Informe um e-mail válido.',
            'email.email' => 'Informe um e-mail válido.',
            'images.*.image' => 'Cada arquivo enviado precisa ser uma imagem.',
            'images.*.max' => 'Cada imagem deve ter no máximo 5MB.',
            'request_type.required' => 'Selecione o tipo de solicitação.',
        ];
    }
}