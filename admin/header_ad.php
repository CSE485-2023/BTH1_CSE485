<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>








<!--  use $_SERVER['PHP_SELF'] variable to check file name  -->
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
        <div class="container-fluid">
            <div class="h3">
                <a class="navbar-brand" href="http://localhost:63342/btth01/admin/">Administration</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item <?php echo (strpos($_SERVER['PHP_SELF'], 'index.php') !== false) ? 'active fw-bold' : ''; ?>">
                        <a class="nav-link" aria-current="page" href="http://localhost:63342/btth01/admin/">Trang chủ</a>
                    </li>
                    <li class="nav-item <?php echo (strpos($_SERVER['PHP_SELF'], 'category.php') !== false && strpos($_SERVER['PHP_SELF'], 'category.php') !== false) ? 'active fw-bold' : ''; ?>">
                        <a class="nav-link" href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item <?php echo (strpos($_SERVER['PHP_SELF'], 'author.php') !== false) ? 'active fw-bold' : ''; ?>">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item <?php echo (strpos($_SERVER['PHP_SELF'], 'article.php') !== false) ? 'active fw-bold' : ''; ?>">
                        <a class="nav-link" href="article.php">Bài viết</a>
                    </li>
                    <li class="nav-item <?php echo (strpos($_SERVER['PHP_SELF'], 'UserController.php') !== false && $_GET['action'] === 'list_user') ? 'active fw-bold' : ''; ?>">
                        <a class="nav-link" href="/btth01/admin/controllers/UserController.php?action=list_user">Người dùng</a>
                    </li>
<!--                    <li class="nav-item dropdown">-->
<!--                            <span class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--                                Hello, --><?php //= $_SESSION['userActive']['full_name'] ?>
<!--                            </span>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li><a class="dropdown-item" href="#">Action</a></li>-->
<!--                            <li><a class="dropdown-item" href="#">Another action</a></li>-->
<!--                            <li><hr class="dropdown-divider"></li>-->
<!--                            <li><a class="dropdown-item" href="../handle_logout.php">Logout</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                </ul>
            </div>
        </div>
    </nav>
</header>