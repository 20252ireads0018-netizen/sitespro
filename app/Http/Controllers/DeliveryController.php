<?php

namespace App\Http\Controllers;

class DeliveryController extends Controller
{
    public function pedidos()
    {
        $pedidos = [
            [
                'numero' => '0231', 'cliente' => 'Juliana Prado', 'endereco' => 'Rua das Acácias, 120 - Centro',
                'telefone' => '(41) 99123-4501',
                'itens' => [['nome' => 'Pizza Margherita G', 'qtd' => 1], ['nome' => 'Refrigerante 2L', 'qtd' => 1]],
                'pagamento' => 'Cartão', 'valor' => 68.90, 'status' => 'Em preparo',
                'hora' => now()->subMinutes(12), 'entregador' => 'Marcos Silva',
            ],
            [
                'numero' => '0232', 'cliente' => 'Rodrigo Almeida', 'endereco' => 'Av. Brasil, 845, apto 302 - Água Verde',
                'telefone' => '(41) 99123-4502',
                'itens' => [['nome' => 'Combo X-Bacon', 'qtd' => 2], ['nome' => 'Batata frita', 'qtd' => 1]],
                'pagamento' => 'Pix', 'valor' => 54.80, 'status' => 'Em entrega',
                'hora' => now()->subMinutes(28), 'entregador' => 'Fábio Nogueira',
            ],
            [
                'numero' => '0233', 'cliente' => 'Camila Duarte', 'endereco' => 'Rua Voluntários da Pátria, 55 - Centro',
                'telefone' => '(41) 99123-4503',
                'itens' => [['nome' => 'Yakisoba de frango', 'qtd' => 1], ['nome' => 'Guioza', 'qtd' => 1]],
                'pagamento' => 'Dinheiro', 'valor' => 47.00, 'status' => 'Recebido',
                'hora' => now()->subMinutes(3), 'entregador' => null,
            ],
            [
                'numero' => '0234', 'cliente' => 'Thiago Bezerra', 'endereco' => 'Rua Mateus Leme, 210 - São Francisco',
                'telefone' => '(41) 99123-4504',
                'itens' => [['nome' => 'Lasanha à bolonhesa', 'qtd' => 1], ['nome' => 'Suco natural', 'qtd' => 2]],
                'pagamento' => 'Cartão', 'valor' => 71.50, 'status' => 'Entregue',
                'hora' => now()->subMinutes(65), 'entregador' => 'Marcos Silva',
            ],
            [
                'numero' => '0235', 'cliente' => 'Larissa Fontoura', 'endereco' => 'Rua Comendador Araújo, 480 - Batel',
                'telefone' => '(41) 99123-4505',
                'itens' => [['nome' => 'Pizza Calabresa G', 'qtd' => 1]],
                'pagamento' => 'Pix', 'valor' => 49.90, 'status' => 'Cancelado',
                'hora' => now()->subMinutes(80), 'entregador' => null,
            ],
            [
                'numero' => '0236', 'cliente' => 'Eduardo Matos', 'endereco' => 'Rua XV de Novembro, 990 - Centro',
                'telefone' => '(41) 99123-4506',
                'itens' => [['nome' => 'Combo 2 X-Salada', 'qtd' => 1], ['nome' => 'Milk-shake', 'qtd' => 2]],
                'pagamento' => 'Cartão', 'valor' => 62.30, 'status' => 'Em preparo',
                'hora' => now()->subMinutes(6), 'entregador' => null,
            ],
        ];

        return view('portfolio.Delivery.pedidos', compact('pedidos'));
    }

    public function pratos()
    {
        $pratos = [
            ['nome' => 'Pizza Margherita', 'categoria' => 'Pizzas', 'preco' => 52.90, 'descricao' => 'Molho de tomate, mussarela e manjericão fresco.', 'tempoPreparo' => 25, 'disponivel' => true],
            ['nome' => 'Pizza Calabresa', 'categoria' => 'Pizzas', 'preco' => 49.90, 'descricao' => 'Calabresa fatiada, cebola e azeitonas.', 'tempoPreparo' => 25, 'disponivel' => true],
            ['nome' => 'Lasanha à bolonhesa', 'categoria' => 'Massas', 'preco' => 38.50, 'descricao' => 'Camadas de massa fresca, molho bolonhesa e queijo gratinado.', 'tempoPreparo' => 20, 'disponivel' => true],
            ['nome' => 'Yakisoba de frango', 'categoria' => 'Massas', 'preco' => 34.00, 'descricao' => 'Macarrão oriental salteado com legumes e frango.', 'tempoPreparo' => 18, 'disponivel' => true],
            ['nome' => 'Combo X-Bacon', 'categoria' => 'Lanches', 'preco' => 24.90, 'descricao' => 'Pão brioche, hambúrguer 160g, bacon e queijo, com fritas.', 'tempoPreparo' => 15, 'disponivel' => true],
            ['nome' => 'Combo X-Salada', 'categoria' => 'Lanches', 'preco' => 22.90, 'descricao' => 'Pão brioche, hambúrguer 160g, alface e tomate, com fritas.', 'tempoPreparo' => 15, 'disponivel' => true],
            ['nome' => 'Guioza', 'categoria' => 'Entradas', 'preco' => 19.90, 'descricao' => 'Seis unidades de pastel japonês recheado com carne e legumes.', 'tempoPreparo' => 10, 'disponivel' => true],
            ['nome' => 'Batata frita', 'categoria' => 'Entradas', 'preco' => 16.00, 'descricao' => 'Porção com cheddar e bacon.', 'tempoPreparo' => 10, 'disponivel' => false],
            ['nome' => 'Suco natural', 'categoria' => 'Bebidas', 'preco' => 9.50, 'descricao' => 'Laranja, limão ou maracujá.', 'tempoPreparo' => 5, 'disponivel' => true],
            ['nome' => 'Refrigerante 2L', 'categoria' => 'Bebidas', 'preco' => 12.00, 'descricao' => 'Coca-Cola, Guaraná ou Sprite.', 'tempoPreparo' => 1, 'disponivel' => true],
            ['nome' => 'Milk-shake', 'categoria' => 'Sobremesas', 'preco' => 17.90, 'descricao' => 'Chocolate, morango ou baunilha.', 'tempoPreparo' => 8, 'disponivel' => true],
            ['nome' => 'Petit gâteau', 'categoria' => 'Sobremesas', 'preco' => 21.00, 'descricao' => 'Bolo de chocolate com recheio cremoso e sorvete.', 'tempoPreparo' => 12, 'disponivel' => false],
        ];

        return view('portfolio.Delivery.pratos', compact('pratos'));
    }

