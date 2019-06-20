<?php $user = unserialize($_SESSION['user']);
$display = false; ?>
<?php if ($_SESSION['grand']['creator_id'] == $user->id) $display = true;
else {
    $judges = unserialize($_SESSION['grand']['admins']);
}
foreach ($judges as $judge) {
    if ($judge == $user->id) $display = true;
}
?>
<nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color fixed-top">
    <a class="navbar-brand" href="#">Рейтинг 2.0</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
            aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo($page == "index.php" ? "active" : ""); ?>">
                <a class="nav-link" href="index.php">Главная
                </a>
            </li>
            <?php if (isset($_SESSION['grand'])) : ?>
                <li class="nav-item dropdown <?php echo($page == "p_total.php" || $page == "p_sorted.php" || $page == "p_add.php" || $page == "p_del.php" ? "active" : ""); ?>">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Участники
                    </a>
                    <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="p_sorted.php">По категориям</a>
                        <?php if ($display == true) : ?>
                            <a class="dropdown-item" href="p_total.php">Сводный</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="p_add.php">Добавить</a>
                            <a class="dropdown-item" href="p_del.php">Удалить</a>
                        <?php endif ?>
                    </div>
                </li>
                <li class="nav-item <?php echo($page == "judging.php" ? "active" : ""); ?>">
                    <a class="nav-link" href="judging.php">Судейство</a>
                </li>
                <?php if ($display == true) : ?>
                    <li class="nav-item dropdown <?php echo($page == "ae_section.php" || $page == "ae_criteria.php" || $page == "ae_judge.php" || $page == "ae_adm.php" ? "active" : ""); ?>">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">Администрирование
                        </a>
                        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                            <a class="dropdown-item" href="ae_section.php">Категории</a>
                            <a class="dropdown-item" href="ae_criteria.php">Критерии</a>
                            <a class="dropdown-item" href="ae_judge.php">Судьи</a>
                            <?php if ($_SESSION['grand']['creator_id'] == $user->id) : ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="ae_adm.php">Администраторы</a>
                            <?php endif ?>
                        </div>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <a class="btn btn-outline-light waves-effect btn-sm" href="events.php?leave=1"
                       role="button">Выйти</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="btn btn-outline-light waves-effect btn-sm" href="events.php" role="button">Выбрать
                        событие</a>
                </li>
            <?php endif ?>
            <?php if ($user->admin == 1) : ?>
            <li class="nav-item">
                <a class="btn btn-outline-light waves-effect btn-sm" href="a_create.php" role="button">Админка</a>
            </li>
            <?php endif ?>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <?php if (isset($user->username)) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <?php
                        echo $user->i . " " . $user->f;
                        ?>
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default"
                         aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="settings.php">Личный кабинет</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Выход</a>
                    </div>
                </li>
            <?php else : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Вход и регистрация
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default"
                         aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item " href="login.php">Вход</a>
                        <a class="dropdown-item" href="register.php">Регистрация</a>
                        <!--- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="recovery.php">Восстановление</a> --->
                    </div>
                </li>
            <?php endif ?>
        </ul>
    </div>
</nav>