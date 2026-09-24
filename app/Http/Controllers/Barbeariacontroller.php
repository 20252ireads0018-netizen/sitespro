<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class BarbeariaController extends Controller
{
    /**
     * Dashboard principal (rota: barbearia.agenda).
     * Mesma tela usada em /siteBarbearia — os dados aqui alimentam
     * resources/views/portfolio/barbearia/siteBarbearia.blade.php
     */
    public function agenda()
    {
        // TODO: troque pelos agendamentos reais do dia (ex.: Agendamento::whereDate('data', today())->get())
        $agendamentosHoje = [
            [
                'hora' => '09:00',
                'inicial' => 'L',
                'nome' => 'Lucas Almeida',
                'servico' => 'Corte masculino',
                'status' => 'Confirmado',
                'telefone' => '(11) 98765-4321',
                'email' => 'lucas.almeida@email.com',
            ],
            [
                'hora' => '10:30',
                'inicial' => 'R',
                'nome' => 'Rafael Costa',
                'servico' => 'Barba + Sobrancelha',
                'status' => 'Confirmado',
                'telefone' => '(11) 91234-5678',
                'email' => 'rafael.costa@email.com',
            ],
            [
                'hora' => '13:00',
                'inicial' => 'G',
                'nome' => 'Gabriel Santos',
                'servico' => 'Corte + Barba',
                'status' => 'Confirmado',
                'telefone' => '(11) 99988-7766',
                'email' => 'gabriel.santos@email.com',
            ],
            [
                'hora' => '15:30',
                'inicial' => 'F',
                'nome' => 'Felipe Martins',
                'servico' => 'Corte masculino',
                'status' => 'Pendente',
                'telefone' => '(11) 97777-1122',
                'email' => 'felipe.martins@email.com',
            ],
        ];

        // TODO: troque pelos totais reais (ex.: contagem/soma no banco)
        $resumoHoje = [
            'agendamentosHoje' => count($agendamentosHoje),
            'faturamento' => 680.00,
            'clientesAtendidosMes' => 86,
            'funcionariosAtivos' => 4,
        ];

        return view('portfolio.barbearia.siteBarbearia', [
            'agendamentosHoje' => $agendamentosHoje,
            'resumoHoje' => $resumoHoje,
        ]);
    }

    /**
     * Tela "Ver todos" (rota: barbearia.agendamentos.index).
     * Alimenta resources/views/portfolio/barbearia/AgendamentosIndex.blade.php
     */
    public function agendamentosIndex(Request $request)
    {
        // TODO: troque por uma query real, já filtrada no banco:
        // $agendamentos = Agendamento::query()
        //     ->when($request->filled('data'), fn ($q) => $q->whereDate('data', $request->input('data')))
        //     ->when($request->filled('status'), fn ($q) => $q->where('status', $request->input('status')))
        //     ->orderBy('data')->orderBy('hora')
        //     ->paginate(15);
        $agendamentos = [
            ['hora' => '09:00', 'data' => '24/09/2026', 'inicial' => 'L', 'nome' => 'Lucas Almeida', 'servico' => 'Corte masculino', 'status' => 'Confirmado', 'telefone' => '(11) 98765-4321', 'email' => 'lucas.almeida@email.com'],
            ['hora' => '10:30', 'data' => '24/09/2026', 'inicial' => 'R', 'nome' => 'Rafael Costa', 'servico' => 'Barba + Sobrancelha', 'status' => 'Confirmado', 'telefone' => '(11) 91234-5678', 'email' => 'rafael.costa@email.com'],
            ['hora' => '13:00', 'data' => '24/09/2026', 'inicial' => 'G', 'nome' => 'Gabriel Santos', 'servico' => 'Corte + Barba', 'status' => 'Confirmado', 'telefone' => '(11) 99988-7766', 'email' => 'gabriel.santos@email.com'],
            ['hora' => '15:30', 'data' => '24/09/2026', 'inicial' => 'F', 'nome' => 'Felipe Martins', 'servico' => 'Corte masculino', 'status' => 'Pendente', 'telefone' => '(11) 97777-1122', 'email' => 'felipe.martins@email.com'],
            ['hora' => '16:45', 'data' => '25/09/2026', 'inicial' => 'M', 'nome' => 'Marcelo Souza', 'servico' => 'Corte + Barba', 'status' => 'Confirmado', 'telefone' => '(11) 93333-2222', 'email' => 'marcelo.souza@email.com'],
            ['hora' => '18:00', 'data' => '25/09/2026', 'inicial' => 'T', 'nome' => 'Thiago Lima', 'servico' => 'Corte masculino', 'status' => 'Pendente', 'telefone' => '(11) 94444-1111', 'email' => 'thiago.lima@email.com'],
        ];

        // Filtro em PHP só pra demonstração — assim que a query acima existir, pode remover este bloco
        $dataFiltro = $request->input('data');
        $statusFiltro = $request->input('status');

        $agendamentos = array_values(array_filter($agendamentos, function ($ag) use ($dataFiltro, $statusFiltro) {
            if ($dataFiltro) {
                $dataAgendamento = DateTime::createFromFormat('d/m/Y', $ag['data']);
                if (!$dataAgendamento || $dataAgendamento->format('Y-m-d') !== $dataFiltro) {
                    return false;
                }
            }

            if ($statusFiltro && strtolower($ag['status']) !== strtolower($statusFiltro)) {
                return false;
            }

            return true;
        }));

        // TODO: troque pelos totais financeiros reais do mês
        $resumoMes = [
            'faturamento' => 8420.00,
            'gastos' => 2150.00,
            'agendamentosMes' => 132,
            'variacaoFaturamento' => 18,
            'variacaoGastos' => -6,
            'variacaoAgendamentos' => 9,
        ];

        // TODO: troque pelos totais reais por semana do mês
        $serieMes = [
            ['label' => 'Semana 1', 'faturamento' => 1850, 'gastos' => 480],
            ['label' => 'Semana 2', 'faturamento' => 2100, 'gastos' => 520],
            ['label' => 'Semana 3', 'faturamento' => 1980, 'gastos' => 560],
            ['label' => 'Semana 4', 'faturamento' => 2490, 'gastos' => 590],
        ];

        return view('portfolio.barbearia.AgendamentosIndex', [
            'agendamentos' => $agendamentos,
            'resumoMes' => $resumoMes,
            'serieMes' => $serieMes,
        ]);
    }

    /**
     * Tela de Financeiro (rota: barbearia.financeiro).
     */
    public function financeiro()
    {
        // TODO: troque pelos dados reais de faturamento/gastos
        $resumoMes = [
            'faturamento' => 8420.00,
            'gastos' => 2150.00,
            'agendamentosMes' => 132,
            'variacaoFaturamento' => 18,
            'variacaoGastos' => -6,
            'variacaoAgendamentos' => 9,
        ];

        $serieMes = [
            ['label' => 'Semana 1', 'faturamento' => 1850, 'gastos' => 480],
            ['label' => 'Semana 2', 'faturamento' => 2100, 'gastos' => 520],
            ['label' => 'Semana 3', 'faturamento' => 1980, 'gastos' => 560],
            ['label' => 'Semana 4', 'faturamento' => 2490, 'gastos' => 590],
        ];

        return view('portfolio.barbearia.financeiro', [
            'resumoMes' => $resumoMes,
            'serieMes' => $serieMes,
        ]);
    }

    /**
     * Tela de Maquinário (rota: barbearia.maquinario).
     */
    public function maquinario()
    {
        // TODO: troque pelos equipamentos reais (ex.: Equipamento::all())
        $equipamentos = [
            ['nome' => 'Máquina de corte', 'status' => 'Ativa'],
            ['nome' => 'Máquina de acabamento', 'status' => 'Ativa'],
            ['nome' => 'Secador', 'status' => 'Ativa'],
        ];

        return view('portfolio.barbearia.maquinario', [
            'equipamentos' => $equipamentos,
        ]);
    }

    /**
     * Tela de Funcionários (rota: barbearia.funcionario).
     */
    public function funcionario()
    {
        // TODO: troque pelos funcionários reais (ex.: Funcionario::all())
        $funcionarios = [
            ['nome' => 'Administrador', 'cargo' => 'Gerente', 'status' => 'Ativo'],
        ];

        return view('portfolio.barbearia.funcionario', [
            'funcionarios' => $funcionarios,
        ]);
    }
}