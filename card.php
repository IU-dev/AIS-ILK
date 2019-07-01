<?php

require_once 'includes/global.inc.php';
$page = "card.php";
require_once 'includes/header.inc.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

$display = 0;

if (isset($_GET['submit'])) {
    $display = 1;
    $typ = $_GET['idtype'];
    if ($typ == "local") $spart = $db->select('students', "id = '" . $_GET['stid'] . "'");
    else if ($typ == "eis") $spart = $db->select('students', "eis = '" . $_GET['stid'] . "'");
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
    <title>Карта участника | <?php echo $pname; ?></title>
</head>
<body>
<center><br>
    <?php if ($display == 0) : ?>
        <form class="md-form border border-light p-5" action="card.php" method="get">
            <select class="browser-default custom-select mb-4" id="select" name="idtype">
                <option value="local">Внутренний ID</option>
                <option value="eis">ЕИС ID</option>
            </select>
            <input type="text" class="form-control mb-4" placeholder="ID" name="stid">
            <button class="btn btn-info btn-block" type="submit" name="submit">Выбрать</button>
        </form>
    <?php else : ?>
    <h3>Личная карта</h3>
    <h1><?php
        echo $spart['fio'];
        ?>
    </h1>
    <h4>Состоит в группе <?php
        $group = $db->select('groups', "id = '" . $spart['group_id'] . "'");
        echo $group['groupname'];
        ?></h4>
    <br><br>
    <h3>Текущий рейтинг: 0,00</h3><br><br>
    <h4>Сведения о мониторинговых работах:</h4>
    <table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">MJB</th>
            <th scope="col">Наименование</th>
            <th scope="col">Процент</th>
            <th scope="col">Оценка</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <?php
        $jobs = $db->select_fs('jobs_info', "belongs = '".$spart['id']."'");
        echo '<tbody>';
        $i = 1;
        foreach($jobs as $job){
            $mjb = $db->select('jobs_global', "id = '".$job['global_job_id']."'");
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td><span class="badge badge-primary">MJB-'.$mjb['id'].'</span></td>';
            echo '<td>'.$mjb['jobname'].'</td>';
            echo '<td>'.$job['percent'].'</td>';
            echo '<td>'.$job['mark'].'</td>';
            echo '<td><a class="badge badge-info" href="job.php?id='.$job['id'].'">посмотреть работу</a></td>';
            $i = $i + 1;
        }
        echo '</tbody></table>';
        ?>
</center>
<?php endif ?>
<?php require_once 'includes/footer.inc.php'; ?>
<script>
    $(document).ready(function () {
        $('#participants').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

</script>
</body>
</html>