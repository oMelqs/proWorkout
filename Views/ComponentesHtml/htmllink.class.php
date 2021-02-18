<?php

require_once 'htmlatributosglobais.class.php';

class Htmllink extends HtmlAtributosGlobais {

    private $href;
    private $hreflang;
    private $media;
    private $rel;
    private $sizes;
    private $type;

    public function __construct($href = null, $hreflang = null, $media = null
    , $rel = null, $sizes = null, $type = null) {

        $this->setHref($href);
        $this->setHreflang($hreflang);
        $this->setMedia($media);
        $this->setRel($rel);
        $this->setSizes($sizes);
        $this->setType($type);
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();

        return "<link" . $atributosGlobais . $this->href . $this->hreflang . $this->media . $this->rel . $this->sizes . $this->type . ">";
    }

    function setHref($href) {
        $this->href = " href='" . $href . "'";
    }

    function setHreflang($hreflang) {
        $this->hreflang = " hreflang='" . $hreflang . "'";
    }

    function setRel($rel) {
        $this->rel = " rel='" . $rel . "'";
    }

    function setMedia($media) {
        $this->media = " media='" . $media . "'";
    }

    function setSizes($sizes) {
        $this->sizes = " sizes='" . $sizes . "'";
    }

    function setType($type) {
        $this->type = " type='" . $type . "'";
    }

}
