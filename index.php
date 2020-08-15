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
                if($edad >= 60)
                {
                    $punto = 15;
                }
                else if($edad < 60 && $edad >= 40)
                {
                    $punto = 10;
                }
                else if($edad < 40 && $edad >= 1)
                {
                    $punto = 5;
                }
            break;
           
            case 'Poca':
                if($edad >= 60)
                {
                    $punto = 20;
                }
                else if($edad < 60 && $edad >= 40)
                {
                    $punto = 15;
                }
                else if($edad < 40 && $edad >= 1)
                {
                    $punto = 10;
                }
            break;
            
            case 'Si':
                if($edad >= 60)
                {
                    $punto = 25;
                }
                else if($edad < 60 && $edad >= 40)
                {
                    $punto = 20;
                }
                else if($edad < 40 && $edad >= 1)
                {
                    $punto = 15;
                }
            break;
                
            case 'C':
                if($edad >= 60)
                {
                    $punto = 25;
                }
                else if($edad < 60 && $edad >= 40)
                {
                    $punto = 20;
                }
                else if($edad < 40 && $edad >= 1)
                {
                    $punto = 15;
                }
            break;
                
            case 'B':
                if($edad >= 60)
                {
                    $punto = 20;
                }
                else if($edad < 60 && $edad >= 40)
                {
                    $punto = 15;
                }
                else if($edad < 40 && $edad >= 1)
                {
                    $punto = 10;
                }
            break;
                
            case 'A':
                if($edad >= 60)
                {
                    $punto = 15;
                }
                else if($edad < 60 && $edad >= 40)
                {
                    $punto = 10;
                }
                else if($edad < 40 && $edad >= 1)
                {
                    $punto = 5;
                }
            break;
            
            case 'Ver mi resultado':
                
                $aux = 1;
            break;
            case 'No ver mi resultado':
                
                $speech = "Bueno, adios";
            break;
                
            case 'Padezco':
                
                $punto = 50;
            break;
                
            case 'No padezco':
                
                $punto = 0;
            break;

            default:
                $speech = "Disculpa, no te entendi, vuelve a intentarlo porfavor";
                $punto = 0;
            break;
        }
         $sql = "SELECT acum FROM acumulador WHERE id = '$id' and edad = '$edad'";
         $resultado = mysqli_query($conn, $sql);
         $fetch = mysqli_fetch_array($resultado); 
        if($aux == 1)
        {
            if($fetch[0] >= 35 && $fetch[0] <= 62)
                {
                    $speech = "Estimado $id , según las respuestas que usted ha dado, le informamos que la probabilidad de que usted tenga coronavirus es: Muy baja";
                    $response = new \stdclass();
                    $response->fulfillmentText = $speech;
                    $response->displayText = $speech;
                    $response->source = "webhook";
                    echo json_encode($response); 
                }
                else if($fetch[0] > 62 && $fetch[0] <= 88)
                {
                    $speech = "Estimado $id , según las respuestas que usted ha dado, le informamos que la probabilidad de que usted tenga coronavirus es: Baja";
                    $response = new \stdclass();
                    $response->fulfillmentText = $speech;
                    $response->displayText = $speech;
                    $response->source = "webhook";
                    echo json_encode($response);
                }
                else if($edad > 88 && $edad <= 114)
                {
                    $speech = "Estimado $id , según las respuestas que usted ha dado, le informamos que la probabilidad de que usted tenga coronavirus es: Media";
                    $response = new \stdclass();
                    $response->fulfillmentText = $speech;
                    $response->displayText = $speech;
                    $response->source = "webhook";
                    echo json_encode($response);
                }
                else if($fetch[0] > 114 && $fetch[0] <= 127)
                {
                    $speech = "Estimado $id , según las respuestas que usted ha dado, le informamos que la probabilidad de que usted tenga coronavirus es: Alta";
                    $response = new \stdclass();
                    $response->fulfillmentText = $speech;
                    $response->displayText = $speech;
                    $response->source = "webhook";
                    echo json_encode($response);
                }
                else if($fetch[0] > 127 && $fetch[0] <= 140)
                {
                    $speech = "Estimado $id , según las respuestas que usted ha dado, le informamos que la probabilidad de que usted tenga coronavirus es: Muy alta";
                    $response = new \stdclass();
                    $response->fulfillmentText = $speech;
                    $response->displayText = $speech;
                    $response->source = "webhook";
                    echo json_encode($response);
                }
            //$speech = "Tu puntiación es: $fetch[0]";
            //$response = new \stdclass();
            //$response->fulfillmentText = $speech;
            //$response->displayText = $speech;
            //$response->source = "webhook";
            //echo json_encode($response);    
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
                $sql = "UPDATE acumulador SET acum = '$suma' WHERE id='$id' and edad='$edad'"; 
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
