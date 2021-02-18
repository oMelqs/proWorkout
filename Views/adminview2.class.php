<?php

require_once '../Views/Abstract/viewabstract.class.php';


class AdminView2 extends ViewAbstract {
    protected function montaForm($usuarioModel = null, $clienteModel = null) {

        $form = new HtmlForm();
        $form->setMethod("post");
        $br = new HtmlBr();

        //MONTA DIV DE CLIENTES
        
        $div = new HtmlDiv();
        $fieldsetUsuarios = new HtmlFieldset();
        
        $h1 = new HtmlH();
        $h1->setTipo(1);
        $h1->setTexto("Consultar ficha de usuário");
        $fieldsetUsuarios->addElemento($h1);

        $label = new HtmlLabel();
        $label->setTexto("CPF do usuario:");
        $input = new HtmlInput();
        $input->setName("usuaCpf");
        $input->setValue($usuarioModel->getUsuaCpf());
        $fieldsetUsuarios->addElementos(array($label, $input));


        //botão de consulta
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("consultarUsuario");
        $button->setConteudo("Consultar");
        $fieldsetUsuarios->addElemento($button);


        $label = new HtmlLabel();
        $label->setTexto("ID do exercicio:  ");
        $input = new HtmlInput();
        $input->setName("exerId");
        $fieldsetUsuarios->addElementos(array($br,$label, $input));


        //botão de consulta
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("cadastraFicha");
        $button->setConteudo("Cadastrar");
        $fieldsetUsuarios->addElemento($button);


        //botão de exclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("deletaFicha");
        $button->setConteudo("Remover");
        $fieldsetUsuarios->addElemento($button);



        $label = new HtmlLabel();
        $label->setTexto("Nome: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("usuaNome");
        $input->setValue($usuarioModel->getUsuaNome());
        $fieldsetUsuarios->addElementos(array($br, $br, $label, $input));


        $label = new HtmlLabel();
        $label->setTexto("Email: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("usuaEmail");
        $input->setValue($usuarioModel->getUsuaEmail());
        $fieldsetUsuarios->addElementos(array($label, $input));


        $label = new HtmlLabel();
        $label->setTexto("Tipo: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("usuaTipo");
        $input->setValue($usuarioModel->getUsuaTipo());
        $fieldsetUsuarios->addElementos(array($label, $input));

        $label = new HtmlLabel();
        $label->setTexto("Telefone: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("clieFone1");
        $input->setValue($clienteModel->getClieFone1());
        $fieldsetUsuarios->addElementos(array($br,$br,$label, $input));

        $label = new HtmlLabel();
        $label->setTexto("Telefone 2: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("clieFone2");
        $input->setValue($clienteModel->getClieFone2());
        $fieldsetUsuarios->addElementos(array($label, $input));

        $label = new HtmlLabel();
        $label->setTexto("Endereço: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("getClieEndereco");
        $input->setValue($clienteModel->getClieEndereco());
        $fieldsetUsuarios->addElementos(array($br,$label, $input));

        $label = new HtmlLabel();
        $label->setTexto("Complemento: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("getClieComplementoEndereco");
        $input->setValue($clienteModel->getClieComplementoEndereco());
        $fieldsetUsuarios->addElementos(array($label, $input));

        $label = new HtmlLabel();
        $label->setTexto("Cidade: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("clieCidade");
        $input->setValue($clienteModel->getClieCidade());
        $fieldsetUsuarios->addElementos(array($br,$label, $input));

        $label = new HtmlLabel();
        $label->setTexto("Estado: ");
        $input = new HtmlInput();
        $input->setDisabled(true);
        $input->setName("clieUf");
        $input->setValue($clienteModel->getClieUf());
        $fieldsetUsuarios->addElementos(array($label, $input));


        $div->addElemento($fieldsetUsuarios);
        $form->addElemento($div);



        return $form;
    }

    public function montaDivDeBotoes() {

    }

    public function recebeDadosDaConsultaUsuario() {
        $usuarioModel = new UsuarioModel($_POST["usuaCpf"]);
        return $usuarioModel;  
    }

    public function recebeDadosDaFicha(){
        $fichaModel = new FichaModel($_POST["usuaCpf"], $_POST["exerId"]);
        return $fichaModel;

    }


    public function recebeDadosDaConsulta() {
        
    }

    public function recebeDadosDaEntrada() {

    }

}
