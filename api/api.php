<?php

function getAllTshirts() {
    $file = '../data.json'; 
    $result = file_get_contents($file); 
    sendJSON($result);
}

function getTshirtsByPage($page) {
    echo "page avec des tshirt";
    $file = '../data.json'; 
    $data = file_get_contents($file); 
    $obj = json_decode($data);
    $length = count($obj);
    echo($length);
}

function getTshirtById($id) {
    $idJson = $id - 1;
    $file = '../data.json'; 
    $data = file_get_contents($file); 
    $obj = json_decode($data);
    $dataId = $obj[$idJson];
    $result = json_encode($dataId);
    sendJSON($result);
    // sendJSON($dataId);
}

function sendJSON($data) {
    header("Access-Control'Allow-Origin: *");
    header("Content-Type: application/json");
    echo ($data);
}