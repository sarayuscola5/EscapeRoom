<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liburuaren fitxa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="descripcion.css">
</head>

<body class="body">
    <?php
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $database = "igkluba";

    try {
        $conn = new PDO("mysql:host=$servidor;dbname=igkluba", $usuario, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "La conexión ha fallado: " . $e->getMessage();
    }

    //Recoger datos del libro
    $sql = "SELECT izenburua,idazlea, sinopsia, irudia, formatua, hizkuntza FROM liburuak WHERE liburuKodea=3";
    $result = $conn->query($sql);


    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $nombre = $row["izenburua"];
            $izenburua = strtoupper($nombre);
            $idazlea = $row["idazlea"];
            $sinopsia = $row["sinopsia"];
            $irudia = $row["irudia"];
            $formatua = $row["formatua"];
            $hizkuntza = $row["hizkuntza"];
            $imagen = '<img src="data:image/jpeg;base64,' . base64_encode($row['irudia']) . '"/>';
        }
    } else {
        echo "Emaitzik gabe.";
    }

    //Recoger la nota media del libro
    $notas = "SELECT AVG(nota)from balorazioak WHERE liburuKodea = 3";
    $resultNotas = $conn->query($notas);

    if ($resultNotas->rowCount() == 1) {
        while ($row = $resultNotas->fetch(PDO::FETCH_ASSOC)) {
            $notaSinDecimales = $row["AVG(nota)"];
            $notaMedia = number_format($notaSinDecimales, 2);
        }
    }

    //Seleccionar los comentarios que tiene cada libro y el alumno que los realiza
    $coments = "SELECT balorazioak.iruzkinak, ikasleak.izena FROM ikasleak JOIN balorazioak ON ikasleak.ikasleKodea = balorazioak.ikasleKodea WHERE liburuKodea = 3";
    $resultComents = $conn->query($coments);

    $conn = null;
    ?>
    <div class="page">
        <div class="page-main">

            <div class="app-content hor-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12">
                            <div class="card productdesc">
                                <div class="card-body">
                                    <div class="d-flex row productdec text-center justify-content-around">
                                        <div class="col-sm-4 p-6 text-left br-5">
                                            <?php echo $imagen ?>
                                        </div>
                                        <div class="val col-sm-5 mt-3">
                                            <h4 class="mt-3">BALORAZIOAK</h4>
                                            <div class="notaMedia mt-4">
                                                <h5 class="text-center">Bataz besteko nota:</h5>
                                                <div class="nota">
                                                    <h5><?php echo $notaMedia ?></h5>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="btn" class="valorar">Baloratu</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 mb-4">
                                        <h3><?php echo $izenburua ?></h3>
                                        <h5 class="mb-3 mt-2">Sinopsia</h5>
                                        <p><?php echo $sinopsia ?></p>
                                    </div>


                                    <div class="panel panel-primary">
                                        <div class="tab-menu-heading">
                                            <div class="tabs-menu">
                                                <!-- tags -->
                                                <ul class="flex nav nav-tabs justify-content-around">
                                                    <li><a href="#tab1" class="me-2" data-toggle="tab">Datuak</a></li>
                                                    <li><a href="#tab2" class="me-2" data-toggle="tab">Iruzkinak</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                <h5 class="mb-3 mt-3">Informazio orokorra</h5>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="row">
                                                        <div class="col-sm-3 text-muted">Idazlea:</div>
                                                        <div class="col-sm-5"><?php echo $idazlea ?></div>
                                                    </li>
                                                    <li class=" row">
                                                        <div class="col-sm-3 text-muted">Formatua:</div>
                                                        <div class="col-sm-5"><?php echo $formatua ?></div>
                                                    </li>
                                                    <li class="p-b-20 row">
                                                        <div class="col-sm-3 text-muted">Hizkuntza:</div>
                                                        <div class="col-sm-5"><?php echo $hizkuntza ?></div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="tab-pane" id="tab2">
                                                <h5 class="mb-3 mt-3">Iruzkinak</h5>
                                                <div class="balorazioak">
                                                    <?php
                                                            if ($resultComents->rowCount() > 0) {
                                                                while ($row = $resultComents->fetch(PDO::FETCH_ASSOC)) {
                                                                    $izenak = $row["izena"];
                                                                    $comentarios = $row["iruzkinak"];
                                                        
                                                                    echo ("<ul class='balorazioak list-unstyled mb-0'>
                                                                    <li class='row'>
                                                                        <div class='col-sm-3 text-muted'>Ikaslea:</div>
                                                                        <div class='col-sm-3'>" . $izenak  . "</div>
                                                                    </li>
                                                                    <li class='row'>
                                                                        <div class='col-sm-3 text-muted'>Iruzkina:</div>
                                                                        <div class='col-sm-8'>" . $comentarios . "</div>
                                                                    </li>
                                                                </ul>");
                                                                echo ("<br>");
                                                                }
                                                            }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>

</html>