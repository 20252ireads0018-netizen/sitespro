<?php

namespace App\Http\Controllers;

class EstudioController extends Controller
{
    public function projetos()
    {
        $projetos = [
            ['nome' => 'Casa Ribeirão',        'cliente' => 'Família Andrade',     'tipo' => 'Residencial',    'local' => 'Curitiba, PR',       'area' => 320,  'fase' => 3, 'prazo' => now()->addMonths(5),  'responsavel' => 'Helena Duarte',  'imagem' => $this->acharImagem('casa-ribeirao.jpg')],
            ['nome' => 'Edifício Alameda',     'cliente' => 'Incorporadora Norte', 'tipo' => 'Multifamiliar',  'local' => 'São Paulo, SP',      'area' => 4800, 'fase' => 1, 'prazo' => now()->addMonths(14), 'responsavel' => 'Rafael Menezes', 'imagem' => $this->acharImagem('edificio-alameda.jpg')],
            ['nome' => 'Café Bosque',          'cliente' => 'Grupo Bosque',        'tipo' => 'Comercial',      'local' => 'Florianópolis, SC',  'area' => 140,  'fase' => 4, 'prazo' => now()->subDays(10),   'responsavel' => 'Camila Torres',  'imagem' => $this->acharImagem('cafe-bosque.jpg')],
            ['nome' => 'Clínica Vida',         'cliente' => 'Dr. Marcos Leal',     'tipo' => 'Saúde',          'local' => 'Belo Horizonte, MG', 'area' => 260,  'fase' => 2, 'prazo' => now()->addMonths(8),  'responsavel' => 'Helena Duarte',  'imagem' => $this->acharImagem('clinica-vida.jpg')],
            ['nome' => 'Sítio das Palmeiras',  'cliente' => 'Beatriz Salgado',     'tipo' => 'Residencial',    'local' => 'Campinas, SP',       'area' => 410,  'fase' => 0, 'prazo' => now()->addMonths(18), 'responsavel' => 'Rafael Menezes', 'imagem' => $this->acharImagem('sitio-palmeiras.jpg')],
            ['nome' => 'Escritório Vértice',   'cliente' => 'Vértice Engenharia',  'tipo' => 'Corporativo',    'local' => 'Porto Alegre, RS',   'area' => 580,  'fase' => 3, 'prazo' => now()->addMonths(3),  'responsavel' => 'Camila Torres',  'imagem' => $this->acharImagem('escritorio-vertice.jpg')],
        ];

        return view('portfolio.Estudio.projetos', compact('projetos'));
    }

    public function ideias()
    {
        $ideias = [
            ['titulo' => 'Biblioteca de detalhes construtivos', 'descricao' => 'Reunir detalhes de esquadrias, rodapés e encontros de piso já resolvidos para reaproveitar.', 'autor' => 'Camila Torres',  'categoria' => 'Processo',         'votos' => 7,  'coluna' => 'Nova',       'data' => now()->subDays(2)],
            ['titulo' => 'Maquete física em impressão 3D',      'descricao' => 'Produzir maquetes de volumetria para apresentar aos clientes na etapa de estudo.',           'autor' => 'Rafael Menezes', 'categoria' => 'Processo',         'votos' => 4,  'coluna' => 'Nova',       'data' => now()->subDays(4)],
            ['titulo' => 'Newsletter trimestral de obras',      'descricao' => 'Enviar aos clientes e parceiros um resumo com fotos do andamento dos projetos.',            'autor' => 'Helena Duarte',  'categoria' => 'Marca',            'votos' => 3,  'coluna' => 'Nova',       'data' => now()->subDays(6)],
            ['titulo' => 'Parceria com marcenaria local',       'descricao' => 'Fechar condições especiais com uma marcenaria para mobiliário sob medida.',                  'autor' => 'Rafael Menezes', 'categoria' => 'Materiais',        'votos' => 9,  'coluna' => 'Em análise', 'data' => now()->subDays(11)],
            ['titulo' => 'Checklist de sustentabilidade',       'descricao' => 'Lista de verificação para ventilação, reuso de água e materiais em todo novo projeto.',      'autor' => 'Helena Duarte',  'categoria' => 'Sustentabilidade', 'votos' => 12, 'coluna' => 'Em análise', 'data' => now()->subDays(15)],
            ['titulo' => 'Telhado verde no Café Bosque',        'descricao' => 'Propor cobertura vegetada na ampliação para melhorar o conforto térmico.',                   'autor' => 'Camila Torres',  'categoria' => 'Sustentabilidade', 'votos' => 10, 'coluna' => 'Aprovada',   'data' => now()->subDays(25)],
            ['titulo' => 'Padronizar pranchas em A1',           'descricao' => 'Adotar um único formato e carimbo para todas as pranchas entregues.',                        'autor' => 'Rafael Menezes', 'categoria' => 'Processo',         'votos' => 8,  'coluna' => 'Aprovada',   'data' => now()->subDays(32)],
            ['titulo' => 'Painel de acompanhamento do cliente', 'descricao' => 'Página simples em que o cliente vê a fase atual e as próximas entregas do seu projeto.',      'autor' => 'Helena Duarte',  'categoria' => 'Marca',            'votos' => 6,  'coluna' => 'Aprovada',   'data' => now()->subDays(40)],
        ];

        return view('portfolio.Estudio.ideias', compact('ideias'));
    }

