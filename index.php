<?php
//index.php 
require_once 'includes/global.inc.php';
$page = "index.php";
require_once 'includes/header.inc.php';
?>
<html>
<head>
    <title>Главная | <?php echo $pname; ?></title>
</head>
<body>
<center>
    <br>
    <h1>Рейтинг 2.0</h1>
    <div class="alert alert-info" role="alert">
        <h3>Добро пожаловать!</h3>
        <em>Текущая версия системы: R1.4 (Beta)</em><br>
        <?php if (isset($_SESSION['grand'])) : ?>
            <h5>Сейчас Вы находитесь в мероприятии: <?php echo $_SESSION['grand']['name']; ?></h5>
        <?php endif ?>
    </div>
    <br><br>
    <h3>Новости системы:</h3>
    <?php
    $news = $db->select_desc_fs_news("news", "display = '1'");
    foreach ($news as $article) {
        echo '<div class="alert alert-' . $article['colortype'] . '" role="alert">';
        echo '<h4 class="alert-heading">' . $article['header'] . '</h4>';
        echo '<p>' . $article['text'] . '</p>';
        echo '<hr><p class="mb-0">' . $article['footer'] . '</p></div>';
    }
    ?>
</center>
</body>
<?php
if (isset($_SESSION['user'])) {
    $nots = $db->select_desc_fs('log', "userid = '" . $user->id . "' AND displayed = '0'");
    $k = count($nots);
    if ($k > 0) {
        echo '<script>';
        echo "toastr.info('У вас есть " . $k . " новых сообщений. Проверьте их в личном кабинете.', 'Уведомления', {timeOut: 5000});";
        echo '</script>';
    }

}
?>
</html>