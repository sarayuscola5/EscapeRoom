<?php 
$usuario = $_POST['email'];
$psw = $_POST['psw'];
$login = false;

$hostDB = '127.0.0.1';
$nombreDB = 'igkluba';
$usuarioDB = 'root';
$password = 'root';

$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB);

$consultaIkasleak = $miPDO->prepare('SELECT helbidea, pasahitza from ikasleak;');
$consultaIrakasleak = $miPDO->prepare('SELECT helbidea, pasahitza  from irakasleak;');

$consultaIkasleak->execute();
$consultaIrakasleak->execute();

$ikasleak = $consultaIkasleak->fetchAll();
$irakasleak = $consultaIrakasleak ->fetchAll();

foreach($ikasleak as $ikasle => $columna){
    if($columna['helbidea'] == $usuario && $columna['pasahitza'] == $psw){
        $login = true;
    }
}

foreach($irakasleak as $irakasle => $columna){
    if($columna['helbidea'] == $usuario && $columna['pasahitza'] == $psw){
        $login = true;
    }
}

if($login == true)
{
    header('Location: index.php');
    exit;
}else{
    echo ("usuario incorrecto");
}
?>