    public function financeiro()
    {
        $lancamentos = [
            ['data' => now()->subDays(3),  'descricao' => 'Honorários · parcela 4',            'projeto' => 'Casa Ribeirão',       'tipo' => 'Entrada', 'valor' => 8500.00,  'status' => 'Pago'],
            ['data' => now()->addDays(9),  'descricao' => 'Honorários · etapa de anteprojeto', 'projeto' => 'Edifício Alameda',    'tipo' => 'Entrada', 'valor' => 24000.00, 'status' => 'Pendente'],
            ['data' => now()->subDays(8),  'descricao' => 'Consultoria de paisagismo',         'projeto' => 'Café Bosque',         'tipo' => 'Entrada', 'valor' => 6200.00,  'status' => 'Pago'],
            ['data' => now()->subDays(15), 'descricao' => 'Honorários · parcela 2',            'projeto' => 'Clínica Vida',        'tipo' => 'Entrada', 'valor' => 7800.00,  'status' => 'Atrasado'],
            ['data' => now()->subDays(5),  'descricao' => 'Honorários · parcela 3',            'projeto' => 'Escritório Vértice',  'tipo' => 'Entrada', 'valor' => 15400.00, 'status' => 'Pago'],
            ['data' => now()->subDays(1),  'descricao' => 'Aluguel do estúdio',                'projeto' => 'Geral',               'tipo' => 'Saída',   'valor' => 4200.00,  'status' => 'Pago'],
            ['data' => now()->subDays(2),  'descricao' => 'Licenças de software',              'projeto' => 'Geral',               'tipo' => 'Saída',   'valor' => 1890.00,  'status' => 'Pago'],
            ['data' => now()->subDays(6),  'descricao' => 'Impressão de pranchas',             'projeto' => 'Escritório Vértice',  'tipo' => 'Saída',   'valor' => 640.00,   'status' => 'Pago'],
            ['data' => now()->subDays(4),  'descricao' => 'Salários da equipe',                'projeto' => 'Geral',               'tipo' => 'Saída',   'valor' => 22500.00, 'status' => 'Pago'],
            ['data' => now()->addDays(5),  'descricao' => 'Maquete de volumetria',             'projeto' => 'Sítio das Palmeiras', 'tipo' => 'Saída',   'valor' => 1350.00,  'status' => 'Pendente'],
        ];

        $abreviacoes = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];
        $valores = [
            [38200, 31500],
            [42600, 33100],
            [35800, 32400],
            [47100, 34800],
            [40300, 33900],
            [44700, 35200],
        ];

        $meses = [];
        foreach ($valores as $i => [$receita, $despesa]) {
            $data = now()->subMonths(5 - $i);
            $meses[] = [
                'mes'     => $abreviacoes[$data->month - 1],
                'receita' => $receita,
                'despesa' => $despesa,
            ];
        }

