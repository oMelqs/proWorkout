<?php


require_once '../Views/adminview.class.php';
require_once '../Views/adminview2.class.php';
require_once '../Views/fichaview.class.php';
require_once '../Models/planomodel.class.php';
require_once '../Models/exerciciomodel.class.php';
require_once '../Models/usuariomodel.class.php';
require_once '../Models/clientemodel.class.php';
require_once '../Models/fichamodel.class.php';

class AdminController {

    private $adminView;
    private $adminView2;
    private $fichaView;
    private $planoModel;
    private $exercicioModel;
    private $usuarioModel;
    private $clienteModel;
    private $fichaModel;
    private $exercicios;

    function __construct() {
        $this->planoModel = new PlanoModel();
        $this->exercicioModel = new ExercicioModel();
        $this->usuarioModel = new UsuarioModel();
        $this->clienteModel = new ClienteModel();
        $this->exercicios = array();
        $this->adminView = new AdminView("Administração");
        $this->adminView2 = new AdminView2("Administração");
        $this->fichaView = new FichaView("Administração");

        $acao = $this->adminView->getBt();

        switch ($acao) {
            case "cadastrarPlano":
                $this->cadastraPlano();
                break;
            case "consultarPlano":
                $this->consultaPlano();
                break;
            case "editarPlano":
                $this->editaPlano();
                break;
            case "deletarPlano":
                $this->deletaPlano();
                break;
            case "cadastrarExercicio":
                $this->cadastraExercicio();
                break;
            case "consultarExercicio":
                $this->consultaExercicio();
                break;
            case "editarExercicio":
                $this->editaExercicio();
                break;
            case "deletarExercicio":
                $this->deletaExercicio();
                break;
            case "consultarUsuario":
                $this->consultaUsuario();
                break;
            case "cadastraFicha":
                $this->cadastraFicha();
                break;
            case "deletaFicha":
                $this->deletaFicha();
                break;
            case "sair":
                $this->sair();
                break;        
        }

                $this->adminView->displayInterface($this->planoModel, $this->exercicioModel);
                $this->adminView2->displayInterface($this->usuarioModel, $this->clienteModel);
                $this->fichaView->displayInterface($this->exercicios);
      
    }

    function __destruct() {
        unset($this->adminView);
        unset($this->adminView2);
        unset($this->fichaView);
    }

    private function sair(){
       session_destroy();
        return header("Location: login.php");
    }

    private function consultaUsuario(){
        $this->usuarioModel = $this->adminView2->recebeDadosDaConsultaUsuario();

        $buscou = $this->usuarioModel->buscaObjeto();
        if($buscou){
            //continua
        }else{
            $this->adminView2->addMensagem ("Consulta mal sucedida! Usuario inexistente.");
            return;
        }

        $this->clienteModel->setClieUsuaCpf($this->usuarioModel->getUsuaCpf());
        $buscou = $this->clienteModel->buscaObjeto();
        if($buscou){
            //continua
            $this->adminView2->addMensagem ("Consulta bem sucedida!");
        }else{
            $this->adminView2->addMensagem ("Consulta mal sucedida! Cliente inexistente.");
            return;
        }

        //FAZ BUSCA EM TODAS FICHAS CADASTRADAS
        $this->fichaModel = new FichaModel($this->usuarioModel->getUsuaCpf());
        $fichas =  $this->fichaModel->buscaFichaCliente();
         foreach($fichas as $fichaModel){
            $this->exercicioModel->setExerId($fichaModel->getExerId());
            $buscou = $this->exercicioModel->buscaObjeto();
            if($buscou){
                $this->exercicios[]= $this->exercicioModel;
            }else{
                $this->fichaView->addMensagem ("Consulta mal sucedida! erro na busca do exercicio: ".$fichaModel->getExerId());
            }
            $this->exercicioModel = new ExercicioModel();
         }

        

     }

     private function cadastraFicha(){
        //INSTANCIA DADOS DE FICHA
        $this->fichaModel =  $this->adminView2->recebeDadosDaFicha();


        //VALIDA DADOS DE CLIENTE
        $this->clienteModel->setClieUsuaCpf($this->fichaModel->getClieUsuaCpf());
        $buscou = $this->clienteModel->buscaObjeto();
        if($buscou){
            //continua
            $this->clienteModel = new ClienteModel();
        }else{
            $this->adminView2->addMensagem ("Cadastro mal sucedido! Cliente inexistente.");
            $this->clienteModel = new ClienteModel();
            return;
        }

        //VALIDA DADOS DE EXERCICIO
        $this->exercicioModel->setExerId($this->fichaModel->getExerId());

        $buscou = $this->exercicioModel->buscaObjeto();
        if($buscou){
            //continua
            $this->exercicioModel = new ExercicioModel();
        }else{
            $this->adminView2->addMensagem ("Cadastro mal sucedido! Exercicio inexistente.");
            $this->exercicioModel = new ExercicioModel();
            return;
        }

        //TENTA FAZER A INCLUSÃO DE PLANO
        $incluiu = $this->fichaModel->insereObjeto();
        if($incluiu){
            //continua
            $this->adminView2->addMensagem ("Cadastro bem-sucedido!");
            $this->fichaModel = new FichaModel();
        }else{
            $this->adminView2->addMensagem ("Oh, Ou! Erro no cadastro.");
            return;
        }
        $this->consultaUsuario();
    }