    public function entregadores()
    {
        $entregadores = [
            ['nome' => 'Marcos Silva',    'veiculo' => 'Moto', 'placa' => 'ABC1D23', 'telefone' => '(41) 99000-2201', 'status' => 'Online',  'entregasHoje' => 14, 'avaliacao' => 4.8],
            ['nome' => 'Fábio Nogueira',  'veiculo' => 'Moto', 'placa' => 'BRA2E45', 'telefone' => '(41) 99000-2202', 'status' => 'Online',  'entregasHoje' => 11, 'avaliacao' => 4.6],
            ['nome' => 'Patrícia Gomes',  'veiculo' => 'Bike', 'placa' => '-',       'telefone' => '(41) 99000-2203', 'status' => 'Offline', 'entregasHoje' => 0,  'avaliacao' => 4.9],
            ['nome' => 'Diego Ferreira',  'veiculo' => 'Carro','placa' => 'CDE3F67', 'telefone' => '(41) 99000-2204', 'status' => 'Em pausa','entregasHoje' => 6,  'avaliacao' => 4.5],
            ['nome' => 'Aline Cordeiro',  'veiculo' => 'Moto', 'placa' => 'DFG4H89', 'telefone' => '(41) 99000-2205', 'status' => 'Online',  'entregasHoje' => 9,  'avaliacao' => 4.7],
        ];

        return view('portfolio.Delivery.entregadores', compact('entregadores'));
    }

    public function veiculos()
    {
        $veiculos = [
            ['placa' => 'ABC1D23', 'tipo' => 'Moto',  'modelo' => 'Honda CG 160',   'entregador' => 'Marcos Silva',   'km' => 18420, 'status' => 'Em uso'],
            ['placa' => 'BRA2E45', 'tipo' => 'Moto',  'modelo' => 'Yamaha Factor',  'entregador' => 'Fábio Nogueira', 'km' => 24980, 'status' => 'Em uso'],
            ['placa' => 'CDE3F67', 'tipo' => 'Carro', 'modelo' => 'Fiat Fiorino',   'entregador' => 'Diego Ferreira', 'km' => 61200, 'status' => 'Em manutenção'],
            ['placa' => 'DFG4H89', 'tipo' => 'Moto',  'modelo' => 'Honda Biz 125',  'entregador' => 'Aline Cordeiro', 'km' => 9870,  'status' => 'Em uso'],
            ['placa' => '-',       'tipo' => 'Bike',  'modelo' => 'Caloi Elétrica', 'entregador' => 'Patrícia Gomes', 'km' => 1340,  'status' => 'Disponível'],
        ];

        return view('portfolio.Delivery.veiculos', compact('veiculos'));
    }

    public function atendimento()
    {
        $atendimentos = [
            ['cliente' => 'Juliana Prado',    'pedido' => '#0231', 'assunto' => 'Pedido atrasado',        'canal' => 'WhatsApp', 'status' => 'Em andamento', 'data' => now()->subMinutes(20)],
            ['cliente' => 'Rodrigo Almeida',  'pedido' => '#0232', 'assunto' => 'Troca de item',           'canal' => 'Telefone', 'status' => 'Resolvido',    'data' => now()->subHours(2)],
            ['cliente' => 'Larissa Fontoura', 'pedido' => '#0235', 'assunto' => 'Cancelamento de pedido',  'canal' => 'App',      'status' => 'Resolvido',    'data' => now()->subHours(3)],
            ['cliente' => 'Eduardo Matos',    'pedido' => '#0236', 'assunto' => 'Endereço incorreto',      'canal' => 'WhatsApp', 'status' => 'Em andamento', 'data' => now()->subMinutes(5)],
            ['cliente' => 'Camila Duarte',    'pedido' => '#0233', 'assunto' => 'Dúvida sobre ingredientes','canal' => 'Chat',     'status' => 'Pendente',     'data' => now()->subMinutes(2)],
            ['cliente' => 'Thiago Bezerra',   'pedido' => '#0234', 'assunto' => 'Elogio ao atendimento',   'canal' => 'App',      'status' => 'Resolvido',    'data' => now()->subDay()],
        ];

        return view('portfolio.Delivery.atendimento', compact('atendimentos'));
    }
}