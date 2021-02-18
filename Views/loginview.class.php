<?php

require_once '../Views/Abstract/viewabstract.class.php';

class LoginView extends ViewAbstract {

    protected function montaForm($objeto = null) {

        $form = new HtmlForm();
        $form->setMethod("post");

        $div = new HtmlDiv();
        
        $label = new HtmlLabel();
        $label->setTexto("Email:");

        $input = new HtmlInput();
        $input->setName("usuaEmail");
        $div->addElementos(array($label, $input));
        $form->addElemento($div);

        $div = new HtmlDiv();

        $label = new HtmlLabel();
        $label->setTexto("Senha:");

        $input = new HtmlInput();
        $input->setName("usuaSenha");
        $input->setType("password");
        $div->addElementos(array($label, $input));
        $form->addElemento($div);


        $form->addElemento($this->montaDivDeBotoes());


        return $form;
    }

    public function montaDivDeBotoes() {
        //div dos botões
        $divDeBotoes = new HtmlDiv();

        //botão de limepeza
        $button2 = new htmlButton();
        $button2->setName("bt");
        $button2->setType("submit");
        $button2->setValue("cadastrar");
        $button2->setConteudo("Cadastrar");

        $divDeBotoes = new HtmlDiv();

        //botão de inclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("logar");
        $button->setConteudo("Logar");


        $divDeBotoes->addElementos(array($button2, $button));


        return $divDeBotoes;
    }

    public function recebeDadosDaConsulta() {
        
    }

    public function recebeDadosDaEntrada() {
        $usuarioModel = new UsuarioModel(null, null, $_POST['usuaEmail'], $_POST['usuaSenha'], null);
        return $usuarioModel;
    }

}
