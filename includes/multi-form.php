<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Upload de arquivos</title>
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
    <h1>Upload de arquivos</h1>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="sentFiles[]" id="file" multiple>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
