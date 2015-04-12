<html>
    <head>
        <title>Apuntea - Tu red social de apuntes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <link rel="stylesheet" href="../font-awesome-4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/usuario.css" />
        <link rel="stylesheet" type="text/css" href="../css/perfect-scrollbar.css" />
        <script src="../js/jquery-2.1.1.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/perfect-scrollbar.jquery.js"></script>
    </head>
    <body>

        <header>
            <?php require "header.php"; ?>
        </header>
        <nav class="col-md-2" id="menu-user">
            <?php require "nav.php"; ?>
        </nav>
        <main class="col-md-10" id="main">
            <?php echo $contenido; ?>
        </main>
        <footer>
            <?php require "footer.php" ?>
        </footer>
        <script>

            $(function () {
                $('#menu-user').perfectScrollbar();
                $('#main').perfectScrollbar();

                $(window).on("resize", function () {
                    if ($(window).width() > 780) {
                        $('#menu-user').perfectScrollbar();
                        $('#main').perfectScrollbar();
                    } else {
                        $('#menu-user').perfectScrollbar('destroy');
                        $('#main').perfectScrollbar('destroy');
                    }
                });
            });
        </script>
    </body>
</html>

