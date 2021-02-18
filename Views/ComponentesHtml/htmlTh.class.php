<?php


class htmlTh extends HtmlAtributosGlobais{
    
    public function geraHtml(){
        
        $atributosGlobais= parent::geraHtml();
        $elementos = parent::geraHtmlElementos();
        
        return "<th {$atributosGlobais}> {$elementos} </th>";
    }
    
}

