<?php

namespace App\Http\Controllers;

/**
 * Site ilustrativo de clínica de estética.
 * Todos os dados abaixo são fictícios (TODO: trocar por consultas reais ao banco).
 *
 * Views ficam em resources/views/portfolio/Estetica/
 * (pasta "Estetica", com "SiteClinica.blade.php" iniciando maiúsculo — confira o case exato dos arquivos).
 */
class ClinicaController extends Controller
{
    /** Tela inicial / Agenda (rotas: clinica.agenda e siteClinica). */
    public function agenda()
    {
        $agendamentos = [
            ['data' => '28/09/2026', 'hora' => '08:30', 'nome' => 'Camila Ferreira',  'procedimento' => 'Limpeza de pele profunda', 'profissional' => 'Marina Souza',      'status' => 'Concluído',  'telefone' => '(11) 98111-2001'],
            ['data' => '28/09/2026', 'hora' => '10:00', 'nome' => 'Beatriz Andrade',  'procedimento' => 'Drenagem linfática',       'profissional' => 'Patrícia Lima',     'status' => 'Confirmado', 'telefone' => '(11) 98111-2002'],
            ['data' => '28/09/2026', 'hora' => '11:30', 'nome' => 'Luana Barros',     'procedimento' => 'Peeling de diamante',      'profissional' => 'Renata Alves',      'status' => 'Confirmado', 'telefone' => '(11) 98111-2003'],
            ['data' => '28/09/2026', 'hora' => '14:00', 'nome' => 'Sofia Martins',    'procedimento' => 'Depilação a laser',        'profissional' => 'Juliana Prado',     'status' => 'Pendente',   'telefone' => '(11) 98111-2004'],
            ['data' => '28/09/2026', 'hora' => '16:00', 'nome' => 'Isabela Cardoso',  'procedimento' => 'Microagulhamento',         'profissional' => 'Dra. Helena Duarte', 'status' => 'Confirmado', 'telefone' => '(11) 98111-2005'],
            ['data' => '29/09/2026', 'hora' => '09:00', 'nome' => 'Mariana Teixeira', 'procedimento' => 'Massagem relaxante',       'profissional' => 'Patrícia Lima',     'status' => 'Confirmado', 'telefone' => '(11) 98111-2006'],
            ['data' => '29/09/2026', 'hora' => '10:30', 'nome' => 'Vanessa Lopes',    'procedimento' => 'Design de sobrancelhas',   'profissional' => 'Fernanda Melo',     'status' => 'Pendente',   'telefone' => '(11) 98111-2007'],
            ['data' => '29/09/2026', 'hora' => '13:30', 'nome' => 'Priscila Gomes',   'procedimento' => 'Maquiagem social',         'profissional' => 'Bianca Rocha',      'status' => 'Confirmado', 'telefone' => '(11) 98111-2008'],
            ['data' => '30/09/2026', 'hora' => '09:30', 'nome' => 'Talita Ribeiro',   'procedimento' => 'Radiofrequência facial',   'profissional' => 'Juliana Prado',     'status' => 'Pendente',   'telefone' => '(11) 98111-2009'],
            ['data' => '30/09/2026', 'hora' => '15:00', 'nome' => 'Amanda Vieira',    'procedimento' => 'Criolipólise',             'profissional' => 'Marina Souza',      'status' => 'Confirmado', 'telefone' => '(11) 98111-2010'],
        ];

        $resumoHoje = [
            'agendamentosHoje'   => 5,
            'faturamento'        => 1240.00,
            'clientesMes'        => 168,
            'profissionaisAtivos' => 9,
        ];

        return view('portfolio.Estetica.SiteClinica', compact('agendamentos', 'resumoHoje'));
    }

