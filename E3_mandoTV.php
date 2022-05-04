<?php
 //lo del sesion start... debe ser lo primero
    if (!isset($_SESSION)) {
        session_start(); //inicializa la variable $_SESSION
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>MANDO</title>
    </head>
    
    <body>
    
    <?php
        require_once './clases/E3_Tv.php'; //la clase Tv
        
       /*
        var_dump($_SESSION);
        echo '<br>';
        var_dump($_POST);
        echo '<br>';
        echo '<br>';
        echo '<br>';
        * 
        */
        
        // Vemos si venimos de E3_inicioTele.html.
        // Para ello preguntamos por $_POST['mando']; si está es que estamos 
        // creando la tele y por lo tanto creamos el objeto $miTele 
        // con los datos recibidos del formulario
        
        if (isset($_POST['mando'])) {
            //creamos la tele $miTele con valores fijos.
            $miTele = new Tv($_POST['marca'], $_POST['precio'],
                             $_POST['pulgadas']);
            
            /*
            var_dump($miTele);
            echo '<br>';
             * 
             */
            
        } else {
            
            // Venimos de esta misma pagina (se ha pulsado un boton del mando)
            //y ya existía $miTele en la variable $_SESSION['tele']
            //recuperamos la variable $miTele de la $_SESSION['tele']
            $miTele = unserialize($_SESSION['tele']);
            
            //cogemos la "orden" de $_POST['boton']
            $orden = $_POST['boton'];
            
            //llamamos al método procesaOrden($orden)
            $miTele->procesaOrden($orden);
            
        }
        
        // Mostramos la información técnica y el estado actual
        echo $miTele->informacionTecnica() . "<br/>";
        echo $miTele->estadoActual() . "<br/>";
        
        // Almacenamos a la variable $_SESSION['tele']
        $_SESSION['tele'] = serialize($miTele);
        
        ?>
        
        <!-- construimos el formulario para manejar la tele -->
        <form action="E3_mandoTV.php" method="POST">
            <?php require './E3_dibujaControles.php'; ?>
            <br>
            <input type="submit" formaction="E3_inicioTele.html" 
                   formmethod="POST" value="OTRA TELE">
        </form>
    </body>
</html>
