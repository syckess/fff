<?php



    $servername = "bfpefjoyqfutj3kawr98-mysql.services.clever-cloud.com:3306";
    $database = "bfpefjoyqfutj3kawr98";
    $username = "u9oqkqjvsiok9pxt";
    $password = "nJ5nsu5Xt5uhDqx21wHE";
    $conn = mysqli_connect($servername, $username, $password, $database);

    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'POST')
    {
        $requestBody = file_get_contents('php://input');
        $json = json_decode($requestBody);
        $text = $json->queryResult->parameters->text;

        switch($text)
        {
            case 'hi':
                if (mysqli_query($conn, $sql)) {
                      $speech = "Hi, PORFIN SE CONECTO LA BD y le añadi el valor 1";
                 }
                $sql = "INSERT INTO acumulador (acum) VALUES ('1')";
                mysqli_close($conn);
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
    else
    {
        echo "Method not allowed";
    }
?>
