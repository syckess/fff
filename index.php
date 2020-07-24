<?php

    $method = $_SERVER['REQUEST_METHOD'];
    
    if($method == 'POST')
    {
        $requestBody = file_get_contents('php://input');
        $json = json_decode($requestBody);
        $text = $json->queryResult->parameters->text;
        $id = 'Matias';
        
        
        $servername = "bfpefjoyqfutj3kawr98-mysql.services.clever-cloud.com:3306";
        $database = "bfpefjoyqfutj3kawr98";
        $username = "u9oqkqjvsiok9pxt";
        $password = "nJ5nsu5Xt5uhDqx21wHE";
        $conn = mysqli_connect($servername, $username, $password, $database);

        switch($text)
        {
            case 'No':
                $speech = "Hi, PORFIN SE CONECTO LA BD";
                $punto = 5;
            break;
           
            case 'Poca':
                $speech = "Bye, trataremos de tener listo lo de la BD la proxima vez que nos veamos";
                $punto = 10;
            break;
            
            case 'Si':
                $speech = "Podras decir anything cuando la BD este lista";
                $punto = 20;
            break;
                
            case 'resultadito':
                $aux = 1;
            break;    
                
            case 'Acepto':
      
            break;  

            default:
                $speech = "Sorry, no te escuche porque estoy buscando resolver lo de la BD";
            break;
        }
        if($aux == 1)
        {
            $sql = "SELECT SUM(acum) as suma FROM acumulador WHERE id = '$id'";
            $resultado = mysqli_query($conn, $sql);
            $fetch = mysqli_fetch_array($resultado); 
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
            
            $sql = "INSERT INTO acumulador (acum, id) VALUES ('$punto', '$id')";
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
