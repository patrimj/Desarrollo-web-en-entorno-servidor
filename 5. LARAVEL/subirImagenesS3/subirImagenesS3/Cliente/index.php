<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="http://127.0.0.1:8000/api/subir" method="post" enctype="multipart/form-data"> 
    <!--    <form action="recuperar.php" method="post" enctype="multipart/form-data"> -->
        Añadir imagen: <input name="image" type="file" accept="image/*"/>
        <input type="submit" name="subir" value="Subir imagen"/>
    </form>
</body>
</html>