    private function deletaFicha(){
        $this->fichaModel =  $this->adminView2->recebeDadosDaFicha();
        
        //CHECA DADOS DE PLANO
        $checou = $this->fichaModel->checaAtributos();
        if($checou) {
            //continua
        } else {
            $this->adminView2->addMensagens($this->fichaModel->getMensagens());
            return;
        }

        $excluiu = $this->fichaModel->excluiObjeto();
        if($excluiu){
            $this->adminView2->addMensagem ("Exclusão bem sucedida!");
            $this->fichaModel = new FichaModel();
        }else{
            $this->adminView2->addMensagem ("Exclusão mal sucedida!");
        }
        $this->consultaUsuario();
    }


 

    private function cadastraPlano(){
        //INSTANCIA DADOS DE PLANO
        $this->planoModel =  $this->adminView->recebeDadosDoPlano();
        $this->planoModel->setPlanoId(null);
        
        //CHECA DADOS DE PLANO
        $checou = $this->planoModel->checaAtributos();
        if($checou) {
            //continua
        } else {
            $this->adminView->addMensagens($this->planoModel->getMensagens());
            return;
        }


        //TENTA FAZER A INCLUSÃO DE PLANO
        $incluiu = $this->planoModel->insereObjeto();
        if($incluiu){
            //continua
            $this->adminView->addMensagem ("Cadastro bem-sucedido! Plano cadastrado no Id: ".$this->planoModel->recuperaId());
            $this->planoModel = new PlanoModel();
        }else{
            $this->adminView->addMensagem ("Oh, Ou! Erro no cadastro.");
            return;
        }
    }

    private function consultaPlano(){
        $this->planoModel =  $this->adminView->recebeDadosDaConsultaPlano();

        $buscou = $this->planoModel->buscaObjeto();
        if($buscou){
            $this->adminView->addMensagem ("Consulta bem sucedida!");
        }else{
            $this->adminView->addMensagem ("Consulta mal sucedida!");
        }
    }

    private function editaPlano(){
        //INSTANCIA DADOS DE PLANO
        $this->planoModel =  $this->adminView->recebeDadosDoPlano();
        
        //CHECA DADOS DE PLANO
        $checou = $this->planoModel->checaAtributos();
        if($checou) {
            //continua
        } else {
            $this->adminView->addMensagens($this->planoModel->getMensagens());
            return;
        }

        $alterou = $this->planoModel->alteraObjeto();
        if($alterou){
            $this->adminView->addMensagem ("Alteração bem sucedida!");
        }else{
            $this->adminView->addMensagem ("Alteração mal sucedida!");
        }

    }

    private function deletaPlano(){
        //INSTANCIA DADOS DE PLANO
        $this->planoModel =  $this->adminView->recebeDadosDoPlano();
        
        //CHECA DADOS DE PLANO
        $checou = $this->planoModel->checaAtributos();
        if($checou) {
            //continua
        } else {
            $this->adminView->addMensagens($this->planoModel->getMensagens());
            return;
        }

        $excluiu = $this->planoModel->excluiObjeto();
        if($excluiu){
            $this->adminView->addMensagem ("Exclusão bem sucedida!");
            $this->planoModel = new PlanoModel();
        }else{
            $this->adminView->addMensagem ("Exclusão mal sucedida!");
        }
    }

    private function cadastraExercicio(){
        //INSTANCIA DADOS DE PLANO
        $this->exercicioModel = $this->adminView->recebeDadosDoExercicio();
        $this->exercicioModel->setExerId(null);

        //CHECA DADOS DE PLANO
        $checou=$this->exercicioModel->checaAtributos();
        if($checou){
            //continua
        }else{
            $this->adminView->addMensagens($this->exercicioModel->getMensagens());
            return;
        }


        //TENTA FAZER A INCLUSÃO DE EXERCICIO
        $incluiu = $this->exercicioModel->insereObjeto();
        if($incluiu){
            //continua
            $this->adminView->addMensagem ("Cadastro bem-sucedido! Exercicio cadastrado no Id: ".$this->exercicioModel->recuperaId());
            $this->exercicioModel = new ExercicioModel();
        }else{
            $this->adminView->addMensagem ("Oh, Ou! Erro no cadastro.");
            return;
        }
    }

    private function consultaExercicio(){
        $this->exercicioModel =  $this->adminView->recebeDadosDaConsultaExercicio();

        $buscou = $this->exercicioModel->buscaObjeto();
        if($buscou){
            $this->adminView->addMensagem ("Consulta bem sucedida!");
        }else{
            $this->adminView->addMensagem ("Consulta mal sucedida!");
        }
    }

    private function editaExercicio(){
        //INSTANCIA DADOS DE PLANO
        $this->exercicioModel =  $this->adminView->recebeDadosDoExercicio();
        
        //CHECA DADOS DE PLANO
        $checou = $this->exercicioModel->checaAtributos();
        if($checou) {
            //continua
        } else {
            $this->adminView->addMensagens($this->exercicioModel->getMensagens());
            return;
        }

        $alterou = $this->exercicioModel->alteraObjeto();
        if($alterou){
            $this->adminView->addMensagem ("Alteração bem sucedida!");
        }else{
            $this->adminView->addMensagem ("Alteração mal sucedida!");
        }

    }

    private function deletaExercicio(){
        //INSTANCIA DADOS DE PLANO
        $this->exercicioModel =  $this->adminView->recebeDadosDoExercicio();
        
        //CHECA DADOS DE PLANO
        $checou = $this->exercicioModel->checaAtributos();
        if($checou) {
            //continua
        } else {
            $this->adminView->addMensagens($this->exercicioModel->getMensagens());
            return;
        }

        $excluiu = $this->exercicioModel->excluiObjeto();
        if($excluiu){
            $this->adminView->addMensagem ("Exclusão bem sucedida!");
            $this->exercicioModel = new ExercicioModel();
        }else{
            $this->adminView->addMensagem ("Exclusão mal sucedida!");
        }
    } 
}
