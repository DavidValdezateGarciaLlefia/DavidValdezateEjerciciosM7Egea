<!DOCTYPE html>
<html>
<head>
    <title>Calculadora</title>
</head>
<body>
    <h2>Calculadora</h2>
    <form action="" method="post">
        <label for="num1">Número 1:</label>
        <input type="text" name="num1" id="num1" required><br>

        <label for="num2">Número 2:</label>
        <input type="text" name="num2" id="num2" required><br>

        <label for="num3">Número 3:</label>
        <input type="text" name="num3" id="num3" required><br>

        <label for="operacion">Operación:</label>
        <select name="operacion" id="operacion">
            <option value="sumar">Sumar</option>
            <option value="restar">Restar</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
        </select><br>

        <input type="submit" value="Calculadora">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $num3 = $_POST["num3"];
        $operacion = $_POST["operacion"];

        if (is_numeric($num1) && is_numeric($num2) && is_numeric($num3)) {
            $resultado = 0;

            if ($operacion === "sumar") {
                $resultado = $num1 + $num2 + $num3;
                echo "Resultado de la suma: $resultado";
            } elseif ($operacion === "restar") {
                $resultado = $num1 - $num2 - $num3;
                echo "Resultado de la resta: $resultado";
            } elseif ($operacion === "multiplicar") {
                $resultado = $num1 * $num2 * $num3;
                echo "Resultado de la multiplicación: $resultado";
            } elseif ($operacion === "dividir") {
                if ($num2 != 0 && $num3 != 0) {
                    $resultado = $num1 / ($num2 * $num3);
                    echo "Resultado de la división: $resultado";
                } else {
                    echo "Error: No se puede dividir por cero.";
                }
            } else {
                echo "Operación no válida.";
            }
        } else {
            echo "Por favor, ingrese números válidos.";
        }
    }
    ?>
</body>
</html>