<?php

include_once 'nodo.php';

class ListaDuplamenteEncadeada
{
    private $inicio;
    private $fim;
    private $tamanho;

    public function __construct()
    {
        $this->inicio = null;
        $this->fim = null;
        $this->tamanho = 0;
    }

    public function enfileirar($valor)
    {
        $novoNode = new Nodo($valor);

        if (isset($this->fim)) {
            $this->fim->proximo = $novoNode;
            $novoNode->anterior = $this->fim;
            $this->fim = $novoNode;
        } else {
            $this->inicio = $novoNode;
            $this->fim = $novoNode;
        }

        $this->tamanho++;
    }

    public function addNoInicio($valor)
    {
        $novoNo = new Nodo($valor);

        if($this->inicio === null){
            $this->inicio = $novoNo;
        }else{
            $novoNo->proximo = $this->inicio;
            $this->inicio->anterior = $novoNo;
            $this->inicio = $novoNo;
        }
    }

    public function adicionarNoFim($valor)
    {
        $novoNo = new Nodo($valor);

        if($this->fim){
            $this->fim->proximo = $novoNo;
            $novoNo->anterior = $this->fim;
            $this->fim = $novoNo;
        }else{
            $this->fim = $novoNo;
            $this->inicio = $novoNo;
        }

        $this->tamanho++;
    }

    public function addNaPosicao($data, $posicao) {
        $novoNode = new Nodo($data); // cria um novo nó com valor.

        // Se a lista estiver vazia e a posição for 0, adicione o nó no início
        if ($this->inicio === null && $posicao == 0) {
            $this->inicio = $novoNode; // coloca um novo nó no inicio.
            return;
        }

        // Se a posição solicitada é 0, adicione no início
        if ($posicao == 0) {
            $novoNode->proximo = $this->inicio; // faz o novo nó apontar para o inicio.

            if ($this->inicio !== null) {
                $this->inicio->anterior = $novoNode; // atualiza o ponteiro fazendo ele apontar para o nó anterior.
            }
            $this->inicio = $novoNode; // coloca um novo nó no inicio.
            return;
        }

        // Navega até a posição desejada
        $atual = $this->inicio; // define atual como inicio;
        $posicaoAtual = 0; // define posiçãoAtual como zero;

        while ($atual !== null && $posicaoAtual < $posicao - 1) {
            $atual = $atual->proximo; // atualiza o valor atual.
            $posicaoAtual++; // contagem de números de nós.
        }

        // Se atual é null, a posição está além do fim da lista
        if ($atual === null) {
            throw new Exception("Posição fora dos limites."); // cria uma excessão.
        }

        // Inserção no meio ou no final da lista
        $novoNode->proximo = $atual->proximo; // novo nó aponta para o proximo nó.
        $novoNode->anterior = $atual; // o nó anterior aponta para o atual.

        if ($atual->proximo !== null) {
            // Atualiza os nós da lista duplamente encadeada após a inserção de um novo nó
            $atual->proximo->anterior = $novoNode; 
        }

        $atual->proximo = $novoNode; // O nó atual aponta para o novo nó.
    }

    public function desenfileirar()
    {
        if ($this->inicio !== null) {
            $valor = $this->inicio->valor; // Obtém o valor do primeiro nó da lista.
            $this->inicio = $this->inicio->proximo; // Atualiza o início da lista para o próximo nó.
        } else {
            $this->fim = null; // Define o fim da lista como null.
        }

        $this->tamanho--; // Decrementa o contador de nós na lista..

        return $valor; // Retorna o valor.
    }

    public function estaVazia()
    {
        return $this->inicio === null;
    }

    public function mostrarLista()
    {
        if ($this->estaVazia()) {
            echo "Fila está vazia!\n";
        }

        $valores = [];
        $atual = $this->inicio;
        
        while ($atual !== null) {
            $valores[] = $atual->valor; // insere o atual valor dentro do array valores.
            $atual = $atual->proximo; // atualiza o ponteiro para o proximo nó.
        }
        
        echo "Inicio -> ";
        foreach ($valores as $valor) {
            echo $valor . " <-> ";
            sleep(0);
        }
        echo "Fim \n";
    }
}


$lista = new ListaDuplamenteEncadeada();

$lista->addNaPosicao('1', 0);
$lista->addNaPosicao('3', 1);
$lista->addNaPosicao('2', 0);
$lista->addNaPosicao('4', 1);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Duplamente Encadeada</title>
</head>
<body>
    <?php $lista->mostrarLista(); ?>
</body>
</html>
