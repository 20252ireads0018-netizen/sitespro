<?php

namespace App\Http\Controllers;

class LojaController extends Controller
{
    public function produtos()
    {
        $produtos = [
            ['nome' => 'Vestido Midi Floral',    'categoria' => 'Vestidos',  'preco' => 189.90, 'tamanhos' => ['P', 'M', 'G'],       'cor' => 'Rosa', 'estoque' => 14, 'destaque' => true],
            ['nome' => 'Vestido Longo Linho',     'categoria' => 'Vestidos',  'preco' => 249.90, 'tamanhos' => ['P', 'M', 'G', 'GG'], 'cor' => 'Bege', 'estoque' => 6,  'destaque' => false],
            ['nome' => 'Blusa Cropped Canelada',  'categoria' => 'Blusas',    'preco' => 89.90,  'tamanhos' => ['PP', 'P', 'M'],      'cor' => 'Branco', 'estoque' => 22, 'destaque' => true],
            ['nome' => 'Blusa Manga Bufante',      'categoria' => 'Blusas',    'preco' => 109.90, 'tamanhos' => ['P', 'M', 'G'],       'cor' => 'Vermelho', 'estoque' => 0,  'destaque' => false],
            ['nome' => 'Calça Wide Leg Alfaiataria', 'categoria' => 'Calças', 'preco' => 199.90, 'tamanhos' => ['36', '38', '40', '42'], 'cor' => 'Preto', 'estoque' => 9,  'destaque' => true],
            ['nome' => 'Calça Jeans Mom',          'categoria' => 'Calças',    'preco' => 179.90, 'tamanhos' => ['36', '38', '40'],   'cor' => 'Azul', 'estoque' => 17, 'destaque' => false],
            ['nome' => 'Saia Midi Plissada',       'categoria' => 'Saias',     'preco' => 139.90, 'tamanhos' => ['P', 'M', 'G'],       'cor' => 'Verde', 'estoque' => 11, 'destaque' => false],
            ['nome' => 'Conjunto Alfaiataria',     'categoria' => 'Conjuntos', 'preco' => 329.90, 'tamanhos' => ['P', 'M', 'G'],       'cor' => 'Bege', 'estoque' => 4,  'destaque' => true],
            ['nome' => 'Blazer Oversized',         'categoria' => 'Casacos',   'preco' => 259.90, 'tamanhos' => ['P', 'M', 'G', 'GG'], 'cor' => 'Preto', 'estoque' => 8,  'destaque' => false],
            ['nome' => 'Cardigã Tricot',           'categoria' => 'Casacos',   'preco' => 149.90, 'tamanhos' => ['P', 'M', 'G'],       'cor' => 'Rosa', 'estoque' => 13, 'destaque' => false],
        ];

        return view('portfolio.Loja.produtos', compact('produtos'));
    }

    public function encomendas()
    {
        $encomendas = [
            [
                'numero' => '3021', 'cliente' => 'Aline Moreira', 'contato' => '(41) 99200-1101',
                'itens' => [['nome' => 'Vestido Midi Floral', 'tamanho' => 'M', 'qtd' => 1], ['nome' => 'Blusa Cropped Canelada', 'tamanho' => 'P', 'qtd' => 2]],
                'valor' => 369.70, 'pagamento' => 'Pix', 'entrega' => 'Correios', 'status' => 'Em separação', 'data' => now()->subHours(4),
            ],
            [
                'numero' => '3022', 'cliente' => 'Bruna Castilho', 'contato' => '(41) 99200-1102',
                'itens' => [['nome' => 'Conjunto Alfaiataria', 'tamanho' => 'M', 'qtd' => 1]],
                'valor' => 329.90, 'pagamento' => 'Cartão', 'entrega' => 'Retirada na loja', 'status' => 'Pronto para retirada', 'data' => now()->subDay(),
            ],
            [
                'numero' => '3023', 'cliente' => 'Carolina Reis', 'contato' => '(41) 99200-1103',
                'itens' => [['nome' => 'Calça Wide Leg Alfaiataria', 'tamanho' => '38', 'qtd' => 1], ['nome' => 'Blazer Oversized', 'tamanho' => 'M', 'qtd' => 1]],
                'valor' => 459.80, 'pagamento' => 'Cartão', 'entrega' => 'Motoboy', 'status' => 'A caminho', 'data' => now()->subHours(20),
            ],
            [
                'numero' => '3024', 'cliente' => 'Denise Farias', 'contato' => '(41) 99200-1104',
                'itens' => [['nome' => 'Saia Midi Plissada', 'tamanho' => 'G', 'qtd' => 1]],
                'valor' => 139.90, 'pagamento' => 'Pix', 'entrega' => 'Correios', 'status' => 'Entregue', 'data' => now()->subDays(4),
            ],
            [
                'numero' => '3025', 'cliente' => 'Eduarda Nascimento', 'contato' => '(41) 99200-1105',
                'itens' => [['nome' => 'Vestido Longo Linho', 'tamanho' => 'P', 'qtd' => 1], ['nome' => 'Cardigã Tricot', 'tamanho' => 'P', 'qtd' => 1]],
                'valor' => 399.80, 'pagamento' => 'Pix', 'entrega' => 'Correios', 'status' => 'Cancelada', 'data' => now()->subDays(6),
            ],
            [
                'numero' => '3026', 'cliente' => 'Fernanda Uchoa', 'contato' => '(41) 99200-1106',
                'itens' => [['nome' => 'Calça Jeans Mom', 'tamanho' => '40', 'qtd' => 1]],
                'valor' => 179.90, 'pagamento' => 'Cartão', 'entrega' => 'Motoboy', 'status' => 'Em separação', 'data' => now()->subMinutes(50),
            ],
        ];

        return view('portfolio.Loja.encomendas', compact('encomendas'));
    }

