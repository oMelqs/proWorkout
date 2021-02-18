<?php

require_once 'htmlinterface.class.php';

abstract class HtmlAtributosGlobais implements htmlinterface {

    private $class;
    private $id;
    //Array genérico para contúdos de tags qua formam blocos.
    protected $elementos;

    public function __construct() {
        $this->class     = null;
        $this->id        = null;
        $this->elementos = array();
    }

    public function geraHtml() {
        return $this->class . $this->id;
    }

    protected function geraHtmlElementos() {
        $htmlElementos = null;

        foreach ($this->elementos as $elemento) {
            if (is_object($elemento)) {
                $htmlElementos .= $elemento->geraHtml();
            } else {
                $htmlElementos.= $elemento;
            }
        }
        
        return $htmlElementos;
    }

    function setClass($class) {
        $this->class = " class='{$class}'";
    }

    function setId($id) {
        $this->id = " id='{$id}'";
    }

    function addElemento($elemento) {
        $this->elementos [] = $elemento;
    }

    function addElementos(Array $elementos) {
        foreach ($elementos as $elemento) {
            $this->addElemento($elemento);
        }
    }

}
