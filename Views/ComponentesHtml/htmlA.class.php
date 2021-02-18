<?php

require_once 'htmlatributosglobais.class.php';

class htmlA extends HtmlAtributosGlobais {

    private $download;
    private $href;
    private $hreflang;
    private $media;
    private $ping;
    private $rel;
    private $target;
    private $type;
    private $texto;
    private $role;
    private $onClick;

    function __construct() {
        parent::__construct();
        $this->download = null;
        $this->href = null;
        $this->hreflang = null;
        $this->media = null;
        $this->ping = null;
        $this->rel = null;
        $this->target = null;
        $this->type = null;
        $this->txt = null;
        $this->texto = null;
        $this->role = null;
        $this->onClick = null;
    }

    public function geraHtml() {

        $atributosGloabis = parent::geraHtml();
        $elementos = parent::geraHtmlElementos();

        return "<a {$atributosGloabis}{$this->onClick}" . $this->download . $this->href . $this->hreflang . $this->media
                . $this->ping . $this->rel . $this->target . $this->type . ">" . $elementos
                . $this->texto . $this->role . 
                "</a>";
    }

    function setDownload($download) {
        $this->download = " download='" . $download . "'";
    }

    function setHref($href) {
        $this->href = " href='" . $href . "'";
    }

    function setHreflang($hreflang) {
        $this->hreflang = " hreflang='" . $hreflang . "'";
    }

    function setMedia($media) {
        $this->media = " media='" . $media . "'";
    }

    function setPing($ping) {
        $this->ping = " ping='" . $ping . "'";
    }

    function setRel($rel) {
        $this->rel = " rel='" . $rel . "'";
    }

    function setTarget($target) {
        $this->target = " target='" . $target . "'";
    }

    function setType($type) {
        $this->type = " type='" . $type . "'";
    }

    function getTexto() {
        return $this->texto;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setOnClick($onClick) {
        $this->onClick = "onclick='{$onClick}'";
    }

}
