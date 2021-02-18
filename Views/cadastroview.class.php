<?php

require_once '../Views/Abstract/viewabstract.class.php';


class CadastroView extends ViewAbstract {

    protected function montaForm($objeto = null) {

        $form = new HtmlForm();
        $form->setMethod("post");

        //CRIA DIV DO USUARIO

        $div = new HtmlDiv();

        $label = new HtmlLabel();
        $label->setTexto("Email:");
        $input = new HtmlInput();
        $input->setName("usuaEmail");
        $div->addElementos(array($label, $input));
        

        $label = new HtmlLabel();
        $label->setTexto("Nome:");
        $input = new HtmlInput();
        $input->setName("usuaNome");
        $div->addElementos(array($label, $input));


        $label = new HtmlLabel();
        $label->setTexto("CPF:");
        $input = new HtmlInput();
        $input->setName("usuaCpf");
        $div->addElementos(array($label, $input));


        $label = new HtmlLabel();
        $label->setTexto("Senha:");
        $input = new HtmlInput();
        $input->setName("usuaSenha");
        $input->setType("password");
        $div->addElementos(array($label, $input));
        
        $form->addElemento($div);

        //CRIA DIV DO CLIENTE

        $div = new HtmlDiv();

        $label = new HtmlLabel();
        $label->setTexto("Telefone 1:");
        $input = new HtmlInput();
        $input->setName("clieFone1");
        $div->addElementos(array($label, $input));
        

        $label = new HtmlLabel();
        $label->setTexto("Telefone 2:");
        $input = new HtmlInput();
        $input->setName("clieFone2");
        $div->addElementos(array($label, $input));
        

        $label = new HtmlLabel();
        $label->setTexto("Endereço:");
        $input = new HtmlInput();
        $input->setName("clieEndereco");
        $div->addElementos(array($label, $input));
        

        $label = new HtmlLabel();
        $label->setTexto("Complemento:");
        $input = new HtmlInput();
        $input->setName("clieComplementoEndereco");
        $div->addElementos(array($label, $input));
        

        $label = new HtmlLabel();
        $label->setTexto("Cidade:");
        $input = new HtmlInput();
        $input->setName("clieCidade");
        $div->addElementos(array($label, $input));
        

        $label = new HtmlLabel();
        $label->setTexto("UF: ");
        $selectUf = new HtmlSelect();
        $selectUf = $this->geraUfs();
        $div->addElementos(array($label,$selectUf));
        

        $form->addElemento($div);



        $form->addElemento($this->montaDivDeBotoes());


        return $form;
    }

    public function recebeDadosDoUsuario(){
        $usuarioModel = new UsuarioModel($_POST["usuaCpf"], $_POST["usuaNome"], $_POST["usuaEmail"], $_POST["usuaSenha"]);
        return $usuarioModel;
    }

    public function recebeDadosDoCliente() {
        $clienteModel = new ClienteModel($_POST["clieUsuaCpf"], $_POST["clieFone1"], $_POST["clieFone2"],$_POST["clieEndereco"],$_POST["clieComplementoEndereco"],$_POST["clieCidade"],$_POST["clieUf"]);
        return $clienteModel;
    }

    public function geraUfs(){
        
        $selectUf = new HtmlSelect();
        $selectUf->setName("clieUf");
        
        $option = new htmlOption();
        $option->setConteudo("Escolha");
        $option->setValue("-1");

        $selectUf->addElemento($option);

        $option = new htmlOption();
        $option->setConteudo("AC");
        $option->setValue("AC");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("AL");
        $option->setValue("AL");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("AP");
        $option->setValue("AP");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("AM");
        $option->setValue("AM");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("BA");
        $option->setValue("BA");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("CE");
        $option->setValue("CE");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("DF");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("ES");
        $option->setValue("ES");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("GO");
        $option->setValue("GO");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("MA");
        $option->setValue("MA");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("MT");
        $option->setValue("MT");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("MS");
        $option->setValue("MS");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("MG");
        $option->setValue("MG");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("PA");
        $option->setValue("PA");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("PB");
        $option->setValue("PB");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("PR");
        $option->setValue("PR");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("PE");
        $option->setValue("PE");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("PI");
        $option->setValue("PI");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("RJ");
        $option->setValue("RJ");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("RN");
        $option->setValue("RN");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("RS");
        $option->setValue("RS");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("RO");
        $option->setValue("RO");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("RR");
        $option->setValue("RR");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("SC");
        $option->setValue("SC");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("SP");
        $option->setValue("SP");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("SE");
        $option->setValue("SE");
        $selectUf->addElemento($option);
        
        $option = new htmlOption();
        $option->setConteudo("TO");
        $option->setValue("TO");
        $selectUf->addElemento($option);

        return $selectUf;
    }

    public function montaDivDeBotoes() {
        //div dos botões
        $divDeBotoes = new HtmlDiv();

        //botão de limepeza
        $button2 = new htmlButton();
        $button2->setName("bt");
        $button2->setType("submit");
        $button2->setValue("cancelar");
        $button2->setConteudo("Cancelar");

        $divDeBotoes = new HtmlDiv();

        //botão de inclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("continuar");
        $button->setConteudo("Continuar");

        $divDeBotoes->addElementos(array($button2, $button));


        return $divDeBotoes;
   }

    public function recebeDadosDaConsulta() {  
    }

    public function recebeDadosDaEntrada() {
    }
}

