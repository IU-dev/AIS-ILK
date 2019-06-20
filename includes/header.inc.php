<?php $user = unserialize($_SESSION['user']);
?>
<nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color fixed-top">
    <a class="navbar-brand" href="#"><?php echo $pname; ?></a>
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
            <?php if (isset($user->username)) : ?>
                <li class="nav-item dropdown <?php echo($page == "p_sorted.php" || $page == "p_add.php" || $page == "p_del.php" ? "active" : ""); ?>">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Участники
                    </a>
                    <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="p_sorted.php">Списки по группам</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="p_add.php">Добавить</a>
                            <a class="dropdown-item" href="p_del.php">Удалить</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php echo($page == "add_mr.php" || $page == "add_nr.php" || $page == "add_r.php" ? "active" : ""); ?>">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Внесение данных
                    </a>
                    <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="add_mr.php">Мониторинговая работа</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="add_nr.php">Мероприятие (NR)</a>
                        <a class="dropdown-item" href="add_r.php">Соревнование (R)</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php echo($page == "card.php" || $page == "card_potok.php" || $page == "close_course.php" ? "active" : ""); ?>">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Выверки
                    </a>
                    <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="card.php">Посмотреть карту</a>
                        <a class="dropdown-item" href="card_potok.php">Потоковый вывод карт</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="close_course.php">Завершение курса</a>
                    </div>
                </li>
            <?php if ($user->admin == 1) : ?>
            <li class="nav-item">
                <a class="btn btn-outline-light waves-effect btn-sm" href="admin.php" role="button">Админка</a>
            </li>
            <?php endif ?>
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