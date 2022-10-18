<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="desc2.css">
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

    $sql = "SELECT izenburua,idazlea, sinopsia, irudia, formatua, hizkuntza FROM liburuak WHERE liburuKodea=1";
    $result = $conn->query($sql);


    if ($result->rowCount() == 1) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $nombre = $row["izenburua"];
            $izenburua = strtoupper($nombre);
            $idazlea = $row["idazlea"];
            $sinopsia = $row["sinopsia"];
            $irudia = $row["irudia"];
            $formatua = $row["formatua"];
            $hizkuntza = $row["hizkuntza"];
            $imagen = '<img src="data:image/jpeg;base64,'.base64_encode( $row['irudia'] ).'"/>';
        }    

    } else {
        echo "0 resultados";
    }

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
                                          <?php echo $imagen; ?>
                                        </div>
                                        <div class="val col-sm-5 mt-3">
                                            <h4 class="mt-3">VALORACIONES</h4>
                                            <div class="notaMedia mt-4">
                                                <h5 class="text-center">Nota media:</h5>
                                                <div class="nota">
                                                    <h5>6</h5>
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
                                        <div class="panel-heading">
                                            <div class="tabs-menu">
                                                <ul class="flex nav panel-tabs justify-content-around">
                                                    <li><a href="#tab1" class="active me-2"
                                                            data-bs-toggle="tab">Datuak</a></li>
                                                    <li><a href="#tab2" data-bs-toggle="tab">Review</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab1">
                                                    <h4 class="mb-3 mt-5">Informazio orokorra</h4>
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="row">
                                                            <div class="col-sm-3 text-muted">Idazlea</div>
                                                            <div class="col-sm-3"><?php echo $idazlea ?></div>
                                                        </li>
                                                        <li class=" row">
                                                            <div class="col-sm-3 text-muted">Formatua</div>
                                                            <div class="col-sm-3"><?php echo $formatua ?></div>
                                                        </li>
                                                        <li class="p-b-20 row">
                                                            <div class="col-sm-3 text-muted">Hizkuntza</div>
                                                            <div class="col-sm-3"><?php echo $hizkuntza ?></div>
                                                        </li>
                                                    </ul>
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