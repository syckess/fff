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
        $sql = "INSERT INTO acumulador (acum) VALUES ('$punto')";
        //$result = "SELECT SUM(acum) AS total FROM acumulador";
        //$row = mysql_fetch_assoc($result);
        //$total = $row['total'];
        mysqli_query($conn, $sql, $result, $row);
        mysqli_close($conn);   
        if($aux == 1)
        {

            $speech2 = "jajaj";
            $response2 = new \stdclass();
            $response2->fulfillmentText = $speech2;
            $response2->displayText = $speech2;
            $response2->source = "webhook";
            echo json_encode($response2);
            
         }
        else
        {
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
