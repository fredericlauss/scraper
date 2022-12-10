<?php

function getAllTshirts() {
    $file = '../data.json'; 
    $result = file_get_contents($file); 
    sendJSON($result);
}

function getTshirtsByPage($page) {
    $file = '../data.json'; 
    $data = file_get_contents($file); 
    $obj = json_decode($data);

    // nombre de pages totales
    $length = count($obj);
    $nbpages = ceil($length / 16);

    // page d'avant ou d'apres 
    if($page != 1) {
        $previousPage = $page - 1;
    } else {
        $previousPage = 0;
    }
    if($page < $nbpages) {
        $nextPage = $page + 1;
    } else {
        $nextPage = 0;
    }

    // données de la page
    $debut = $page * 16 - 16;
    $dataPage = array_slice($obj, $debut, 16);
    $lengthpage = count($dataPage);

    // mettre tout dans l'array ( données page avant/apres + data)
    $dataPerPage = array( 
    "previousPage" => $previousPage,
    "pageActuelle" => $page,
    "nextPage" => $nextPage,
    "data" => $dataPage );
    $result = json_encode($dataPerPage,JSON_UNESCAPED_UNICODE);
    sendJSON($result);
}

function getTshirtById($id) {
    $idJson = $id - 1;
    $file = '../data.json'; 
    $data = file_get_contents($file); 
    $obj = json_decode($data);
    $dataId = $obj[$idJson];
    $result = json_encode($dataId,JSON_UNESCAPED_UNICODE);
    sendJSON($result);
    // sendJSON($dataId);
}

function sendJSON($data) {
    header("Access-Control'Allow-Origin: *");
    header("Content-Type: application/json");
    echo ($data);
}