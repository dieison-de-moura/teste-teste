<?php

class AppController {
    /**
     * Define a quantidade de dezenas, mínimo 6 máximo 10
     */
    private $quantidadeDezenas;
    /**
     * resultado
     */
    private $resultado;
    /**
     * Total de jogos
     */
    private $totalJogos;
    /**
     * Jogos
     */
    private $jogos;

    /**
     * Método construtor
     */
    public function __construct($quantidadeDezenas = 8, $totalJogos = 2)
    {
        $this->setQuantidadeDezenas($quantidadeDezenas);
        $this->setTotalJogos($totalJogos);
    }

    /**
     * Início métodos GET e SET
     */
    public function getQuantidadeDezenas()
    {
        return $this->quantidadeDezenas;
    }

    public function setQuantidadeDezenas($qtd)
    {
        if ($qtd < 6) {
            $this->quantidadeDezenas = 6;
        } elseif ($qtd > 10) {
            $this->quantidadeDezenas = 10;
        } else {
            $this->quantidadeDezenas = $qtd;
        }
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }

    public function getTotalJogos()
    {
        return $this->totalJogos;
    }

    public function setTotalJogos($totalJogos)
    {
        $this->totalJogos = $totalJogos;
    }

    public function getJogos()
    {
        return $this->jogos;
    }

    public function setJogos($jogos)
    {
        $this->jogos = $jogos;
    }
    /**
     * Fim métodos GET e SET
     */
    
    /**
     * @param int $maximo Define a quantidade de dezenas que serão criadas
     */
    private function criarArrayDezenas($maximo = 0)
    {
        if ($maximo == 0) {
            $maximo = $this->getQuantidadeDezenas();
        }

        $retorno = [];
        for ($i = 0; $i < $maximo; $i++) {
            $retorno[] = mt_rand(1, 60);
        }

        $retorno = array_unique($retorno, SORT_REGULAR);
        $diff = $maximo - count($retorno);

        if ($diff > 0) {
            $retorno = $this->validarArrayDezenas($retorno, $diff, $maximo);
        }

        sort($retorno);

        return $retorno;
    }

    /**
     * Realiza a verificação de total de dezenas para o método criarArrayDezenas
     * @param array $dezenas array com as dezenas que estão sendo geradas
     * @param int $diff diferença entre o total de dezenas no array e do atributo $quantidadeDezenas
     * @param int $maximo Define a quantidade de dezenas que serão criadas
     */
    private function validarArrayDezenas($dezenas, $diff, $maximo)
    {
        for ($i = 0; $i < $diff; $i++) {
            $dezenas[] = mt_rand(1, 60);
        }

        $dezenas = array_unique($dezenas, SORT_REGULAR);
        $diff = $maximo - count($dezenas);

        if ($diff > 0) {
            $dezenas = $this->validarArrayDezenas($dezenas, $diff, $maximo);
        }

        return $dezenas;
    }

    /**
     * Cria o array com o total de jogos
     */
    public function montarTotalJogos()
    {
        $jogos = [];
        $totalJogos = $this->getTotalJogos();

        for ($i = 0; $i < $totalJogos; $i++) {
            $arrayJogos = $this->criarArrayDezenas();
            $jogos[] = [
                'nome' => "Jogo número {$i}",
                'dezenas' => count($arrayJogos),
                'jogos' => $arrayJogos
            ];
        }

        $this->setJogos($jogos);
    }

    /**
     * Gera os dados para o atributo $resultado
     */
    public function gerarResultado()
    {
        $this->setResultado($this->criarArrayDezenas(6));
    }

    /**
     * integração com a View
     */
    public function index()
    {
        $this->montarTotalJogos();

        $mensagem = 'Tabela com as informações dos jogos';
        $jogos = $this->getJogos();
		require_once 'Views/homeApp.php';
    }

    /**
     * Método para testes
     */
    public function imprimir($data)
    {
        echo '<pre>';
        print_r($data);
    }
}