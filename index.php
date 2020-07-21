<?php

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'POST')
    {
        echo "Se logro el method";
        $requestBody = file_get_contents('php://input');
        $json = json_decode($requestBody);
        $text = $json->queryResult->parameters->text;

        switch($text){
            case 'hi':
                $speech = "Hi, PORFIN SE CONECTO LA BD";
            break;
            
            case 'bye':
                $speech = "Bye, trataremos de tener listo lo de la BD la proxima vez que nos veamos";
            break;
            
            case 'anything':
                $speech = "Podras decir anything cuando la BD este lista";
            break;

            default:
                $speech = "Sorry, no te escuche porque estoy buscando resolver lo de la BD";
            break;
        }
       
        $response = new \stdclass();
        $response->fulfillmentText = $speech;
        $response->displayText = $speech;
        $response->source = "webhook";
        echo json_encode($response);

    }
    else{
        echo "Method not allowed";
    }
?>
