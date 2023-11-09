<html>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar los valores del formulario
        $opcion1 = $_POST["opcion1"];
        $opcion2 = $_POST["opcion2"];
        $opcion3 = $_POST["opcion3"];
        $opcion4 = $_POST["opcion4"];
        $opcion5 = $_POST["opcion5"];
    ?>

    <label for="opciones">Selecciona una opción:</label>
    <select id="opciones">
        <option value="<?php echo $opcion1; ?>"><?php echo $opcion1; ?></option>
        <option value="<?php echo $opcion2; ?>"><?php echo $opcion2; ?></option>
        <option value="<?php echo $opcion3; ?>"><?php echo $opcion3; ?></option>
        <option value="<?php echo $opcion4; ?>"><?php echo $opcion4; ?></option>
        <option value="<?php echo $opcion5; ?>"><?php echo $opcion5; ?></option>
    </select>

    <?php
    } else {
       
        echo "Formulario no enviado.";
    }
    ?>
</body>
</html>