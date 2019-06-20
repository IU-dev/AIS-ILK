<?php

require_once 'includes/global.inc.php';
$page = "p_sorted.php";
require_once 'includes/header.inc.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

$display = 0;

if (isset($_POST['submit'])) {
    $display = 1;
    $cont = $db->select('groups', "id = '" . $_POST['section'] . "'");
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
    <title>Списки по категориям | <?php echo $pname; ?></title>
</head>
<body>
<center><br>
    <?php if ($display == 0) : ?>
        <form class="md-form border border-light p-5" action="p_sorted.php" method="post">
            <p class="h4 mb-4 text-center">Выберите группу обучающихся</p>
            <select class="browser-default custom-select mb-4" id="select" name="section">
                <?php
                $sections = $db->select_fs('groups', "id != '0'");
                foreach ($sections as $section) {
                    echo '<option value="' . $section['id'] . '">' . "(" . $section['id'] . ") " . $section['groupname'] . '</option>';
                }
                ?>
            </select>
            <button class="btn btn-info btn-block" type="submit" name="submit">Выбрать</button>
        </form>
    <?php else : ?>
    <h1><?php echo $_SESSION['grand']['name']; ?></h1>
    <h3>Список группы</h3>
    <br><br>
</center>
<div class="card card-cascade narrower">
    <div
            class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
        <div>
        </div>
        <a href="" class="white-text mx-3"><?php echo "(" . $cont['id'] . ") " . $cont['groupname']; ?></a>

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
            $parts = $db->select_fs('students', "group_id = '" . $cont['id'] . "'");
            foreach ($parts as $part) {
                echo '<tr>';
                echo '<td>' . $part['id'] . '</td>';
                echo '<td>' . $part['eis'] . '</td>';
                echo '<td>' . $part['fio'] . '</td>';
                echo '<td><a class="badge badge-primary" href="card.php?idtype=local&stid=' . $part['id'] . '"> посмотреть карту</a></td>';
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
    <?php endif ?>
</body>
</html>