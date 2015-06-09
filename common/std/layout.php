<html>
    <head>
        <title>Apuntea - Tu red social de apuntes</title>
        <meta charset="UTF-8">
        <link rel="icon" type="image/png" href="img/logo.png" />
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" href="font-awesome-4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/componentes.css" />
        <link rel="stylesheet" type="text/css" href="css/default.css" />
        <link rel="stylesheet" type="text/css" href="css/cropper.css" />
        <script type="text/javascript" src="js/jquery-2.1.1.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/cropper.js"></script>
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
        <?php if (isset($_SESSION["exito"])) { ?>
            <div id="statusdiv" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php
                echo $_SESSION["exito"]." ";
                unset($_SESSION["exito"]);
                ?>
            </div>
        <?php } else if (isset($_SESSION["error"])) { ?>
            <div id="statusdiv" class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php
                echo $_SESSION["error"]." ";
                unset($_SESSION["error"])
                ?>
            </div>
        <?php } ?>
        <div class="container">
            <div class="col-sm-9 wrapper">
                <main>
                    <?php echo $contenido; ?>
                </main>
                <div class="clear"></div>
                <footer>
                    <?php require "footer.php" ?>
                </footer>
            </div>
            <aside class="col-sm-3" id="sidebar">
                <?php require "sidebar.php"; ?>
            </aside>
            <div class="clearfix"></div>
        </div>
    </body>
</html>

