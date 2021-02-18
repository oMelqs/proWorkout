<?php

require_once '../Views/Abstract/viewabstract.class.php';
require_once '../Models/planomodel.class.php';

class PlanoView extends ViewAbstract {

    protected function montaForm($objeto = null) {
        $form = new HtmlForm();
        $form->setMethod("post");

        //INSTANCIA OBJETO PLANO
        $planoModel = new PlanoModel();
        //BUSCA DADOS DE PLANOS
        $planos = $planoModel->buscaArrayObjetoComPs();
        
        //CRIA DIV COM PLANOS
        $divPlanos = new HtmlDiv();
        if($planos==null){
            $div = new HtmlDiv();
            $fieldsetPlano = new HtmlFieldset();
            
            $h1 = new HtmlH();
            $h1->setTipo(1);
            $h1->setTexto("Sistema em manuntenção! Tente novamente mais tarde. :(");
            $fieldsetPlano->addElemento($h1);
    
            $div->addElemento($fieldsetPlano);
            $form->addElemento($div);
        }else{
        foreach($planos as $planoModel){

            $divPlano = new HtmlDiv();
            $fieldsetPlano = new HtmlFieldset();
            $br = new HtmlBr();
        
            $label = new HtmlLabel();
            $label->setTexto($planoModel->getPlanoNome());
            $fieldsetPlano->addElemento($label);

            $label = new HtmlLabel();
            $label->setTexto($planoModel->getPlanoValor());
            $fieldsetPlano->addElementos(Array($br,$label));
            
            $label = new HtmlLabel();
            $label->setTexto($planoModel->getPlanoDesc());
            $fieldsetPlano->addElementos(Array($br,$label));

            
            $button = new HtmlButton();
            $button->setName("bt");
            $button->setType("submit");
            $button->setValue($planoModel->getPlanoId());
            $button->setConteudo("Eu quero este!");
            $fieldsetPlano->addElementos(Array($br,$button));

            $divPlano->addElemento($fieldsetPlano);
        
            $divPlanos->addElemento($divPlano);
        }
    }
        $form->addElemento($divPlanos);

        return $form;
    }

    public function montaDivDeBotoes() {
    }

    public function recebeDadosDaConsulta() {  
    }

    public function recebeDadosDaEntrada() {
    }

}
