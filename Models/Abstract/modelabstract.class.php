<?php

require_once  '../ADOs/Abstract/adopdoabstract.class.php';

abstract class ModelAbstract extends AdoPdoAbstract {

    abstract public function checaAtributos();

    abstract protected function getAtributosDaClasse(); /* {
      return get_class_vars (get_class ());
      } */

    public function getArrayDeDadosDaClasse() {
        //recupera todos os atributos desta classe para um array.
        $arrayDeDadosDaClasse = $this->getAtributosDaClasse();

        //varre o array com os atributos e alimenta-o com os dados contidos nos
        //atributos desta classe.
        foreach ($arrayDeDadosDaClasse as $atributo => $dado) {
            $arrayDeDadosDaClasse[$atributo] = $this->$atributo;
        }

        //retorna o array com os atributos e dados desta classe.
        return $arrayDeDadosDaClasse;
    }

}
