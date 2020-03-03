<?php
$file = 'win.txt';
$current = file_get_contents($file);
echo $current;
?>

<html lang="ru">
<head>
    <title>Победитель</title>
</head>
<body>
<form>
    <br>
    <img src="zoo-800x420.jpg" alt="Победитель">
    <br><br>
    <a href="index.php">Повторить игру</a>
</form>
</body>
</html>
