<?php

require_once 'includes/global.inc.php';
$page = "p_del.php";
require_once 'includes/header.inc.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

if (isset($_GET['delete'])) {
    $itog = $db->delete('participants', "id = '" . $_GET['delete'] . "'");
    $itag = $db->delete('points', "participant = '" . $_GET['delete'] . "'");
    $msg = "Операция удаления работы с ID " . $_GET['delete'] . " произведена.";
}
$user = unserialize($_SESSION['user']);

?>
<html>
<head>
    <title>Удаление участников | <?php echo $pname; ?></title>
</head>
<body>
<center><br>
    <h1><?php echo $_SESSION['grand']['name']; ?></h1>
    <h3>Панель удаления участников</h3>
    <strong>Будьте внимательны! Удаление участника невозможно отменить!</strong>
    <br><br><?php if (isset($msg)) echo $msg; ?><br><br>
</center>
<div class="card card-cascade narrower">
    <div
            class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
        </div>
        <a href="" class="white-text mx-3">Все участники</a>

        <div>
        </div>
    </div>
    <div class="px-4">
        <div class="table-wrapper">
            <?php
            echo '<table id="participants" class="table table-sm table-hover">' .
                '<thead>' .
                '<tr>' .
                '<th>ID</th>' .
                '<th>ЕИС</th>' .
                '<th>ФИО участника</th>' .
                '<th>Действие</th>' .
                '</tr>' .
                '</thead>';
            $parts = $db->select_fs('students', "id != '0'");
            foreach ($parts as $part) {
                echo '<tr>';
                echo '<td>' . $part['id'] . '</td>';
                echo '<td>' . $part['eis'] . '</td>';
                echo '<td>' . $part['fio'] . '</td>';
                echo '<td><a class="badge badge-danger" href="p_del.php?delete=' . $part['id'] . '">Удалить</a></td>';
            }
            echo '</table>';
            ?>
        </div>
    </div>
    <?php require_once 'includes/footer.inc.php'; ?>
    <script>
        $(document).ready(function () {
            $('#participants').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

    </script>
</body>
</html>