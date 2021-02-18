<?php

require_once 'htmlatributosglobais.class.php';

class htmlImg extends HtmlAtributosGlobais{
    
    private $alt;
    private $crossorigin;
    private $height;
    private $ismap;
    private $longdesc;
    private $sizes;
    private $src;
    private $srcset;
    private $usemap;
    private $width;
    
    function __construct() {
        parent::__construct();
        $this->alt = null;
        $this->crossorigin = null;
        $this->height = null;
        $this->ismap = null;
        $this->longdesc = null;
        $this->sizes = null;
        $this->src = null;
        $this->srcset = null;
        $this->usemap = null;
        $this->width = null;
    }
    
    public function geraHtml(){
        
        $atributisGlobais = parent::geraHtml();
        
        return "<img {$atributisGlobais}" . $this->alt . $this->crossorigin . $this->height . $this->ismap
                . $this->longdesc . $this->sizes . $this->src . $this->srcset . $this->usemap . $this->width
                . ">";
    }
    
    function setAlt($alt) {
        $this->alt = " alt='" . $alt . "'";
    }

    function setCrossorigin($crossorigin) {
        $this->crossorigin = " crossorigin='" . $crossorigin . "'";
    }

    function setHeight($height) {
        $this->height = " height='" . $height . "'";
    }

    function setIsmap($ismap) {
        $this->ismap = " ismap='" . $ismap . "'";
    }

    function setLongdesc($longdesc) {
        $this->longdesc = " longdesc='" . $longdesc . "'";
    }

    function setSizes($sizes) {
        $this->sizes = " sizes='" . $sizes . "'";
    }

    function setSrc($src) {
        $this->src = " src='" . $src . "'";
    }

    function setSrcset($srcset) {
        $this->srcset = " srcset='" . $srcset . "'";
    }

    function setUsemap($usemap) {
        $this->usemap = " usemap='" . $usemap . "'";
    }

    function setWidth($width) {
        $this->width = " width='" . $width . "'";
    }

}
