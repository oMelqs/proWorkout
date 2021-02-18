<?php

require_once '../Views/cadastroview.class.php';
require_once '../Models/usuariomodel.class.php';
require_once '../Models/clientemodel.class.php';
require_once '../Models/matriculamodel.class.php';


class CadastroController {
    private $cadastroView;
    private $usuarioModel;
    private $clienteModel;
    private $matriculaModel;

    
    function __construct() {
        $this->cadastroView = new CadastroView("Cadastro");

        $acao = $this->cadastroView->getBt();

        switch ($acao) {
            case "cancelar":
                $this->cancelaCadastro();
                break;
            case "continuar":
                $this->cadastraUsuaCliente();
            break;   
                
        }
        $this->cadastroView->displayInterface(null);
    }

    function __destruct() {
        unset($this->cadastroView);
    }

    private function cadastraUsuaCliente(){

        

        //INSTANCIA DADOS DE USUARIO
        $this->usuarioModel = $this->cadastroView->recebeDadosDoUsuario();
        $this->usuarioModel->setUsuaTipo('0');

        //INSTANCIA DADOS DE CLIENTE
        $this->clienteModel = $this->cadastroView->recebeDadosDoCliente();
        $this->clienteModel->setClieUsuaCpf($this->usuarioModel->getUsuaCpf());
        if(session_start()){
            //continua
            $this->clienteModel->setClieMatriId($_SESSION['matriId']);
        }else{
            $this->cadastroView->addMensagen("Houve um erro na escolha do plano. Contate o suporte!");
           return;
        }

        //CHECA OS ATRIBUTOS DE USUARIO
        $checou = $this->usuarioModel->checaAtributos();
        if($checou) {
        //continua
        } else {
            $this->cadastroView->addMensagens($this->usuarioModel->getMensagens());
            return;
        }

        //CHECA OS ATRIBUTOS DE CLIENTE
        $checou = $this->clienteModel->checaAtributos();
        if($checou) {
        //continua
        } else {
           $this->cadastroView->addMensagens($this->clienteModel->getMensagens());
           return;
        }

        //TENTA FAZER A INCLUSÃO DE USUARIO
        $incluiu = $this->usuarioModel->insereObjeto();
        if($incluiu){
        //continua
        }else{
            $this->cadastroView->addMensagem ("Oh, Ou! Erro no cadastro.");
            return;
        }

        //TENTA FAZER A INCLUSÃO DE CLIENTE
        $incluiu = $this->clienteModel->insereObjeto();
        if($incluiu){
        //continua
        }else{
            $this->cadastroView->addMensagem ("Oh, Ou! Erro no cadastro.");
            return;
        }
        header("Location: login.php");
    }

    private function cancelaCadastro(){

        header("Location: login.php");
    }
}