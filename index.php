<?php

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'POST')
    {
        $requestBody = file_get_contents('php://input');
        $json = json_decode($requestBody);
        $text = $json->queryResult->parameters->text;
        
        
        $servername = "bfpefjoyqfutj3kawr98-mysql.services.clever-cloud.com:3306";
        $database = "bfpefjoyqfutj3kawr98";
        $username = "u9oqkqjvsiok9pxt";
        $password = "nJ5nsu5Xt5uhDqx21wHE";
        $conn = mysqli_connect($servername, $username, $password, $database);

        switch($text)
        {
            case 'hi':
                $speech = "Hi, PORFIN SE CONECTO LA BD";
                $punto = 5;
            break;
            
            case 'bye':
                $speech = "Bye, trataremos de tener listo lo de la BD la proxima vez que nos veamos";
                $punto = 10;
            break;
            
            case 'anything':
                $speech = "Podras decir anything cuando la BD este lista";
                $punto = 20;
            break;
            
            case 'si':
                $aux = 1;
            break;    
                
            default:
                $speech = "Sorry, no te escuche porque estoy buscando resolver lo de la BD";
            break;
        }
        if($aux == 1)
        {
            $speech2 = "jajaja";
            $response2 = new \stdclass();
            $response2->fulfillmentText = $speech2;
            $response2->displayText = $speech2;
            $response2->source = "webhook";
            echo json_encode($response2);
            $sql2 = "select sum(acum) from acumulador";
         }
        else
        {
            $response = new \stdclass();
            $response->fulfillmentText = $speech;
            $response->displayText = $speech;
            $response->source = "webhook";
            echo json_encode($response);
        }
        $sql = "INSERT INTO acumulador (acum) VALUES ('$punto')";
        mysqli_query($conn, $sql, $sql2);
        mysqli_close($conn);   

        
    }
    else
    {
        echo "Method no permitido";
    }
?>
