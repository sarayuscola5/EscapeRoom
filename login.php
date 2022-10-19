<?php 
$error = false;
if (isset($_POST['submit'])) {
    $usuario = $_POST['email'];
    $psw = $_POST['psw'];
    $login = false;

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
        $error = true;
        formulario();
    }
}else{
    formulario();
}

function formulario () {
    echo("
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Login</title>
            <link rel='stylesheet' href='login.css'>
        </head>
        <body>
            <div class='page'>		
                <div class='logo'>
                    <img src='imagenes/igkluba.png' class='header-brand-img'>
                </div>
                    <div class='container-login'>
                    <div class='bloque-login'>
                        <div class='card-body'>
                            <form class='login' action='login.php' method='post'>
                                <span class='titulo'>
                                    Hasi saioa
                                </span>
                                <div>
                                    <span><ion-icon name='person-outline'></ion-icon> Email</span>
                                    <input class='datos' id='email' type='text' name='email'>
                                </div>
                                <br>
                                <div>
                                    <span><ion-icon name='lock-closed-outline'></ion-icon> Pasahitza</span>
                                    <input class='datos' id='psw' type='password' name='psw'>
                                </div>");
                                if($error == false){
                                    echo(" <div class='container-error'>
                                        <p id='error' hidden>Emaila edo pasahitza txarto daude. <br> Saiatu berriro.</p>
                                    </div>
                                    ");
                                }else{
                                    echo(" <div class='container-error'>
                                        <p id='error'>Emaila edo pasahitza txarto daude. <br> Saiatu berriro.</p>
                                    </div>
                                    ");
                                }

                                echo("
                                <div>
                                    <p class='mb-0'><a href='recuperarContraseña.html' class='contraseña'>Pasahitza ahaztua?</a></p>
                                </div>
                                <div class='container-login-btn'>
                                    <input type='submit' class='login-btn' id='btn-enviar' value='Sartu'>
                                </div>
                                <div class='container-registrar'>
                                    <p class='registrar'>Ez kidea?<a href='registro.html'> Sortu kontu bat</a></p>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        <script type='module' src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
        <script nomodule src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>

        <script>
            document.getElementById('btn-enviar').addEventListener('click', validacion);
            function validacion(evento){
                email = document.getElementById('email').value; 
                psw = document.getElementById('psw').value;
                if(email != '' && psw != ''){return true;}else{evento.preventDefault(), document.getElementById('error').hidden=false}
            }
        </script>
        </html>
    ");
}

?>