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
            ['hora' => '09:00', 'inicial' => 'L', 'nome' => 'Lucas Almeida',   'servico' => 'Corte masculino',     'status' => 'Confirmado', 'telefone' => '(11) 98765-4321', 'email' => 'lucas.almeida@email.com'],
            ['hora' => '10:30', 'inicial' => 'R', 'nome' => 'Rafael Costa',    'servico' => 'Barba + Sobrancelha', 'status' => 'Confirmado', 'telefone' => '(11) 91234-5678', 'email' => 'rafael.costa@email.com'],
            ['hora' => '13:00', 'inicial' => 'G', 'nome' => 'Gabriel Santos',  'servico' => 'Corte + Barba',       'status' => 'Confirmado', 'telefone' => '(11) 99988-7766', 'email' => 'gabriel.santos@email.com'],
            ['hora' => '15:30', 'inicial' => 'F', 'nome' => 'Felipe Martins',  'servico' => 'Corte masculino',     'status' => 'Pendente',   'telefone' => '(11) 97777-1122', 'email' => 'felipe.martins@email.com'],
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
            ['hora' => '09:00', 'data' => '24/09/2026', 'inicial' => 'L', 'nome' => 'Lucas Almeida',    'servico' => 'Corte masculino',      'status' => 'Confirmado', 'telefone' => '(11) 98765-4321', 'email' => 'lucas.almeida@email.com'],
            ['hora' => '10:30', 'data' => '24/09/2026', 'inicial' => 'R', 'nome' => 'Rafael Costa',     'servico' => 'Barba + Sobrancelha',  'status' => 'Confirmado', 'telefone' => '(11) 91234-5678', 'email' => 'rafael.costa@email.com'],
            ['hora' => '13:00', 'data' => '24/09/2026', 'inicial' => 'G', 'nome' => 'Gabriel Santos',   'servico' => 'Corte + Barba',        'status' => 'Confirmado', 'telefone' => '(11) 99988-7766', 'email' => 'gabriel.santos@email.com'],
            ['hora' => '15:30', 'data' => '24/09/2026', 'inicial' => 'F', 'nome' => 'Felipe Martins',   'servico' => 'Corte masculino',      'status' => 'Pendente',   'telefone' => '(11) 97777-1122', 'email' => 'felipe.martins@email.com'],
            ['hora' => '16:45', 'data' => '25/09/2026', 'inicial' => 'M', 'nome' => 'Marcelo Souza',    'servico' => 'Corte + Barba',        'status' => 'Confirmado', 'telefone' => '(11) 93333-2222', 'email' => 'marcelo.souza@email.com'],
            ['hora' => '18:00', 'data' => '25/09/2026', 'inicial' => 'T', 'nome' => 'Thiago Lima',      'servico' => 'Corte masculino',      'status' => 'Pendente',   'telefone' => '(11) 94444-1111', 'email' => 'thiago.lima@email.com'],
            ['hora' => '09:30', 'data' => '26/09/2026', 'inicial' => 'I', 'nome' => 'Igor Batista',     'servico' => 'Sobrancelha',          'status' => 'Confirmado', 'telefone' => '(11) 96666-3344', 'email' => 'igor.batista@email.com'],
            ['hora' => '11:15', 'data' => '26/09/2026', 'inicial' => 'H', 'nome' => 'Henrique Souza',   'servico' => 'Corte + Barba',        'status' => 'Pendente',   'telefone' => '(11) 95555-6677', 'email' => 'henrique.souza@email.com'],
            ['hora' => '14:00', 'data' => '27/09/2026', 'inicial' => 'D', 'nome' => 'Diego Ramos',      'servico' => 'Barba',                'status' => 'Confirmado', 'telefone' => '(11) 92222-8899', 'email' => 'diego.ramos@email.com'],
            ['hora' => '17:30', 'data' => '27/09/2026', 'inicial' => 'E', 'nome' => 'Eduardo Nunes',    'servico' => 'Sobrancelha',          'status' => 'Confirmado', 'telefone' => '(11) 91111-4455', 'email' => 'eduardo.nunes@email.com'],
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

        // TODO: troque pelos pagamentos reais (ex.: Pagamento::orderByDesc('dia')->get())
        $pagamentos = [
            ['nome' => 'Lucas Almeida',  'cpf' => '123.456.789-01', 'dia' => '25/09/2026', 'servico' => 'Corte masculino',     'valor' => 45.00],
            ['nome' => 'Marcelo Souza',  'cpf' => '234.567.891-02', 'dia' => '25/09/2026', 'servico' => 'Corte + Barba',       'valor' => 70.00],
            ['nome' => 'Thiago Lima',    'cpf' => '345.678.912-03', 'dia' => '25/09/2026', 'servico' => 'Corte masculino',     'valor' => 45.00],
            ['nome' => 'Felipe Martins', 'cpf' => '456.789.123-04', 'dia' => '24/09/2026', 'servico' => 'Corte masculino',     'valor' => 45.00],
            ['nome' => 'Gabriel Santos', 'cpf' => '567.891.234-05', 'dia' => '24/09/2026', 'servico' => 'Corte + Barba',       'valor' => 70.00],
            ['nome' => 'Rafael Costa',   'cpf' => '678.912.345-06', 'dia' => '24/09/2026', 'servico' => 'Barba + Sobrancelha', 'valor' => 60.00],
            ['nome' => 'Igor Batista',   'cpf' => '789.123.456-07', 'dia' => '23/09/2026', 'servico' => 'Sobrancelha',         'valor' => 25.00],
            ['nome' => 'Henrique Souza', 'cpf' => '891.234.567-08', 'dia' => '23/09/2026', 'servico' => 'Corte + Barba',       'valor' => 70.00],
            ['nome' => 'Diego Ramos',    'cpf' => '912.345.678-09', 'dia' => '22/09/2026', 'servico' => 'Barba',               'valor' => 30.00],
            ['nome' => 'Eduardo Nunes',  'cpf' => '123.987.654-10', 'dia' => '21/09/2026', 'servico' => 'Sobrancelha',         'valor' => 25.00],
        ];

        return view('portfolio.barbearia.financeiro', [
            'resumoMes' => $resumoMes,
            'serieMes' => $serieMes,
            'pagamentos' => $pagamentos,
        ]);
    }

    /**
     * Tela de Maquinário (rota: barbearia.maquinario).
     */
    public function maquinario()
    {
        // TODO: troque pelos setores/equipamentos reais (ex.: Setor::with('equipamentos')->get())
        // IMPORTANTE: a view espera a variável $setores (array de setores, cada um com sua
        // lista de 'equipamentos'), e não uma lista solta de equipamentos.
        $setores = [
            [
                'nome' => 'Estação 1',
                'equipamentos' => [
                    ['nome' => 'Máquina de corte',      'status' => 'Ativa', 'barbeiro' => 'Lucas Almeida'],
                    ['nome' => 'Secador',               'status' => 'Ativa', 'barbeiro' => 'Lucas Almeida'],
                ],
            ],
            [
                'nome' => 'Estação 2',
                'equipamentos' => [
                    ['nome' => 'Máquina de acabamento', 'status' => 'Ativa',      'barbeiro' => 'Rafael Costa'],
                    ['nome' => 'Máquina de corte',      'status' => 'Manutenção', 'barbeiro' => 'Rafael Costa'],
                ],
            ],
            [
                'nome' => 'Estação 3',
                'equipamentos' => [
                    ['nome' => 'Secador',               'status' => 'Ativa', 'barbeiro' => 'Gabriel Santos'],
                    ['nome' => 'Máquina de corte',      'status' => 'Ativa', 'barbeiro' => 'Gabriel Santos'],
                    ['nome' => 'Máquina de acabamento', 'status' => 'Ativa', 'barbeiro' => 'Gabriel Santos'],
                ],
            ],
            [
                'nome' => 'Estação 4',
                'equipamentos' => [
                    ['nome' => 'Máquina de corte',      'status' => 'Ativa',   'barbeiro' => 'Thiago Lima'],
                    ['nome' => 'Secador',               'status' => 'Inativa', 'barbeiro' => 'Thiago Lima'],
                    ['nome' => 'Máquina de acabamento', 'status' => 'Ativa',   'barbeiro' => 'Thiago Lima'],
                ],
            ],
        ];

        return view('portfolio.barbearia.maquinario', [
            'setores' => $setores,
        ]);
    }

    /**
     * Tela de Funcionários (rota: barbearia.funcionario).
     */
    public function funcionario()
    {
        // TODO: troque pelos funcionários reais (ex.: Funcionario::all())
        $funcionarios = [
            ['nome' => 'Lucas Almeida',   'cargo' => 'Barbeiro',            'telefone' => '(11) 98765-4321', 'email' => 'lucas.almeida@email.com',   'status' => 'Ativo',   'atendimentosMes' => 42],
            ['nome' => 'Rafael Costa',    'cargo' => 'Barbeiro',            'telefone' => '(11) 91234-5678', 'email' => 'rafael.costa@email.com',    'status' => 'Ativo',   'atendimentosMes' => 38],
            ['nome' => 'Gabriel Santos',  'cargo' => 'Barbeiro',            'telefone' => '(11) 99988-7766', 'email' => 'gabriel.santos@email.com',  'status' => 'Ativo',   'atendimentosMes' => 35],
            ['nome' => 'Thiago Lima',     'cargo' => 'Barbeiro',            'telefone' => '(11) 94444-1111', 'email' => 'thiago.lima@email.com',     'status' => 'Ativo',   'atendimentosMes' => 30],
            ['nome' => 'Felipe Martins',  'cargo' => 'Barbeiro Júnior',     'telefone' => '(11) 97777-1122', 'email' => 'felipe.martins@email.com',  'status' => 'Ativo',   'atendimentosMes' => 27],
            ['nome' => 'Marcelo Souza',   'cargo' => 'Barbeiro',            'telefone' => '(11) 93333-2222', 'email' => 'marcelo.souza@email.com',   'status' => 'Ativo',   'atendimentosMes' => 33],
            ['nome' => 'Igor Batista',    'cargo' => 'Recepcionista',       'telefone' => '(11) 96666-3344', 'email' => 'igor.batista@email.com',    'status' => 'Ativo',   'atendimentosMes' => 0],
            ['nome' => 'Henrique Souza',  'cargo' => 'Barbeiro Júnior',     'telefone' => '(11) 95555-6677', 'email' => 'henrique.souza@email.com',  'status' => 'Inativo', 'atendimentosMes' => 12],
            ['nome' => 'Diego Ramos',     'cargo' => 'Barbeiro',            'telefone' => '(11) 92222-8899', 'email' => 'diego.ramos@email.com',     'status' => 'Ativo',   'atendimentosMes' => 29],
            ['nome' => 'Eduardo Nunes',   'cargo' => 'Auxiliar de limpeza', 'telefone' => '(11) 91111-4455', 'email' => 'eduardo.nunes@email.com',   'status' => 'Ativo',   'atendimentosMes' => 0],
        ];

        return view('portfolio.barbearia.funcionario', [
            'funcionarios' => $funcionarios,
        ]);
    }
}