<?php

class Routing {

    private $uri;
    private $uriExploded;

    private $controller;
    private $controllerName;
    private $action;
    private $actionName;
    private $params;
    private $side;

    public function __construct() {
        $this->setUri($_SERVER["REQUEST_URI"]);
        $this->setDiff ();
        $this->setController();
        $this->setAction();
        $this->setParams();
        $this->runRoute();
    }

    public function setUri ($uri) {
        $uri = preg_replace("/".PATH_RELATIVE_PATTERN."/i", "", $uri, 1);
        echo PATH_RELATIVE_PATTERN;
                echo "<br>";
        var_dump($uri);
        echo "<br>";
        var_dump($_SERVER["REQUEST_URI"]);
        echo "<br>";
        $this->uri = trim($uri, "/");
        $this->uriExploded = explode("/", $this->uri);
        var_dump($this->uri);
        echo "<br>";
        var_dump($this->uriExploded);
        echo "<br>";
    }

    public function setDiff () {
        if($this->uriExploded[0] == "back"){
            $this->side = "back";
        }else{
            $this->side = "front";
        }
    }

    public function setController() {
        if($this->side == "front"){
            $this->controller = (empty($this->uriExploded[0])) ? "index" : $this->uriExploded[0];
            $this->controllerName = $this->controller."Controller";
            var_dump(  $this->controllerName);
        }else{
            $this->controller = (empty($this->uriExploded[0])) ? "index" : $this->uriExploded[0].$this->uriExploded[1];
            $this->controllerName = $this->controller."Controller";
            unset($this->uriExploded[0]);
        }
    }

    public function setAction()
    {
        if ($this->side === "front") {
            $this->action = (empty($this->uriExploded[0])) ? "index" : $this->uriExploded[0];
            $this->actionName = $this->action . "Action";
            var_dump($this->actionName);
            unset($this->uriExploded[0]);
        }
        elseif ($this->side === "back" && !empty($this->uriExploded[2])) {
            $this->action = (empty($this->uriExploded[1])) ? "index" : $this->uriExploded[1] . $this->uriExploded[2];
            $this->actionName = $this->action . "Action";
            var_dump($this->actionName);
            unset($this->uriExploded[1]);
            unset($this->uriExploded[2]);
        }
    }

    public function setParams() {
        $this->params = array_merge(array_values($this->uriExploded), $_POST);
    }

    /*
    - est-ce que le fichier existe correspondant au controleur
    - est-ce qu'on peut créer un objet à partir de ce controleur
    - est-ce que dans l'objet il y a cette méthode
    - s'il y a cette méthode on retourne le booléen, sinon on retourne false
    */

    public function checkRoute() {
        $pathController = "controllers".DS.ucfirst($this->controllerName).".class.php";

        if (!file_exists($pathController)) {
            Helpers::log("Le contrôleur ".$this->controllerName." n'existe pas.");
            echo "haha";
            return false;
        }

        include $pathController;

        if (!class_exists($this->controllerName)) {
            Helpers::log("La classe ".$this->controllerName." n'existe pas.");
            echo "hihi";
            return false;
        }

        if (!method_exists($this->controllerName, $this->actionName)) {
            Helpers::log("La méthode ".$this->actionName." n'existe pas dans la classe ".$this->controllerName.".");
            echo "hoho";
            return false;
        }

        return true;
        echo "haha";
    }

    public function runRoute() {
        if ($this->checkRoute()) {
                $controller = new $this->controllerName;
                $controller->{$this->actionName}($this->params);

        } else {
            $this->page404();
        }
    }

    public function page404() {

        die("
            <link rel=\"stylesheet\" href=\"".PATH_RELATIVE."./assets/back/css/style.css\"> 
            <div class=\"bg-notf\">
             <div class=\"not-found\">
                <h1>Erreur</h1>
                <div class='backpage' ><a href=\"javascript:history.go(-1)\">Revenir à la page précédente</a></div>
             </div>
            </div>
        ");
    }

}
