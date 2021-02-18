<?php

require_once '../Views/Abstract/viewabstract.class.php';
require_once '../Models/exerciciomodel.class.php';

class FichaView extends ViewAbstract {

    protected function montaForm($arrayExercicios = null, $telaVar = null) {
        $form = new HtmlForm();
        $form->setMethod("post");
        $br = new HtmlBr();

        if($telaVar){
            $div = new HtmlDiv();
            $fieldsetOptions = new HtmlFieldset();
    
            //botão de SAIR
            $button = new HtmlButton();
            $button->setName("bt");
            $button->setType("submit");
            $button->setValue("sair");
            $button->setConteudo("SAIR");
            $fieldsetOptions->addElemento($button);
    
            $div->addElemento($fieldsetOptions);
            $form->addElemento($div);
        }else{
            //continua
        }
        if($arrayExercicios==null){
            $div = new HtmlDiv();
        $fieldsetFicha = new HtmlFieldset();
        
        $h1 = new HtmlH();
        $h1->setTipo(1);
        $h1->setTexto("Nenhum exercicio adicionado nesta ficha ainda. :(");
        $fieldsetFicha->addElemento($h1);

        $div->addElemento($fieldsetFicha);
        $form->addElemento($div);
        }else{
        //INSTANCIA OBJETO PLANO
        $exercicioModel = new ExercicioModel();
        
        //CRIA DIV COM PLANOS
        $divExercicios = new HtmlDiv();
        foreach($arrayExercicios as $exercicioModel){
            $divExercicio = new HtmlDiv();
            $fieldsetExercicio = new HtmlFieldset();

            $label = new HtmlLabel();
            $label->setTexto("id do exercicio: ".$exercicioModel->getExerId());
            $fieldsetExercicio->addElemento($label);

        
            $label = new HtmlLabel();
            $label->setTexto("nome do exercicio: ".$exercicioModel->getExerNome());
            $fieldsetExercicio->addElementos(Array($br,$label));

            $label = new HtmlLabel();
            $label->setTexto("descrição do exercicio: ".$exercicioModel->getExerDescricao());
            $fieldsetExercicio->addElementos(Array($br,$label));

            $divExercicio->addElemento($fieldsetExercicio);
            $divExercicios->addElemento($divExercicio);

        }
        $form->addElemento($divExercicios);
        }
        return $form;
    }

    public function montaDivDeBotoes() {
    }

    public function recebeDadosDaConsulta() {  
    }

    public function recebeDadosDaEntrada() {
    }

}
