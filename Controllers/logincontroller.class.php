<?php


require_once '../Views/loginview.class.php';
require_once '../Models/usuariomodel.class.php';

class LoginController {

    private $loginView;
    private $usuarioModel;

    function __construct() {
        $this->loginView = new LoginView("Login");


        $acao = $this->loginView->getBt();

        switch ($acao) {
            case "logar":
                $this->logar();
                break;
            case "cadastrar":
                $this->cadastrar();
                break;
        }

        $this->loginView->displayInterface(null);
    }

    function __destruct() {
        unset($this->loginView);
    }
    
    private function logar() {
        //INSTANCIA DADOS DO USUARIO
        $this->usuarioModel = $this->loginView->recebeDadosDaEntrada();

        //CHECA DADOS DE LOGIN
        $loginOk = $this->checaLogin($this->usuarioModel);
        if ($loginOk){
        //continua
        }else {
            $this->loginView->addMensagem ("Oh, Ou! Os dados não conferem.");
            return;
        }

        //TENTA INICIAR UMA NOVA SESSÃO
        if (session_start()) {
            $_SESSION['logado'] = true;
            $_SESSION['usuaNome'] = $this->usuarioModel->getUsuaNome();
            $_SESSION['usuaCpf'] = $this->usuarioModel->getUsuaCpf();
        }else {
            $this->loginView->addMensagem ("Oh, Ou! Erro no login.");
            return;
        }

        //CHECA ADMINISTRADOR
        $admin = $this->checaAdmin($this->usuarioModel);
        if ($admin){
            $_SESSION['admin'] = true;
            header("Location: admin.php");
        }else{
            header("Location: ficha.php");
        }
        
    }

    private function checaLogin($usuarioModel){
        $buscou = $usuarioModel->buscaUsuarioPorEmailESenha();
        if ($buscou) {
            return true;
        } else {
            return false;
        }

    }

    private function checaAdmin($usuarioModel){
        $checaAdmin = $this->usuarioModel->getUsuaTipo();
        if ($checaAdmin) {
            return true;
        } else {
            return false;
        }
    }

    private function cadastrar(){
        header("Location: planos.php");
    }
    
}
