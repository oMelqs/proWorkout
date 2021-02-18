<?php

class HtmlTr extends HtmlAtributosGlobais {

    private $td;
    private $th;

    public function __construct() {

        $this->td = array();
        $this->th = array();
    }

    public function geraHtml() {

        $atributosGlobais = parent::geraHtml();

        $tr = "<tr{$atributosGlobais}>";

        if ($this->th != null) {
            foreach ($this->th as $th) {
                $tr .= $th->geraHtml();
            }
        }

        if ($this->td != null) {
            foreach ($this->td as $td) {
                $tr .= $td->geraHtml();
            }
        }

        $tr .= "</tr>";


        return $tr;
    }

    function AddTd($td) {
        $this->td [] = $td;
    }

    function AddTh($th) {
        $this->th [] = $th;
    }

}
