<?php

class HtmlTable extends HtmlAtributosGlobais {

    private $caption = null;
    private $thead;
    private $tbody;
    private $tfoot;
    private $tr;

    public function __construct() {
        $this->tbody = null;
        $this->tfoot = null;
        $this->thead = null;
        $this->tr = array();
    }

    public function geraHtml() {
        $atributosGlobais = parent::geraHtml();
        $table = "<table {$atributosGlobais}>";

        if ($this->caption != null) {
            $table .= $this->caption->geraHtml();
        }

        if ($this->thead != null) {
            $table .= $this->thead->geraHtml();
        }

        if ($this->tbody != null) {
            $table .= $this->tbody->geraHtml();
        }

        if ($this->tfoot != null) {
            $table .= $this->tfoot->geraHtml();
        }

        if ($this->tr != null) {
            foreach ($this->tr as $tr) {
                $table .= $tr->geraHtml();
            }
        }

        $table .= "</table>";

        return $table;
    }

    function setCaption($caption) {
        $this->caption = $caption;
    }

    function setThead($thead) {
        $this->thead = $thead;
    }

    function setTbody($tbody) {
        $this->tbody = $tbody;
    }

    function setTfoot($tfoot) {
        $this->tfoot = $tfoot;
    }

    function addTr($tr) {
        $this->tr [] = $tr;
    }

}