    /** Financeiro (rota: clinica.financeiro). */
    public function financeiro()
    {
        $meses = [1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho',
                  7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'];
        $mesAtual = $meses[(int) now()->format('n')] . ' de ' . now()->format('Y');

        $resumoMes = [
            'faturamento'          => 18450.00,
            'gastos'               => 6320.00,
            'agendamentosMes'      => 214,
            'variacaoFaturamento'  => 14,
            'variacaoGastos'       => -4,
            'variacaoAgendamentos' => 11,
        ];

        $serieMes = [
            ['label' => 'Semana 1', 'faturamento' => 4100, 'gastos' => 1400],
            ['label' => 'Semana 2', 'faturamento' => 4650, 'gastos' => 1550],
            ['label' => 'Semana 3', 'faturamento' => 4420, 'gastos' => 1620],
            ['label' => 'Semana 4', 'faturamento' => 5280, 'gastos' => 1750],
        ];

        $pagamentos = [
            ['nome' => 'Camila Ferreira',  'procedimento' => 'Limpeza de pele profunda', 'dia' => '28/09/2026', 'forma' => 'Pix',      'valor' => 180.00],
            ['nome' => 'Beatriz Andrade',  'procedimento' => 'Drenagem linfática',       'dia' => '28/09/2026', 'forma' => 'Cartão',   'valor' => 150.00],
            ['nome' => 'Luana Barros',     'procedimento' => 'Peeling de diamante',      'dia' => '27/09/2026', 'forma' => 'Pix',      'valor' => 220.00],
            ['nome' => 'Sofia Martins',    'procedimento' => 'Depilação a laser',        'dia' => '27/09/2026', 'forma' => 'Cartão',   'valor' => 260.00],
            ['nome' => 'Isabela Cardoso',  'procedimento' => 'Microagulhamento',         'dia' => '26/09/2026', 'forma' => 'Cartão',   'valor' => 420.00],
            ['nome' => 'Mariana Teixeira', 'procedimento' => 'Massagem relaxante',       'dia' => '26/09/2026', 'forma' => 'Dinheiro', 'valor' => 140.00],
            ['nome' => 'Vanessa Lopes',    'procedimento' => 'Design de sobrancelhas',   'dia' => '25/09/2026', 'forma' => 'Pix',      'valor' => 60.00],
            ['nome' => 'Priscila Gomes',   'procedimento' => 'Maquiagem social',         'dia' => '25/09/2026', 'forma' => 'Cartão',   'valor' => 200.00],
            ['nome' => 'Talita Ribeiro',   'procedimento' => 'Radiofrequência facial',   'dia' => '24/09/2026', 'forma' => 'Pix',      'valor' => 280.00],
            ['nome' => 'Amanda Vieira',    'procedimento' => 'Criolipólise',             'dia' => '24/09/2026', 'forma' => 'Cartão',   'valor' => 690.00],
        ];

        return view('portfolio.Estetica.financeiro', compact('mesAtual', 'resumoMes', 'serieMes', 'pagamentos'));
    }

    /** Maquinário: aparelhos por sala (rota: clinica.maquinario). */
    public function maquinario()
    {
        $salas = [
            ['nome' => 'Sala 1 · Facial', 'aparelhos' => [
                ['nome' => 'Peeling de diamante',  'status' => 'Ativo',      'responsavel' => 'Renata Alves',       'manutencao' => '15/11/2026'],
                ['nome' => 'Radiofrequência',      'status' => 'Ativo',      'responsavel' => 'Juliana Prado',      'manutencao' => '02/12/2026'],
                ['nome' => 'Microagulhamento',     'status' => 'Ativo',      'responsavel' => 'Dra. Helena Duarte', 'manutencao' => '20/11/2026'],
            ]],
            ['nome' => 'Sala 2 · Corporal', 'aparelhos' => [
                ['nome' => 'Criolipólise',         'status' => 'Ativo',      'responsavel' => 'Marina Souza',       'manutencao' => '10/12/2026'],
                ['nome' => 'Ultrassom estético',   'status' => 'Manutenção', 'responsavel' => 'Marina Souza',       'manutencao' => '29/09/2026'],
                ['nome' => 'Vacuoterapia',         'status' => 'Ativo',      'responsavel' => 'Patrícia Lima',      'manutencao' => '05/01/2027'],
            ]],
            ['nome' => 'Sala 3 · Laser e luz', 'aparelhos' => [
                ['nome' => 'Laser de diodo',       'status' => 'Ativo',      'responsavel' => 'Juliana Prado',      'manutencao' => '18/12/2026'],
                ['nome' => 'Luz pulsada',          'status' => 'Inativo',    'responsavel' => 'Juliana Prado',      'manutencao' => '—'],
                ['nome' => 'LED terapia',          'status' => 'Ativo',      'responsavel' => 'Fernanda Melo',      'manutencao' => '12/01/2027'],
                ['nome' => 'Vapor de ozônio',      'status' => 'Ativo',      'responsavel' => 'Renata Alves',       'manutencao' => '25/11/2026'],
            ]],
        ];

        return view('portfolio.Estetica.maquinario', compact('salas'));
    }

    /** Estoque de equipamentos (peças/acessórios) e de maquiagens (rota: clinica.estoque). */
    public function estoque()
{
    $produtos = [
        ['codigo' => 'MAQ-001', 'nome' => 'Base líquida HD tom 30',      'marca' => 'Lumière',   'categoria' => 'Maquiagem', 'quantidade' => 14, 'minimo' => 6,  'preco' => 48.90,  'validade' => now()->addMonths(14)],
        ['codigo' => 'MAQ-002', 'nome' => 'Batom cremoso rosé',          'marca' => 'Lumière',   'categoria' => 'Maquiagem', 'quantidade' => 4,  'minimo' => 8,  'preco' => 22.50,  'validade' => now()->addMonths(9)],
        ['codigo' => 'MAQ-003', 'nome' => 'Máscara de cílios preta',     'marca' => 'Bella Cor', 'categoria' => 'Maquiagem', 'quantidade' => 10, 'minimo' => 5,  'preco' => 31.00,  'validade' => now()->addDays(40)],
        ['codigo' => 'CAB-001', 'nome' => 'Shampoo reconstrutor 1L',     'marca' => 'Fio de Ouro', 'categoria' => 'Cabelo',  'quantidade' => 12, 'minimo' => 5,  'preco' => 59.90,  'validade' => now()->addMonths(20)],
        ['codigo' => 'CAB-002', 'nome' => 'Máscara de hidratação 500g',  'marca' => 'Fio de Ouro', 'categoria' => 'Cabelo',  'quantidade' => 3,  'minimo' => 6,  'preco' => 74.00,  'validade' => now()->addMonths(11)],
        ['codigo' => 'CAB-003', 'nome' => 'Ampola de brilho (caixa 10)', 'marca' => 'Silk Pro',  'categoria' => 'Cabelo',    'quantidade' => 0,  'minimo' => 4,  'preco' => 89.90,  'validade' => now()->addMonths(6)],
        ['codigo' => 'PEL-001', 'nome' => 'Sérum de vitamina C 30ml',    'marca' => 'Derma Aura', 'categoria' => 'Pele',    'quantidade' => 18, 'minimo' => 8,  'preco' => 96.00,  'validade' => now()->addMonths(10)],
        ['codigo' => 'PEL-002', 'nome' => 'Protetor solar FPS 60',       'marca' => 'Derma Aura', 'categoria' => 'Pele',    'quantidade' => 7,  'minimo' => 10, 'preco' => 54.90,  'validade' => now()->addDays(25)],
        ['codigo' => 'PEL-003', 'nome' => 'Ácido hialurônico 50ml',      'marca' => 'Derma Aura', 'categoria' => 'Pele',    'quantidade' => 9,  'minimo' => 4,  'preco' => 128.00, 'validade' => now()->addMonths(16)],
        ['codigo' => 'PEL-004', 'nome' => 'Máscara facial de argila',    'marca' => 'Puro Bem',  'categoria' => 'Pele',      'quantidade' => 11, 'minimo' => 5,  'preco' => 38.00,  'validade' => now()->subDays(12)],
        ['codigo' => 'COR-001', 'nome' => 'Óleo de massagem 250ml',      'marca' => 'Puro Bem',  'categoria' => 'Corpo',     'quantidade' => 15, 'minimo' => 6,  'preco' => 42.00,  'validade' => now()->addMonths(18)],
        ['codigo' => 'COR-002', 'nome' => 'Creme modelador corporal',    'marca' => 'Puro Bem',  'categoria' => 'Corpo',     'quantidade' => 5,  'minimo' => 5,  'preco' => 67.50,  'validade' => now()->addMonths(8)],
        ['codigo' => 'UNH-001', 'nome' => 'Esmalte gel nude',            'marca' => 'Bella Cor', 'categoria' => 'Unhas',     'quantidade' => 20, 'minimo' => 8,  'preco' => 16.90,  'validade' => now()->addMonths(22)],
        ['codigo' => 'UNH-002', 'nome' => 'Removedor de esmalte 500ml',  'marca' => 'Bella Cor', 'categoria' => 'Unhas',     'quantidade' => 2,  'minimo' => 4,  'preco' => 14.50,  'validade' => now()->addMonths(12)],
    ];

    return view('portfolio.Estetica.estoque', compact('produtos'));
}

    /** Funcionários (rota: clinica.funcionario). */
    public function funcionario()
    {
        $funcionarios = [
            ['nome' => 'Dra. Helena Duarte', 'cargo' => 'Dermatologista',        'telefone' => '(11) 97001-1001', 'email' => 'helena.duarte@clinicaaura.com', 'status' => 'Ativo',   'atendimentosMes' => 34],
            ['nome' => 'Marina Souza',       'cargo' => 'Esteticista',           'telefone' => '(11) 97001-1002', 'email' => 'marina.souza@clinicaaura.com',  'status' => 'Ativo',   'atendimentosMes' => 52],
            ['nome' => 'Juliana Prado',      'cargo' => 'Biomédica esteta',      'telefone' => '(11) 97001-1003', 'email' => 'juliana.prado@clinicaaura.com', 'status' => 'Ativo',   'atendimentosMes' => 47],
            ['nome' => 'Patrícia Lima',      'cargo' => 'Massoterapeuta',        'telefone' => '(11) 97001-1004', 'email' => 'patricia.lima@clinicaaura.com', 'status' => 'Ativo',   'atendimentosMes' => 41],
            ['nome' => 'Renata Alves',       'cargo' => 'Cosmetóloga',           'telefone' => '(11) 97001-1005', 'email' => 'renata.alves@clinicaaura.com',  'status' => 'Ativo',   'atendimentosMes' => 38],
            ['nome' => 'Bianca Rocha',       'cargo' => 'Maquiadora',            'telefone' => '(11) 97001-1006', 'email' => 'bianca.rocha@clinicaaura.com',  'status' => 'Ativo',   'atendimentosMes' => 29],
            ['nome' => 'Fernanda Melo',      'cargo' => 'Esteticista',           'telefone' => '(11) 97001-1007', 'email' => 'fernanda.melo@clinicaaura.com', 'status' => 'Ativo',   'atendimentosMes' => 44],
            ['nome' => 'Larissa Nunes',      'cargo' => 'Recepcionista',         'telefone' => '(11) 97001-1008', 'email' => 'larissa.nunes@clinicaaura.com', 'status' => 'Ativo',   'atendimentosMes' => 0],
            ['nome' => 'Aline Costa',        'cargo' => 'Depiladora',            'telefone' => '(11) 97001-1009', 'email' => 'aline.costa@clinicaaura.com',   'status' => 'Inativo', 'atendimentosMes' => 9],
            ['nome' => 'Carolina Pires',     'cargo' => 'Auxiliar de estética',  'telefone' => '(11) 97001-1010', 'email' => 'carolina.pires@clinicaaura.com', 'status' => 'Ativo',  'atendimentosMes' => 0],
        ];

        return view('portfolio.Estetica.funcionario', compact('funcionarios'));
    }
}