        return view('portfolio.Estudio.financeiro', compact('lancamentos', 'meses'));
    }

    public function contratos()
    {
        $ano = now()->year;

        $contratos = [
            ['numero' => "CT-{$ano}-014", 'cliente' => 'Família Andrade',     'projeto' => 'Casa Ribeirão',            'valor' => 86000.00,  'inicio' => now()->subMonths(8), 'fim' => now()->addMonths(6),   'status' => 'Ativo'],
            ['numero' => "CT-{$ano}-015", 'cliente' => 'Incorporadora Norte', 'projeto' => 'Edifício Alameda',         'valor' => 240000.00, 'inicio' => now()->subMonths(3), 'fim' => now()->addMonths(13),  'status' => 'Ativo'],
            ['numero' => "CT-{$ano}-016", 'cliente' => 'Grupo Bosque',        'projeto' => 'Café Bosque',              'valor' => 32000.00,  'inicio' => now()->subMonths(9), 'fim' => now()->subDays(10),    'status' => 'Encerrado'],
            ['numero' => "CT-{$ano}-017", 'cliente' => 'Dr. Marcos Leal',     'projeto' => 'Clínica Vida',             'valor' => 62000.00,  'inicio' => now()->subMonths(2), 'fim' => now()->addMonths(9),   'status' => 'Ativo'],
            ['numero' => "CT-{$ano}-018", 'cliente' => 'Beatriz Salgado',     'projeto' => 'Sítio das Palmeiras',      'valor' => 98000.00,  'inicio' => now()->addDays(10),  'fim' => now()->addMonths(18),  'status' => 'Aguardando assinatura'],
            ['numero' => "CT-{$ano}-019", 'cliente' => 'Vértice Engenharia',  'projeto' => 'Escritório Vértice',       'valor' => 140000.00, 'inicio' => now()->subMonths(6), 'fim' => now()->addDays(22),    'status' => 'Ativo'],
            ['numero' => "CT-{$ano}-020", 'cliente' => 'Grupo Bosque',        'projeto' => 'Ampliação do Café Bosque', 'valor' => 18000.00,  'inicio' => now()->addDays(20),  'fim' => now()->addMonths(4),   'status' => 'Em revisão'],
        ];

        return view('portfolio.Estudio.contratos', compact('contratos'));
    }

    public function contatos()
    {
        $contatos = [
            ['nome' => 'Paulo Andrade',      'cargo' => 'Proprietário',       'empresa' => 'Família Andrade',     'tipo' => 'Cliente',     'telefone' => '(41) 99000-1101', 'email' => 'paulo@exemplo.com',      'projeto' => 'Casa Ribeirão'],
            ['nome' => 'Luciana Prado',      'cargo' => 'Diretora comercial', 'empresa' => 'Incorporadora Norte', 'tipo' => 'Cliente',     'telefone' => '(11) 99000-1102', 'email' => 'luciana@exemplo.com',    'projeto' => 'Edifício Alameda'],
            ['nome' => 'Marcos Leal',        'cargo' => 'Médico',             'empresa' => 'Clínica Vida',        'tipo' => 'Cliente',     'telefone' => '(31) 99000-1103', 'email' => 'marcos@exemplo.com',     'projeto' => 'Clínica Vida'],
            ['nome' => 'Beatriz Salgado',    'cargo' => 'Proprietária',       'empresa' => 'Sítio das Palmeiras', 'tipo' => 'Cliente',     'telefone' => '(19) 99000-1104', 'email' => 'beatriz@exemplo.com',    'projeto' => 'Sítio das Palmeiras'],
            ['nome' => 'Rogério Batista',    'cargo' => 'Vendedor',           'empresa' => 'Marcenaria Batista',  'tipo' => 'Fornecedor',  'telefone' => '(11) 99000-1105', 'email' => 'rogerio@exemplo.com',    'projeto' => 'Café Bosque'],
            ['nome' => 'Sandra Freitas',     'cargo' => 'Representante',      'empresa' => 'Pedras & Revestimentos', 'tipo' => 'Fornecedor', 'telefone' => '(48) 99000-1106', 'email' => 'sandra@exemplo.com',   'projeto' => 'Casa Ribeirão'],
            ['nome' => 'Eduardo Klein',      'cargo' => 'Engenheiro estrutural', 'empresa' => 'Klein Estruturas', 'tipo' => 'Consultor',   'telefone' => '(51) 99000-1107', 'email' => 'eduardo@exemplo.com',    'projeto' => 'Edifício Alameda'],
            ['nome' => 'Renata Moura',       'cargo' => 'Paisagista',         'empresa' => 'Moura Paisagismo',    'tipo' => 'Consultor',   'telefone' => '(48) 99000-1108', 'email' => 'renata@exemplo.com',     'projeto' => 'Café Bosque'],
            ['nome' => 'Tiago Vasconcelos',  'cargo' => 'Mestre de obras',    'empresa' => 'Vasconcelos Construções', 'tipo' => 'Construtora', 'telefone' => '(41) 99000-1109', 'email' => 'tiago@exemplo.com',   'projeto' => 'Casa Ribeirão'],
            ['nome' => 'Fernanda Rocha',     'cargo' => 'Gerente de obras',   'empresa' => 'Rocha & Filhos',      'tipo' => 'Construtora', 'telefone' => '(51) 99000-1110', 'email' => 'fernanda@exemplo.com',   'projeto' => 'Escritório Vértice'],
        ];

        return view('portfolio.Estudio.contatos', compact('contatos'));
    }

    /**
     * Procura a foto pelo NOME do arquivo em qualquer subpasta de /public.
     * Retorna o caminho relativo (para usar com asset()) ou null se não existir.
     */
    private function acharImagem(string $arquivo): ?string
    {
        $base = public_path();
        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($base, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($it as $f) {
            if ($f->isFile() && strcasecmp($f->getFilename(), $arquivo) === 0) {
                return str_replace('\\', '/', substr($f->getPathname(), strlen($base) + 1));
            }
        }

        return null;
    }
}