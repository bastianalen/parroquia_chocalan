
<!DOCTYPE html>
<html>
<head>
    <title>Donación de dinero</title>
    <link href="../../donacionStyle.css" rel="stylesheet">
</head>
<body>
    <h1>Donación de dinero</h1>
    
    <?php
    if(isset($_POST['donar'])){
        $cantidad = $_POST['cantidad'];
        echo "¡Gracias por tu donación de $".$cantidad."!";
    }
    ?>
    
    <form method="post">
        <label for="cantidad">Cantidad a donar:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <button type="submit" name="donar">Donar</button>
    </form>
</body>
</html>