<?php


$thisURL = $_SERVER['REQUEST_URI'];
$thisURL = explode("?", $thisURL)[0];
$thisURL = explode("/", $thisURL);

$leftMenuList[] = [
    "titleName" => "menu1",
    "icons" => "",
    "defaultURL" => "/",
    "list" => []
];


$leftMenuList[] = [
    "titleName" => "sample",
    "icons" => "",
    "defaultURL" => "/sample",
    "list" => [
        [
            "locationURL" => "/chart",
            "titleName" => "차트샘플",
        ],
    ]
];

$leftMenuList[] = [
    "titleName" => "logout",
    "icons" => "",
    "defaultURL" => "/login/logout",
    "list" => []
];




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{APP_TITLE}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/demo/dist/assets/css/bootstrap.css">

    <link rel="stylesheet" href="/demo/dist/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="/demo/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/demo/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/demo/dist/assets/css/app.css">
    <link rel="shortcut icon" href="/demo/dist/assets/images/favicon.svg" type="image/x-icon">

    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
<!--    <script src="/public/jquery/jquery-3.6.0.slim.min.js"></script>-->

    <!-- 공통 JS 파일 -->
    <script src="/demo/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/demo/dist/assets/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="index.html"><img src="/demo/dist/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    <?php
                    foreach ($leftMenuList as $item) {

                        $urlExplode = explode("/", $item['defaultURL']);

                        $active = false; // 메뉴 active 설정
                        $subMenuActive = false; // 하위 메뉴 active 설정 - 설정안함

                        foreach ($urlExplode as $key => $value) {

                            if( isset($thisURL[$key]) ){
                                if ( $value !== $thisURL[$key]) {
                                    $active = false;
                                    continue;
                                } else {
                                    $active = true;
                                }
                            }
                        }

                        $subMenuList = $item['list'] ?? [] ;
                        $addMenuClass = !empty($subMenuList) ? " has-sub" : "";
                        ?>
                        <li class="sidebar-item <?= $addMenuClass ?> <?= $active ? 'active' : '' ?>">
                            <a href="<?= $item['defaultURL'] ?>" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span><?= $item['titleName'] ?></span>
                            </a>
                            <?php
                            if (!empty($subMenuList)) {
                                ?>
                                <ul class="submenu <?= $active ? 'active' : '' ?>">
                                    <?php
                                    foreach ($subMenuList as $subMenu) {
                                        ?>
                                        <li class="submenu-item ">
                                            <a href="<?= $item['defaultURL'] . $subMenu['locationURL'] ?>"><?= $subMenu['titleName'] ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-content">
            {yield}
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>
</div>

</body>

</html>
