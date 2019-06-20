<?php

require_once 'includes/global.inc.php';
$page = "job.php";
require_once 'includes/header.inc.php';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

$display = 0;

if (isset($_GET['submit'])) {

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

    <?php require_once 'includes/footer.inc.php'; ?>
    <script>
        $(document).ready(function () {
            $('#participants').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>