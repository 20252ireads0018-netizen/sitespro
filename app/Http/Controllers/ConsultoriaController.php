<?php

namespace App\Http\Controllers;

class ConsultoriaController extends Controller
{
    public function sobre()
    {
        $numeros = [
            ['valor' => '14', 'rotulo' => 'anos de mercado'],
            ['valor' => '320+', 'rotulo' => 'clientes atendidos'],
            ['valor' => 'R$ 180M', 'rotulo' => 'em patrimônio assessorado'],
            ['valor' => '4', 'rotulo' => 'consultores certificados'],
        ];

        $linhaDoTempo = [
            ['ano' => '2011', 'texto' => 'Fundação da consultoria, com foco em planejamento para pequenas empresas.'],
            ['ano' => '2015', 'texto' => 'Abertura da área de consultoria para pessoas físicas e famílias.'],
            ['ano' => '2019', 'texto' => 'Certificação CFP de toda a equipe de consultores.'],
            ['ano' => '2023', 'texto' => 'Lançamento da área de sucessão patrimonial e planejamento tributário.'],
        ];

        $equipe = [
            ['nome' => 'Renato Cavalcanti', 'cargo' => 'Sócio-fundador', 'especialidade' => 'Planejamento financeiro'],
            ['nome' => 'Débora Nakamura',   'cargo' => 'Consultora sênior', 'especialidade' => 'Investimentos e renda fixa'],
            ['nome' => 'Igor Marinho',      'cargo' => 'Consultor',        'especialidade' => 'Previdência e sucessão'],
            ['nome' => 'Beatriz Coutinho',  'cargo' => 'Consultora',       'especialidade' => 'Finanças empresariais'],
        ];

        return view('portfolio.Consultoria.sobre', compact('numeros', 'linhaDoTempo', 'equipe'));
    }

    public function valores()
    {
        $pilares = [
            [
                'titulo' => 'Transparência',
                'descricao' => 'Não trabalhamos com comissão de produtos. Nossa remuneração vem só do valor cobrado ao cliente.',
                'icone' => 'olho',
            ],
            [
                'titulo' => 'Independência',
                'descricao' => 'Não somos ligados a banco ou corretora. As recomendações consideram apenas o interesse do cliente.',
                'icone' => 'escudo',
            ],
            [
                'titulo' => 'Personalização',
                'descricao' => 'Cada plano é construído a partir da realidade e dos objetivos de quem contrata, sem modelos prontos.',
                'icone' => 'usuario',
            ],
            [
                'titulo' => 'Acompanhamento contínuo',
                'descricao' => 'O plano é revisado periodicamente, ajustando a rota conforme a vida e o cenário econômico mudam.',
                'icone' => 'grafico',
            ],
        ];

        $comparativo = [
            ['criterio' => 'Remuneração', 'nos' => 'Honorário fixo, definido com o cliente', 'mercado' => 'Comissão sobre produtos vendidos'],
            ['criterio' => 'Vínculo institucional', 'nos' => 'Consultoria independente', 'mercado' => 'Ligado a banco ou corretora'],
            ['criterio' => 'Plano', 'nos' => 'Personalizado, revisado a cada 6 meses', 'mercado' => 'Modelo padrão, pouco revisado'],
            ['criterio' => 'Indicação de produtos', 'nos' => 'Apenas quando faz sentido para o objetivo', 'mercado' => 'Conforme meta comercial do mês'],
        ];

        return view('portfolio.Consultoria.valores', compact('pilares', 'comparativo'));
    }

    public function servicos()
    {
        $servicos = [
            [
                'nome' => 'Planejamento financeiro pessoal',
                'publico' => 'Pessoa física',
                'descricao' => 'Organização de orçamento, reserva de emergência e definição de metas de curto e longo prazo.',
                'duracao' => 'Plano de 3 meses, com revisão semestral',
                'precoDesde' => 890.00,
            ],
            [
                'nome' => 'Carteira de investimentos',
                'publico' => 'Pessoa física',
                'descricao' => 'Análise de perfil de risco e proposta de alocação entre renda fixa, fundos e renda variável.',
                'duracao' => 'Acompanhamento mensal',
                'precoDesde' => 650.00,
            ],
            [
                'nome' => 'Planejamento de aposentadoria',
                'publico' => 'Pessoa física',
                'descricao' => 'Projeção de previdência pública e privada, com simulação de diferentes idades de saída.',
                'duracao' => 'Plano de 2 meses',
                'precoDesde' => 1200.00,
            ],
            [
                'nome' => 'Sucessão e planejamento tributário',
                'publico' => 'Pessoa física',
                'descricao' => 'Estruturação de holding familiar, testamento e estratégias de redução de imposto sobre herança.',
                'duracao' => 'Projeto sob consulta',
                'precoDesde' => 2400.00,
            ],
            [
                'nome' => 'Saúde financeira empresarial',
                'publico' => 'Empresa',
                'descricao' => 'Diagnóstico de fluxo de caixa, custos fixos e margem, com plano de ação de curto prazo.',
                'duracao' => 'Diagnóstico de 1 mês',
                'precoDesde' => 1800.00,
            ],
            [
                'nome' => 'Captação e estruturação de capital',
                'publico' => 'Empresa',
                'descricao' => 'Apoio na busca por crédito, investidores ou linhas de fomento adequadas ao estágio da empresa.',
                'duracao' => 'Projeto sob consulta',
                'precoDesde' => 3200.00,
            ],
        ];

        return view('portfolio.Consultoria.servicos', compact('servicos'));
    }

