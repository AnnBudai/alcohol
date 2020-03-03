<?php
session_start();
header('Content-type: text/html; charset=utf-8;');
if (!isset($_SESSION['client'])) {
    $_SESSION['client'] = 10;
    $_SESSION['server'] = 10;
}

if (isset($_POST['num'])) {
    $_POST['hit'] = rand(1, 4);
    $_POST['rand'] = rand(1, 3);
    if ($_POST['num'] == $_POST['rand']) {
        $_SESSION['server'] = $_SESSION['server'] - $_POST['hit'];
        $_POST['flag'] = 1; //client
    } else {
        $_SESSION['client'] = $_SESSION['client'] - $_POST['hit'];
        $_POST['flag'] = 0; //server
    }
}

if ($_SESSION['client'] <= 0) {
    $file = 'win.txt';
    $current .= "Победил сервер";
    file_put_contents($file, $current);
    header("Location: win.php");
    session_destroy();
    exit();
} elseif ($_SESSION['server'] <= 0) {
    $file = 'win.txt';
    $current .= "Победил клиент";
    file_put_contents($file, $current);
    header("Location: win.php");
    session_destroy();
    exit();
}
?>

    <html lang="ru">
    <head>
        <title>Битва алкоголиков</title>
    </head>
    <style>
        .raz {
            all: unset;
            -moz-appearance: textfield;
            width: 3em;
            text-align: center;
        }

        .raz::-webkit-inner-spin-button {
            display: none;
        }
    </style>
    <body>
    <div>
        <div><b>Клиент: </b></div>
        <?php echo 'осталось ' . $_SESSION['client'] . ' жизни'; ?>
        <div><b>Сервер: </b></div>
        <?php echo 'осталось ' . $_SESSION['server'] . ' жизни'; ?>
    </div>
    <div>
        <br>
        <form action="index.php?page=game1" method="post">
            <button type="button" onclick="this.nextElementSibling.stepDown()">-</button>
            <input type="number" name="num" min="1" max="3" value="1" readonly class="raz">
            <button type="button" onclick="this.previousElementSibling.stepUp()">+</button>
            <input type="submit" value="Ударить" name="submit">
            <br><br>
        </form>
    </div>
    </body>
    </html>

<?php
if (isset($_POST['num']) != 0) {
    echo 'Вы выбрали число ' . $_POST['num'] . '<br />';
    echo 'Сгенерировалось число ' . $_POST['rand'] . '<br />';
}
if (isset($_POST['flag']))
    if ($_POST['flag'] == 0)
        echo 'Ударил сервер на ' . $_POST['hit'];
    else
        echo 'Ударил клиент на ' . $_POST['hit'];
?>