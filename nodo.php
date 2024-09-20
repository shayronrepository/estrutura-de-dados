<?php

class Nodo
{
    public $valor;
    public $proximo;
    public $anterior;

    public function __construct($valor = null)
    {
        $this->valor = $valor;
        $this->proximo = null;
        $this->anterior = null;
    }

    public function getValor()
    {
        return $this->valor;
    }
}