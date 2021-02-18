<?php


class HtmlTd extends HtmlAtributosGlobais{
    
    public function geraHtml(){
        
        $atributosGlobais= parent::geraHtml();
        $elementos = parent::geraHtmlElementos();
        
        return "<td {$atributosGlobais}> {$elementos} </td>";
    }
    
}
