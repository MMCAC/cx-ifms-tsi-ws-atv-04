<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cliente PHP - Calculadora WS</title>
</head>
<body>
    <h2>Calculadora Web Service (PHP Cliente)</h2>
    <form method="post" action="">
        <label>Valor 1: <input type="number" name="valor1" required></label><br><br>
        <label>Valor 2: <input type="number" name="valor2" required></label><br><br>
        <button type="submit" name="operacao" value="soma">Somar</button>
        <button type="submit" name="operacao" value="subtrai">Subtrair</button>
        <button type="submit" name="operacao" value="multiplica">Multiplicar</button>
        <button type="submit" name="operacao" value="divide">Dividir</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $valor1 = (int) $_POST['valor1'];
        $valor2 = (int) $_POST['valor2'];
        $operacao = $_POST['operacao'];

        try {
            $wsdl = "http://localhost:8080/calcws?wsdl";
            $client = new SoapClient($wsdl);

            $resultado = $client->$operacao([
                'valor1' => $valor1,
                'valor2' => $valor2
            ]);

            echo "<h3>Resultado: " . $resultado->return . "</h3>";
        } catch (Exception $e) {
            echo "<p>Erro: " . $e->getMessage() . "</p>";
        }
    }
    ?>
</body>
</html>
