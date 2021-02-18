<?php

require_once '../Views/ComponentesHtml/htmlhtml.class.php';
require_once '../Views/ComponentesHtml/htmlhead.class.php';
require_once '../Views/ComponentesHtml/htmllink.class.php';
require_once '../Views/ComponentesHtml/htmlbody.class.php';
require_once '../Views/ComponentesHtml/htmldiv.class.php';
require_once '../Views/ComponentesHtml/htmlp.class.php';
require_once '../Views/ComponentesHtml/htmltitle.class.php';
require_once '../Views/ComponentesHtml/htmlfieldset.class.php';
require_once '../Views/ComponentesHtml/htmllegend.class.php';
require_once '../Views/ComponentesHtml/htmlstyle.class.php';
require_once '../Views/ComponentesHtml/htmllink.class.php';
require_once '../Views/ComponentesHtml/htmlmeta.class.php';
require_once '../Views/ComponentesHtml/htmlscript.class.php';
require_once '../Views/ComponentesHtml/htmlnoscript.class.php';
require_once '../Views/ComponentesHtml/htmlbody.class.php';
require_once '../Views/ComponentesHtml/htmlp.class.php';
require_once '../Views/ComponentesHtml/htmlbr.class.php';
require_once '../Views/ComponentesHtml/htmldiv.class.php';
require_once '../Views/ComponentesHtml/htmlform.class.php';
require_once '../Views/ComponentesHtml/htmlinput.class.php';
require_once '../Views/ComponentesHtml/htmllabel.class.php';
require_once '../Views/ComponentesHtml/htmltextarea.class.php';
require_once '../Views/ComponentesHtml/htmloption.class.php';
require_once '../Views/ComponentesHtml/htmlbutton.class.php';
require_once '../Views/ComponentesHtml/htmlselect.class.php';
require_once '../Views/ComponentesHtml/htmlTd.class.php';
require_once '../Views/ComponentesHtml/htmlTh.class.php';
require_once '../Views/ComponentesHtml/htmlTr.class.php';
require_once '../Views/ComponentesHtml/htmlnav.class.php';
require_once '../Views/ComponentesHtml/htmlA.class.php';
require_once '../Views/ComponentesHtml/htmlh.class.php';
require_once '../Views/ComponentesHtml/htmlImg.class.php';
require_once '../Views/ComponentesHtml/htmlcenter.class.php';
require_once '../Views/ComponentesHtml/htmlUl.class.php';
require_once '../Views/ComponentesHtml/htmlli.class.php';
require_once '../Views/ComponentesHtml/htmlaside.class.php';
require_once '../Views/ComponentesHtml/htmlfooter.class.php';
require_once '../Views/ComponentesHtml/htmli.class.php';
require_once '../Views/ComponentesHtml/htmlsmall.class.php';
require_once '../Views/ComponentesHtml/htmlstrong.class.php';

abstract class ViewAbstract {

    protected $bt;
    protected $mensagens;
    protected $title;
    protected $html;
    protected $htmlHead;
    protected $htmlBody;

    public function __construct($titulo) {
        $this->bt = null;
        $this->mensagens = array();
        $this->title = new HtmlTitle($titulo);
    }

    public function displayInterface($objeto1 = null, $objeto2 = null, $tituloDaPagina = null) {
        $this->montaHmtl($objeto1, $objeto2, $tituloDaPagina);
        echo $this->html->geraHtml();
    }

    protected function montaHmtl($objeto, $objeto2 = null, $tituloDaPagina = null) {
        $this->html = new HtmlHtml();
        $this->html->setHead($this->montaHead());
        $this->html->setBody($this->montaBody($objeto, $objeto2, $tituloDaPagina));
    }


    protected function montaHead() {
        $this->htmlHead = new HtmlHead();

        $this->htmlHead->setTitle($this->title);

        return $this->htmlHead;
    }

    protected function montaBody($objeto, $objeto2 = null, $tituloDaPagina = null) {
        $body = new HtmlBody();
        $body->setClass("body");
        //$body->addElemento($this->montaNavBar());

        //$body->addElemento($this->montaAside());
        //$body->addElemento($this->montaDivisao());
        $body->addElemento($this->montaDivMensagens());
        $body->addElemento($this->montaForm($objeto, $objeto2));
        //$body->addElemento($this->montaFooter());

        //$body->addElemento($this->montaIconVoltarAoTopo());
        // $body->addElemento($this->montaCarregamentoDosScript());
        return $body;
    }

    public function montaDivMensagens() {

        $divTotal = new HtmlDiv();
        $divTotal->setClass("col-md-12");
        foreach ($this->mensagens as $mensagem) {
            $divContainer = new HtmlDiv();
            $divContainer->setClass("container");
            $div = new HtmlDiv();
            $div->setClass("alert alert-info");
            $div->setRole("alert");

            $strong = new htmlStrong();
            $strong->setTextoStrong("Notificação:  ");
            $strong->setTexto($mensagem);
            $div->addElemento($strong);
            $divContainer->addElemento($div);
            $divTotal->addElemento($divContainer);
        }
        return $divTotal;
    }

    abstract protected function montaForm($objeto = null);

    abstract public function recebeDadosDaConsulta();

    abstract public function recebeDadosDaEntrada();

    function getBt() {
        if (isset($_POST ['bt'])) {
            return $this->bt = $_POST ['bt'];
        } else {
            return null;
        }
    }

    function setBt($bt) {
        $this->bt = $bt;
    }

    function getMensagens() {
        $mensagens = array();

        foreach ($this->mensagens as $mensagem) {
            $htmlP = new HtmlP();
            $htmlP->setTexto($mensagem);
            $mensagens [] = $htmlP;
        }

        return $mensagens;
    }

    function addMensagem($mensagem) {
        $this->mensagens [] = $mensagem;
    }

    function addMensagens(array $mensagens) {
        foreach ($mensagens as $mensagem) {
            $this->addMensagem($mensagem);
        }
    }

    public function montaDivDeBotoes() {
        //div dos botões
        $divDeBotoes = new HtmlDiv();

        //botão de inclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("inclui");
        $button->setConteudo("Incluir");
        $divDeBotoes->addElemento($button);
        //botão de limpeza
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("limpa");
        $button->setConteudo("Limpar");
        $divDeBotoes->addElemento($button);

        return $divDeBotoes;
    }

}


