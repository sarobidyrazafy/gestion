<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>SAISIR LE NOMBRE de T-shirt</h1>
    <form action="<?php echo site_url('ResultController/getResultat') ?>" method="post">
        <p>Nombre de T-shirt: <input type="number" name="nombre" id=""></p>
		<p>Marge par T-Shirt: <input type="number" name="marge" id=""></p>
        <p><input type="submit" value="Envoyer"></p>
    </form>
</body>
</html>
