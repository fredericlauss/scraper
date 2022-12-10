<?php

require_once("./api.php");
// page 1 default/tshirts
// t-shirts par pages tshirts/:nbpage ( avec $data, page actuelle, page précédente , page suivante)
// un t-shirt en particulier tshirt/:id

try {
    if(!empty ($_GET['demande'])) {
        // séparer l'url quand il y a des "/"
        $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
        // séparation des url pour tshirt ou tshirts
        switch($url[0]) {
            case "tshirts" :
                if(empty($url[1])) {
                    getAllTshirts();
                } else {
                    getTshirtsByPage($url[1]);
                }
            break;
            case "tshirt" : 
                if(!empty($url[1])) {
                    getTshirtById($url[1]);
                } else {
                    throw new Exception ("problème dans la saisie de l'url, pas d'id renssegnée");
                }
            break;
            default : throw new Exception ("problème dans la saisie de l'url, la demande n'est pas valide");
        }
    } else {
        throw new Exception ("pb de récup de Data");
    }
} catch(Exception $e) {
    $erreur =[
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
    print_r($erreur);
}

