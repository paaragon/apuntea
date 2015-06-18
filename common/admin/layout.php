<html>
    <head>
        <title>Apuntea - Tu red social de apuntes</title>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="../img/logo.png" />
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <link rel="stylesheet" href="../css/font-awesome-4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/componentes.css" />
        <link rel="stylesheet" type="text/css" href="../css/perfect-scrollbar.css" />
        <link rel="stylesheet" type="text/css" href="../css/usuario.css" />
        <script type="text/javascript" src="../js/jquery-2.1.1.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/perfect-scrollbar.jquery.min.js"></script>
        <script type="text/javascript" src="../js/perfect-scrollbar.min.js"></script>
        <script type="text/javascript" src="../js/Chart.js"></script>
        <script type="text/javascript" src="../js/cropper.js"></script>
        <?php
        if (isset($styles)) {
            foreach ($styles as $style) {
                echo $style;
            }
        }
        ?>
        <?php
        if (isset($scripts)) {
            foreach ($scripts as $script) {
                echo $script;
            }
        }
        ?>
    </head>
    <body>

        <header>
            <?php require "header.php"; ?>
        </header>
        <nav class="col-md-2" id="menu-user">
            <?php require "nav.php"; ?>
        </nav>

        <?php if (isset($_SESSION["exito"])) { ?>
            <div id="statusdiv" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION["exito"]." ";
                unset($_SESSION["exito"]);
                ?>
            </div>
<?php } else if (isset($_SESSION["error"])) { ?>
            <div id="statusdiv" class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION["error"]." ";
                unset($_SESSION["error"])
                ?>
            </div>
            <?php } ?>
        <main class="col-md-10" id="main">
<?php echo $contenido; ?>
        </main>
        <script>
            if ($(document).width() > 768) {
                $('#menu-user').perfectScrollbar();
                $('#main').perfectScrollbar();
            }

            $(window).on("resize", function () {
                if ($(document).width() > 768) {
                    $('#menu-user').perfectScrollbar();
                    $('#main').perfectScrollbar();
                } else {
                    $('#menu-user').perfectScrollbar('destroy');
                    $('#main').perfectScrollbar('destroy');
                }
            });
        </script>
    </body>
</html>

