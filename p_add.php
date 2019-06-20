<?php

require_once 'includes/global.inc.php';
$page = "p_add.php";
require_once 'includes/header.inc.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

$display = 0;

if (isset($_POST['submit'])) {
    $data['eis'] = "'".$_POST['eis']."'";
    $data['group_id'] = "'".$_POST['group']."'";
    $data['fio'] = "'".$_POST['fio']."'";
    $data['description'] = "'".$_POST['comment']."'";
    $itog = $db->insert($data, 'students');
    $msg = "Регистрация произведена успешно. ID участника - ".$itog;
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
    <title>Добавить участника | <?php echo $pname; ?></title>
</head>
<body>
<center><br>
    <h1><?php echo $_SESSION['grand']['name']; ?></h1>
    <?php if(isset($msg)) echo "<h3>".$msg."</h3>"; ?>
    <form class="md-form border border-light p-5" action="p_add.php" method="post">
        <p class="h4 mb-4 text-center">Регистрация участника</p>
        <input type="text" id="textInput" name="fio" class="form-control mb-4" placeholder="ФИО">
        <input type="text" id="textInput" name="eis" class="form-control mb-4" placeholder="ID системы ЕИС">
        <select class="browser-default custom-select mb-4" id="select" name="group">
            <?php
            $sections = $db->select_fs('groups', "id != '0'");
            foreach ($sections as $section) {
                echo '<option value="' . $section['id'] . '">' . $section['id'] . " | " . $section['groupname'] . '</option>';
            }
            ?>
        </select>
        <input type="text" id="textInput2" name="comment" class="form-control mb-4" placeholder="Комментарий">
        <button class="btn btn-info btn-block" type="submit" name="submit">Зарегистрировать</button>
    </form>
</body>
</html>