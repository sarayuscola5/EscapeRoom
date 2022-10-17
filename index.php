<?php
$hostDB = '127.0.0.1';
$nombreDB = 'igkluba';
$usuarioDB = 'root';
$password = 'root';

$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB);

$consultaLibros = $miPDO->prepare('SELECT * from liburuak;');
$consultaLibros->execute();

$libros = $consultaLibros->fetchAll();

foreach ($libros as $libro => $columna){
    echo("
    <div class='card'>   
        <div class='card-header'>
            <h5 class='card-title'>".$columna['izenburua']."</h5>
        </div>
        <div class='card-body'>
            <p class='card-text'>".$columna['sinopsia']."</p>
            <a href='#' class='float-end'>Irakurri gehiago<ion-icon name='chevron-forward-outlinei></ion-icon></a>
        </div>
    </div>

    <script type='module' src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
    <script nomodule src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
    ");
}






?>