<?php

    $method = $_SERVER['REQUEST_METHOD'];
    
    if($method == 'POST')
    {
        $requestBody = file_get_contents('php://input');
        $json = json_decode($requestBody);
        $text = $json->queryResult->parameters->text;
        $id = $json->queryResult->parameters->id;
        $edad = $json->queryResult->parameters->edad;
        
        
        $servername = "bfpefjoyqfutj3kawr98-mysql.services.clever-cloud.com:3306";
        $database = "bfpefjoyqfutj3kawr98";
        $username = "u9oqkqjvsiok9pxt";
        $password = "nJ5nsu5Xt5uhDqx21wHE";
        $conn = mysqli_connect($servername, $username, $password, $database);

        switch($text)
        {
            case 'No':
                //$speech = "Hi, PORFIN SE CONECTO LA BD";
                $punto = 5;
            break;
           
            case 'Poca':
                //$speech = "Bye, trataremos de tener listo lo de la BD la proxima vez que nos veamos";
                $punto = 10;
            break;
            
            case 'Si':
                //$speech = "Podras decir anything cuando la BD este lista";
                $punto = 20;
            break;
                
            case 'resultadito':
                $aux = 1;
            break;    
                
            case 'Acepto':
      
            break;  

            default:
                //$speech = "Sorry, no te escuche porque estoy buscando resolver lo de la BD";
            break;
        }
         $sql = "SELECT acum FROM acumulador WHERE id = '$id' and edad = '$edad'";
         $resultado = mysqli_query($conn, $sql);
         $fetch = mysqli_fetch_array($resultado); 
        if($aux == 1)
        {
            $speech = $fetch[0];
            $response = new \stdclass();
            $response->fulfillmentText = $speech;
            $response->displayText = $speech;
            $response->source = "webhook";
            echo json_encode($response);    
            mysqli_close($conn);
        }
        else
        {
            $rows = mysqli_num_rows($resultado); 
            if($rows == 0)
            {
                 $sql = "INSERT INTO acumulador (acum, id, edad) VALUES ('$punto', '$id', '$edad')";
            }
            else
            {
                $suma = $fetch[0] + $punto;
                $sql = "UPDATE acumulador SET acum = '$suma' WHERE id='$id' and edad=$edad"; 
            }
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            $response = new \stdclass();
            $response->fulfillmentText = $speech;
            $response->displayText = $speech;
            $response->source = "webhook";
            echo json_encode($response);
           
        }   


    }
    else
    {
        echo "Method no permitido";
    }
?>
