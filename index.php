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
                <select name="beast" id="select-beast" class="form-control form-select select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                    <option value="0">--Select--</option>
                    <option value="1">Foot wear</option>
                    <option value="2">Top wear</option>
                    <option value="3">Bootom wear</option>
                    <option value="4">Men's Groming</option>
                    <option value="5">Accessories</option>
                </select>
            </div>
            <div class="filtro">
                <label class="form-label">Balorazioa</label><br>
                <select name="beast" id="select-beast1" class="form-control form-select select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                    <option value="0">--Select--</option>
                    <option value="1">Western wear</option>
                    <option value="2">Foot wear</option>
                    <option value="3">Top wear</option>
                    <option value="4">Bootom wear</option>
                    <option value="5">Beuty Groming</option>
                    <option value="6">Accessories</option>
                    <option value="7">jewellery</option>
                </select>
            </div>
            <div class="filtro">
                <label class="form-label">Formatua</label><br>
                <select name="beast" id="select-beast2" class="form-control form-select select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                    <option value="0">--Select--</option>
                    <option value="1">Boys clothing</option>
                    <option value="2">girls Clothing</option>
                    <option value="3">Toys</option>
                    <option value="4">Baby Care</option>
                    <option value="5">Kids footwear</option>
                </select>
            </div>
            <div class="filtro">
                <label class="form-label">Hizkuntza</label><br>
                <select name="beast" id="select-beast3" class="form-control form-select select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                    <option value="0">--Select--</option>
                    <option value="1">Mobiles</option>
                    <option value="2">Laptops</option>
                    <option value="3">Gaming &amp; Accessories</option>
                    <option value="4">Health care Appliances</option>
                </select>
            </div>
            <a href="javascript:void(0)" class="btn btn-primary d-grid mt-5">Submit</a>
        </div>

        <div class="contenedor-libros"> 
        <?php
        header("Content-Type: text/html;charset=utf-8");
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
                <div class='libro'>
                    <img class='imagen br-tr-7 br-tl-7' src='../img/".$columna['irudia']."' alt='Card image cap'>
                    <div class='contenedor-titulo'>
                        <h5 class='titulo'>".$columna['izenburua']."</h5>
                    </div>
                    <div class='contenedor-info'>
                        <p class='description'>".$columna['sinopsia']."</p>
                        <a href='#' class='leerMas'>Irakurri gehiago<ion-icon name='chevron-forward-outline'></ion-icon></a>
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