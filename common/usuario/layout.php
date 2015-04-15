<html>
    <head>
        <title>Apuntea - Tu red social de apuntes</title>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="../img/logo.png" />
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <link rel="stylesheet" href="../font-awesome-4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/componentes.css" />
        <link rel="stylesheet" type="text/css" href="../css/usuario.css" />
        <link rel="stylesheet" type="text/css" href="../css/perfect-scrollbar.css" />
        <script src="../js/jquery-2.1.1.js"></script>
        <script src="../js/bootstrap.js"></script>
    </head>
    <body>

        <header>
            <?php require "header.php"; ?>
        </header>
        <nav class="col-2" id="menu-user">
            <?php require "nav.php"; ?>
        </nav>
        <main class="col-7" id="main">
            <?php echo $contenido; ?>
        </main>
        <aside class="col-3">
            <?php require "chat.php"; ?>
        </aside>
        <div class="clear"></div>
        <footer>
            <?php require "footer.php" ?>
        </footer>
    </body>
</html>

