<html>
<head>
    <title>Cambio formato de texto</title>
</head>
<body>
    <h1>Cambio formato de texto</h1>
    <form action="formateadorTextoValdezate24.php" method="post">
        <div>
            <label for="text">Pon tu texto:</label>
            <textarea name="text" rows="4" cols="50"></textarea>
        </div>
        <div>
            <label for="color">Cambia el color al texto:</label>
            <input type="color" name="color" value="#000000">
        </div>
        <div>
            <label for="font">Escoge tu fuente</label>
            <select name="font">
                <option value="Arial, sans-serif">Arial</option>
                <option value="Times New Roman, serif">Times New Roman</option>
                <option value="Courier New, monospace">Courier New</option>
            </select>
        </div>
        <div>
            <label for="size">Dime el tamaño para la fuente</label>
            <input type="number" name="size" value="16">
        </div>
        <button type="submit">Cambia el texto</button>
    </form>
</body>
</html>