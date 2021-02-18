<?php

require_once 'htmlatributosglobais.class.php';

class HtmlStyle extends HtmlAtributosGlobais {

    private $media;
    private $type;
    private $conteudo;

    public function __construct($media = null, $type = null, $conteudo = null) {
        $this->setMedia($media);
        $this->setType($type);
        $this->conteudo = $conteudo;
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<style{$atributosGlobais}" . $this->media . $this->type . ">" . $this->conteudo . "</style>";
    }

    function setMedia($media) {
        $this->media = " media='" . $media . "'";
    }

    function setType($type) {
        $this->type = " type='" . $type . "'";
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

}
