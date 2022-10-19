<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Libros</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="contenedor">
        <div class="contenedor-filtro">
            <div class="contenedor-titulo2">
                <h5 class="titulo">Iragazkiak</h5>
            </div>
            <div class="filtro">
                <label class="form-label mt-0">Generoa</label><br>
                <select name="Generoa" id="Generoa" class="selector">
                    <option value='0'>Aukeratu</option>
                    <?php   
                    header("Content-Type: text/html;charset=utf-8");
                    include_once "conexion.php";

                    $consultaGeneros = $miPDO->prepare('SELECT * from generoak;');
                    $consultaGeneros->execute();

                    $generos = $consultaGeneros->fetchAll();

                    foreach ($generos as $genero => $columna){
                        echo("
                        <option value='".$columna['generoKodea']."'>".$columna['izena']."</option>
                        ");
                    }
                    ?>
                </select>
            </div>
            <div class="filtro">
                <label class="form-label">Nota</label><br>
                <select name="Nota" id="Nota" class="selector">
                    <option value="0">Aukeratu</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="filtro">
                <label class="form-label">Formatua</label><br>
                <select name="Generoa" id="Generoa" class="selector">
                    <option value='0'>Aukeratu</option>
                    <?php   
                    
                    include_once "conexion.php";

                    $consultaFormatos = $miPDO->prepare('SELECT * from formatua;');
                    $consultaFormatos->execute();

                    $formatos = $consultaFormatos->fetchAll();

                    foreach ($formatos as $formato => $columna){
                        echo("
                        <option value='".$columna['formatuKodea']."'>".$columna['izena']."</option>
                        ");
                    }
                    ?>
                </select>
            </div>
            <div class="filtro">
                <label class="form-label">Hizkuntza</label><br>
                <select name="Hizkuntza" id="Hizkuntza" class="selector">
                    <option value='0'>Aukeratu</option>
                    <?php   
                    
                    include_once "conexion.php";

                    $consultaHizkuntzak = $miPDO->prepare('SELECT * from hizkuntzak;');
                    $consultaHizkuntzak->execute();

                    $hizkuntzak = $consultaHizkuntzak->fetchAll();

                    foreach ($hizkuntzak as $hizkuntza => $columna){
                        echo("
                        <option value='".$columna['hizkuntzaKodea']."'>".$columna['izena']."</option>
                        ");
                    }
                    ?>
                </select>
            </div>
            <a href="javascript:void(0)" class="btn-filtro">Bilatu</a>
        </div>

        <div class="contenedor-libros"> 
        <?php
        include_once "conexion.php";

        $consultaLibros = $miPDO->prepare('SELECT * from liburuak;');
        $consultaLibros->execute();

        $libros = $consultaLibros->fetchAll();

        foreach ($libros as $libro => $columna){
            echo("
                <div class='libro'>
                    <img class='imagen br-tr-7 br-tl-7' src='../img/".$columna['irudia']."' alt='Card image cap'>
                    <div class='contenedor-titulo'>
                        <h5 class='titulo'>".$columna['izenburua']."</h5>
                    </div>
                    <div class='contenedor-info'>
                        <p class='description'>".$columna['sinopsia']."</p>
                        <a href='#' class='leermas'>Irakurri gehiago <ion-icon name='arrow-redo-outline'></ion-icon></a>
                    </div>
                </div>
            ");
        }
        ?>
            
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



</body>
</html>