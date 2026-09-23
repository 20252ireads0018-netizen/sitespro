<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOnboardingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OnboardingController extends Controller
{
    /**
     * Exibe o formulário multi-etapas.
     */
    public function index()
    {
        return view('onboarding.index');
    }
    
    public function store(StoreOnboardingRequest $request)
    {
        $validated = $request->validated();

        // 1. Monta o payload com todas as respostas do usuário
        $payload = [
            'business_type'       => $validated['business_type'],
            'business_size'       => $validated['business_size'],
            'sales_volume'        => $validated['sales_volume'],
            'organization_method' => $validated['organization_method'],
            'message'             => $validated['message'] ?? null,
            'name'                => $validated['name'],
            'email'               => $validated['email'],
            'phone'               => $validated['phone'] ?? null,
            'company_name'        => $validated['company_name'] ?? null,
            'request_type'        => $validated['request_type'], // 'teste' ou 'completo'
            'submitted_at'        => now(),
        ];

        // 2. Salva as imagens enviadas (se houver) e guarda os caminhos no payload
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('onboarding-uploads', $filename, 'public');
                $imagePaths[] = $path;
            }
        }

        $payload['images'] = $imagePaths;

        // 3. Persistência -------------------------------------------------
        // Quando a tabela existir, substitua a linha abaixo por algo como:
        //
        //     $onboarding = OnboardingRequest::create($payload);
        //
        // (ver migration sugerida: create_onboarding_requests_table)
        //
        // Por enquanto, apenas registramos no log para conferência:
        logger()->info('Nova solicitação de onboarding recebida', $payload);
        // -------------------------------------------------------------------

        $mensagem = $payload['request_type'] === 'teste'
            ? 'Recebemos sua solicitação de site teste! Em breve entraremos em contato.'
            : 'Recebemos sua solicitação de site completo! Nossa equipe vai analisar e retornar em breve.';

        return redirect()
            ->route('onboarding.thanks')
            ->with('status', $mensagem);
    }

    /**
     * Página de agradecimento após o envio.
     */
    public function thanks()
    {
        return view('onboarding.thanks');
    }

    /**
     * Formulário para falar com um atendente humano.
     */
    public function humanContact()
    {
        return view('onboarding.human-contact');
    }

    /**
     * Salva o contato para atendimento humano.
     */
    public function storeHumanContact(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        logger()->info('Novo contato humano solicitado', $validated);

        return redirect()
            ->route('contact.human')
            ->with('status', 'Recebemos seu contato! Em breve alguém da nossa equipe vai falar com você.');
    }
}