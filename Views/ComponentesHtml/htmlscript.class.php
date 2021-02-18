<?php

require_once 'htmlatributosglobais.class.php';

class HtmlScript extends HtmlAtributosGlobais {

    private $charset;
    private $async;
    private $defer;
    private $src;
    private $type;
    private $script;

    public function __construct($charset=null, $async=null, $src=null,$defer=null,$type=null) {
        $this->setCharset($charset);
        $this->setAsync($async);
        $this->setDefer($defer);
        $this->setSrc($src);
        $this->setType($type);
        
    }
    
    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<script {$atributosGlobais}" . $this->charset . $this->src . $this->defer . 
            $this->type . $this->async . ">" .$this->script. "</script>";
    }

    function setCharset($charset) {
        $this->charset = " charset='" . $charset . "'";
    }
    
    function setAsync($async) {
        $this->async= " async='" . $async . "'";
    }
    
    function setSrc($src) {
        $this->src = " src='" . $src . "'";
    }
    
    function setDefer($defer) {
        $this->defer = " defer='" . $defer . "'";
    }
    
    function setType($type) {
        $this->type = " type='" . $type . "'";
    }
    function setScript($script) {
        $this->script = $script;
    }



}


