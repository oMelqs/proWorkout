<?php

require_once '../Views/Abstract/viewabstract.class.php';

class AdminView extends ViewAbstract {

    protected function montaForm($planoModel = null, $exercicioModel = null) {

        $form = new HtmlForm();
        $form->setMethod("post");
        $br = new HtmlBr();

        //MONTA DIV DE NAVEGAÇÃO

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

        //MONTA DIV DE PLANOS
        
        $div = new HtmlDiv();
        $fieldsetPlanos = new HtmlFieldset();

        $h1 = new HtmlH();
        $h1->setTipo(1);
        $h1->setTexto("Planos");
        $fieldsetPlanos->addElemento($h1);

        $label = new HtmlLabel();
        $label->setTexto("Id do plano: ");
        $input = new HtmlInput();
        $input->setName("planoId");
        $input->setValue($planoModel->getPlanoId());
        $fieldsetPlanos->addElementos(array($label, $input));

        //botão de consulta
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("consultarPlano");
        $button->setConteudo("Consultar");
        $fieldsetPlanos->addElemento($button);
        
        $label = new HtmlLabel();
        $label->setTexto("Nome do plano: ");
        $input = new HtmlInput();
        $input->setName("planoNome");
        $input->setValue($planoModel->getPlanoNome());
        $fieldsetPlanos->addElementos(array($br,$label, $input));
        
        
        $label = new HtmlLabel();
        $label->setTexto("Descrição do plano: ");
        $input = new HtmlInput();
        $input->setName("planoDesc");
        $input->setValue($planoModel->getPlanoDesc());
        $fieldsetPlanos->addElementos(array($br,$label, $input));
        
        
        $label = new HtmlLabel();
        $label->setTexto("Valor:");
        $input = new HtmlInput();
        $input->setName("planoValor");
        $input->setValue($planoModel->getPlanoValor());
        $fieldsetPlanos->addElementos(array($br,$label, $input));
        
        //botão de inclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("cadastrarPlano");
        $button->setConteudo("Cadastrar");
        $fieldsetPlanos->addElementos(array($br,$button));
                     
        //botão de alteração
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("editarPlano");
        $button->setConteudo("Editar");
        $fieldsetPlanos->addElemento($button);

        //botão de exclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("deletarPlano");
        $button->setConteudo("Deletar");
        $fieldsetPlanos->addElemento($button);

        $div->addElemento($fieldsetPlanos);
        $form->addElemento($div);

        //MONTA DIV DE EXERCICIOS

        $div = new HtmlDiv();
        $fieldsetExercicios = new HtmlFieldset();
        
        $h1 = new HtmlH();
        $h1->setTipo(1);
        $h1->setTexto("Exercicios");
        $fieldsetExercicios->addElemento($h1);

        $label = new HtmlLabel();
        $label->setTexto("Id do exercicio: ");
        $input = new HtmlInput();
        $input->setName("exerId");
        $input->setValue($exercicioModel->getExerId());
        $fieldsetExercicios->addElementos(array($label, $input));

        //botão de inclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("consultarExercicio");
        $button->setConteudo("Consultar");
        $fieldsetExercicios->addElemento($button);

        
        $label = new HtmlLabel();
        $label->setTexto("Nome do exercicio: ");
        $input = new HtmlInput();
        $input->setName("exerNome");
        $input->setValue($exercicioModel->getExerNome());
        $fieldsetExercicios->addElementos(array($br,$label, $input));
        
        
        $label = new HtmlLabel();
        $label->setTexto("Descrição do Exercicio: ");
        $input = new HtmlInput();
        $input->setName("exerDescricao");
        $input->setValue($exercicioModel->getExerDescricao());
        $fieldsetExercicios->addElementos(array($br,$label, $input));
        
        //botão de inclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("cadastrarExercicio");
        $button->setConteudo("Cadastrar");
        $fieldsetExercicios->addElementos(array($br,$button));

        //botão de alteração
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("editarExercicio");
        $button->setConteudo("Editar");
        $fieldsetExercicios->addElemento($button);

        //botão de exclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("deletarExercicio");
        $button->setConteudo("Deletar");
        $fieldsetExercicios->addElemento($button);

        $div->addElemento($fieldsetExercicios);
        $form->addElemento($div);

        return $form;
    }
 

    public function montaDivDeBotoes() {

    }

    public function recebeDadosDaConsulta() {
        
    }

    public function recebeDadosDaConsultaPlano() {
        $planoModel = new PlanoModel($_POST["planoId"]);
        return $planoModel;   
    }

    public function recebeDadosDaConsultaExercicio() {
        $exercicioModel = new ExercicioModel($_POST["exerId"]);
        return $exercicioModel;   
    }


    public function recebeDadosDaEntrada() {

    }

    public function recebeDadosDoPlano(){
        $planoModel = new PlanoModel($_POST["planoId"], $_POST["planoNome"], $_POST["planoDesc"], $_POST["planoValor"]);
        return $planoModel;

    }

    public function recebeDadosDoExercicio(){
        $exercicioModel = new ExercicioModel($_POST["exerId"], $_POST["exerNome"], $_POST["exerDescricao"]);
        return $exercicioModel;

    }
}