    public function clientes()
    {
        $clientes = [
            ['nome' => 'Aline Moreira',      'telefone' => '(41) 99200-1101', 'email' => 'aline@exemplo.com',      'totalPedidos' => 6,  'ultimaCompra' => now()->subHours(4),  'gastoTotal' => 1240.50, 'vip' => true],
            ['nome' => 'Bruna Castilho',     'telefone' => '(41) 99200-1102', 'email' => 'bruna@exemplo.com',      'totalPedidos' => 2,  'ultimaCompra' => now()->subDay(),      'gastoTotal' => 480.80,  'vip' => false],
            ['nome' => 'Carolina Reis',      'telefone' => '(41) 99200-1103', 'email' => 'carolina@exemplo.com',   'totalPedidos' => 9,  'ultimaCompra' => now()->subHours(20),  'gastoTotal' => 2190.30, 'vip' => true],
            ['nome' => 'Denise Farias',      'telefone' => '(41) 99200-1104', 'email' => 'denise@exemplo.com',     'totalPedidos' => 1,  'ultimaCompra' => now()->subDays(4),     'gastoTotal' => 139.90,  'vip' => false],
            ['nome' => 'Eduarda Nascimento', 'telefone' => '(41) 99200-1105', 'email' => 'eduarda@exemplo.com',    'totalPedidos' => 4,  'ultimaCompra' => now()->subDays(6),     'gastoTotal' => 890.40,  'vip' => false],
            ['nome' => 'Fernanda Uchoa',     'telefone' => '(41) 99200-1106', 'email' => 'fernanda@exemplo.com',   'totalPedidos' => 11, 'ultimaCompra' => now()->subMinutes(50), 'gastoTotal' => 3120.60, 'vip' => true],
        ];

        return view('portfolio.Loja.clientes', compact('clientes'));
    }

    public function profissionais()
    {
        $profissionais = [
            ['nome' => 'Patrícia Andrade', 'cargo' => 'Gerente da loja',        'area' => 'Gestão',       'telefone' => '(41) 99300-2201', 'admissao' => now()->subYears(5)],
            ['nome' => 'Juliana Ferraz',   'cargo' => 'Consultora de vendas',   'area' => 'Vendas',       'telefone' => '(41) 99300-2202', 'admissao' => now()->subYears(2)],
            ['nome' => 'Camila Duarte',    'cargo' => 'Consultora de vendas',   'area' => 'Vendas',       'telefone' => '(41) 99300-2203', 'admissao' => now()->subMonths(8)],
            ['nome' => 'Roberta Lins',     'cargo' => 'Estilista',              'area' => 'Criação',      'telefone' => '(41) 99300-2204', 'admissao' => now()->subYears(4)],
            ['nome' => 'Vanessa Prado',    'cargo' => 'Costureira',             'area' => 'Produção',     'telefone' => '(41) 99300-2205', 'admissao' => now()->subYears(3)],
            ['nome' => 'Larissa Bittencourt', 'cargo' => 'Responsável por estoque', 'area' => 'Logística', 'telefone' => '(41) 99300-2206', 'admissao' => now()->subMonths(14)],
        ];

        return view('portfolio.Loja.profissionais', compact('profissionais'));
    }
}