<?php
// Pilote de la application au site web
// Parfois appelé "Routeur" ou "Front Controller"
include('config/bd.cfg.php');


use function PHPSTORM_META\map;

$route = "";
if(isset($_GET["route"])) {
    //Exemple plat/tout ou vin
    $route = $_GET["route"];
}

$routeur = new Routeur($route);
$routeur->invoquerRoute();

class Routeur
{
    private $route = "";
    function __construct($r)
    {
        $this->route = $r;
        spl_autoload_register(function($nomClasse) {
            //nomClasse = AccesBd qu'on transforme -- acces-bd --acces-bd-cls-php
            $nomFichier = "$nomClasse.cls.php";
            if(file_exists("modeles/$nomFichier")) {
              include("modeles/$nomFichier");
            }
            else if(file_exists("controleurs/$nomFichier")) {
              include("controleurs/$nomFichier");
            }
            else {
              exit("Boommm");
            }
          });
    }

    public function invoquerRoute() {
        $module = "accueil"; //Autres posibilités serait vin plat ect.
        $action = "index";
        $param = "";
        $routeTableau = explode('/', $this->route);
        //exemples : ['plat', 'suprimer', '17']  ou ['plat', 'tout'] ou [''] 

        if(count($routeTableau) > 0 && trim($routeTableau[0] != '')) {
            //$module = 'plat' et $routeTableau = ['suprimer', '17']
            $module = array_shift($routeTableau);
            if (count($routeTableau) > 0 && trim($routeTableau[0] != '')) {
                //action = 'suprimer' et $routeTableau = ['17']
                $action = array_shift($routeTableau);
                $param = $routeTableau;
            }
        }
        // Instancier le controleur correspondant au module iindique et  
        // invoque la methode de cet object correspondant a la action indiquée
        $nomControleur = ucfirst($module). 'Controleur';
        $nomModele = ucfirst($module). 'Modele';

        if (class_exists($nomControleur)) {
            if(!is_callable(array($nomControleur, $action))) {
                $action = 'index';
            }
            $controleur = new $nomControleur($nomModele, $module, $action);
            $controleur->$action($param);
        }
        else {
            $controleur = new AccueilControleur();
        }
    }
}