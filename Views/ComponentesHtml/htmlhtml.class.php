<?php

require_once 'htmlatributosglobais.class.php';

class HtmlHtml extends HtmlAtributosGlobais {

    private $xmlns;
    private $head;
    private $body;

    function __construct($xmlns = null) {
        $this->setXmlns($xmlns);
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();
        
        $html = "<html{$atributosGlobais}>";
        $html .= $this->head->geraHtml() . $this->body->geraHtml();
        $html .= "</html>";
        
        return $html;
    }

    function setXmlns($xmlns) {
        $this->xmlns = " xmlns='{$xmlns}'";
    }

    function setHead($head) {
        $this->head = $head;
    }

    function setBody($body) {
        $this->body = $body;
    }

}
