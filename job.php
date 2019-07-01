<?php

require_once 'includes/global.inc.php';
$page = "job.php";
require_once 'includes/header.inc.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

$display = 0;

if (isset($_GET['id'])) {
    $job = $db->select('jobs_info', "id = '" . $_GET['id'] . "'");
    $stud = $db->select('students', "id = '" . $job['belongs'] . "'");
    $usvr = $userTools->get($job['loaded_by_id']);
    $checker = $userTools->get($job['human_id']);
    $mjb = $db->select('jobs_global', "id = '".$job['global_job_id']."'");
} else {
    die('Hacking attempt.');
}

$user = unserialize($_SESSION['user']);

?>
<html>
<head>
    <title>Результат мониторинговой работы | <?php echo $pname; ?></title>
</head>
<body>
<center><br>
    <h2>Результат мониторинговой работы</h2>
    <h2><span class="badge badge-primary">MJB-<?php echo $job['id']; ?></span></h2><br>
    <h4><em>Параметры работы</em></h4>
    <table id="participantss" class="table table-sm">
        <thead>
        <tr>
            <th class="fixed-5em">Параметр</th>
            <th>Значение</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th><strong>ФИО участника</strong></th>
            <th><strong><?php echo $stud['fio'] . ' </strong><span class="badge badge-primary">ЕИС-' . $stud['eis'] . '</span>'; ?></th>
        </tr>
        <tr>
            <th>Наименование</th>
            <th><?php echo $mjb['jobname'] . ' <span class="badge badge-primary">MJG-'.$mjb['id'].'</span>'; ?></th>
        </tr>
        <tr>
            <th>Описание работы</th>
            <th><?php echo $mjb['description']; ?></th>
        </tr>
        <tr>
            <th>Дата проведения работы</th>
            <th><?php echo $job['date']; ?></th>
        </tr>
        <tr>
            <th>Добавлена в ИС</th>
            <th><?php echo $job['input_datetime'] . ' <em>(' . $usvr->f . ' ' . $usvr->i . ' ' . $usvr->o . '</em> <span class="badge badge-primary">USR-' . $usvr->id . '</span><em> )</em>'; ?></th>
        </tr>
        </tbody>
    </table>
    <br>
    <h4><em>Итоговые результаты работы</em></h4>
    <table id="participantsss" class="table table-sm itogs">
        <thead>
        <tr>
            <th>Процент выполнения</th>
            <th>Оценка</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th><?php echo $job['percent'] . '%'; ?></th>
            <th><?php echo $job['mark']; ?></th>
        </tr>
        </tbody>
    </table>
    <br>
    <h4><em>Пояснения к результатам</em></h4>
    <table id="participantssss" class="table table-sm">
        <thead>
        <tr>
            <th>Текст проверяющей машины</th>
            <th>Рецензия проверяющего</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th class="machine_text"><?php echo $job['machine_text']; ?></th>
            <th><?php echo $job['human_text'] . '<br><em>(проверяющий ' . $usvr->f . ' ' . $usvr->i . ' ' . $usvr->o . '</em> <span class="badge badge-primary">USR-' . $usvr->id . '</span><em> )</em>'; ?></th>
        </tr>
        </tbody>
    </table>
    <?php require_once 'includes/footer.inc.php'; ?>
    <script>
        $(document).ready(function () {
            $('#participants').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</center>
</body>
</html>