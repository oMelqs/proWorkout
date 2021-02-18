<?php


require_once '../Views/planoview.class.php';
require_once '../Models/matriculamodel.class.php';
require_once '../Classes/datasehoras.class.php';

class PlanoController {

    private $planoView;
    private $matriculaModel;

    function __construct() {
        $this->planoView = new PlanoView("Planos");

        $planoEscolhido = $this->planoView->getBt();
        if($planoEscolhido==null){

        }else{
            $this->escolhePlano($planoEscolhido);
        }

        $this->planoView->displayInterface(null);
    }

    function __destruct() {
        unset($this->planoView);
    }
    
    private function escolhePlano($planoEscolhido){

        //INSTANCIA E DEFINE DADOS DE MATRICULA
        $this->matriculaModel = new MatriculaModel();
        $this->matriculaModel->setMatriPlanoId($planoEscolhido);
        $data = new DatasEHoras();
        $this->matriculaModel->setMatriDataInicial($data->getDataDoSistemaInvertidaComTraco());
        $this->matriculaModel->setMatriDataUltimoPgto($data->getDataDoSistemaInvertidaComTraco());

        //TENTA FAZER A INCLUSÃO DE MATRICULA
        $incluiu = $this->matriculaModel->insereObjeto();
        if($incluiu){
            //continua
        }else{
            $this->planoView->addMensagem ("Oh, Ou! Houve um erro no cadastro da matricula, contate o suporte.");
            return;
        }

        //INICIA SESSÃO
        if (session_start()) {
            $_SESSION['matriId'] = $this->matriculaModel->recuperaId();
            var_dump($_SESSION['matriId']);
            header("Location: cadastro.php");
        }else{
            $this->planoView->addMensagem ("Oh, Ou! Houve um erro na matricula, contate o suporte.");
            return;
        }
        
    }
}