    public function contatos()
    {
        $canais = [
            ['tipo' => 'Telefone', 'valor' => '(11) 4002-1122', 'horario' => 'Seg. a sex., 9h às 18h'],
            ['tipo' => 'WhatsApp', 'valor' => '(11) 99000-3344', 'horario' => 'Seg. a sex., 9h às 19h'],
            ['tipo' => 'E-mail', 'valor' => 'contato@consultoriaexemplo.com.br', 'horario' => 'Resposta em até 1 dia útil'],
            ['tipo' => 'Escritório', 'valor' => 'Av. Paulista, 1200, conjunto 802 - São Paulo, SP', 'horario' => 'Atendimento com hora marcada'],
        ];

        $mensagens = [
            ['nome' => 'Fernando Rezende', 'email' => 'fernando@exemplo.com', 'assunto' => 'Interesse em planejamento de aposentadoria', 'data' => now()->subHours(3), 'respondida' => false],
            ['nome' => 'Vanessa Cardoso',  'email' => 'vanessa@exemplo.com',  'assunto' => 'Dúvida sobre valores da consultoria de investimentos', 'data' => now()->subDay(),   'respondida' => true],
            ['nome' => 'Grupo Alvorada Comércio', 'email' => 'financeiro@alvorada.com', 'assunto' => 'Diagnóstico financeiro para a empresa', 'data' => now()->subDays(2), 'respondida' => true],
            ['nome' => 'Marina Chagas', 'email' => 'marina@exemplo.com', 'assunto' => 'Quero organizar minhas finanças pessoais', 'data' => now()->subMinutes(40), 'respondida' => false],
        ];

        return view('portfolio.Consultoria.contatos', compact('canais', 'mensagens'));
    }

    public function agendamento()
    {
        $consultores = ['Renato Cavalcanti', 'Débora Nakamura', 'Igor Marinho', 'Beatriz Coutinho'];

        $horarios = [
            ['data' => now()->addDay(),          'hora' => '09:00', 'consultor' => 'Renato Cavalcanti', 'disponivel' => true],
            ['data' => now()->addDay(),          'hora' => '11:00', 'consultor' => 'Débora Nakamura',   'disponivel' => true],
            ['data' => now()->addDay(),          'hora' => '14:30', 'consultor' => 'Igor Marinho',      'disponivel' => false],
            ['data' => now()->addDays(2),        'hora' => '10:00', 'consultor' => 'Beatriz Coutinho',  'disponivel' => true],
            ['data' => now()->addDays(2),        'hora' => '15:00', 'consultor' => 'Renato Cavalcanti', 'disponivel' => true],
            ['data' => now()->addDays(3),        'hora' => '09:30', 'consultor' => 'Débora Nakamura',   'disponivel' => true],
            ['data' => now()->addDays(3),        'hora' => '16:00', 'consultor' => 'Igor Marinho',      'disponivel' => true],
            ['data' => now()->addDays(4),        'hora' => '11:30', 'consultor' => 'Beatriz Coutinho',  'disponivel' => false],
        ];

        $proximasReunioes = [
            ['cliente' => 'Fernando Rezende', 'consultor' => 'Igor Marinho',      'assunto' => 'Planejamento de aposentadoria', 'data' => now()->addHours(20)],
            ['cliente' => 'Grupo Alvorada Comércio', 'consultor' => 'Beatriz Coutinho', 'assunto' => 'Diagnóstico financeiro empresarial', 'data' => now()->addDays(2)->setTime(10, 0)],
        ];

        return view('portfolio.Consultoria.agendamento', compact('consultores', 'horarios', 'proximasReunioes'));
    }
}