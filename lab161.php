<!DOCTYPE html>
<html lang="es">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>Consulta de Servicio Web de Conversión de Temperatura</h1>    
    <form action="lab161.php" name="FormConv" method="post">
        <br>
        Convertir desde <select name="temp" id="">
            <option value="CtoF" selected>°C a °F</option>
            <option value="FtoC">°F a °C</option>
        </select> el valor
        <input type="number" name="valor" step="any" required>
        <input type="submit" name="Convertir" value="Convertir">
    </form>

<?php
$servicio = "https://www.w3schools.com/xml/tempconvert.asmx?wsdl";
$parametros = array();
if(array_key_exists("Convertir", $_POST)) {
    $valor = $_POST["valor"];
    $temp = $_POST["temp"];

    if($temp == "CtoF") {
        $parametros["Celsius"] = $valor;
        $cliente = new SoapClient($servicio, $parametros);
        $resultoObj = $cliente->CelsiusToFahrenheit($parametros);
        $resultado = $resultoObj->CelsiusToFahrenheitResult;
    } else {
        $parametros["Fahrenheit"] = $valor;
        $cliente = new SoapClient($servicio, $parametros);
        $resultoObj = $cliente->FahrenheitToCelsius($parametros);
        $resultado = $resultoObj->FahrenheitToCelsiusResult;
    }

    print("<br>La temperatura $valor °".substr($temp,0,1)." es igual a: $resultado °".substr($temp,3,1));
}

?>
</body>
</html>