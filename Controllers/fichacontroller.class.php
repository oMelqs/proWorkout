<?php


require_once '../Views/fichaview.class.php';
require_once '../Models/fichamodel.class.php';
require_once '../Models/exerciciomodel.class.php';

class FichaController {

    private $fichaView;
    private $fichaModel;
    private $exercicioModel;
    private $exercicios;
    private $telaVar;

    function __construct() {
        $this->fichaView = new FichaView("Ficha");
        $this->exercicioModel = new ExercicioModel();
        $this->exercicios = array();
        $this->telaVar = true;

        if (session_start()) {
            $this->fichaModel = new FichaModel($_SESSION['usuaCpf']);
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
        }else{
            $this->fichaView->addMensagem ("Algo deu errado! Tente novamente mais tarde, ou contate o suporte. :(");
        }

        $acao = $this->fichaView->getBt();

        switch ($acao) {
            case "sair":
                $this->sair();
                break; 
        }
        

        $this->fichaView->displayInterface($this->exercicios, $this->telaVar);
    }

    private function sair(){
        session_destroy();
         return header("Location: login.php");
     }

    function __destruct() {
        unset($this->fichaView);
    }
    
}
