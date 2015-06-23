<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <p class="logo col-1">
                <a href="index.php"><img src="img/logo-inv.png"></a>
            </p>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/' || $_SERVER["REQUEST_URI"] == '/apuntea/index.php' || $_SERVER["REQUEST_URI"] == '/' || $_SERVER["REQUEST_URI"] == '/index.php'): ?>
                    <li><a href="index.php" class="activo">Inicio</a></li>
                <?php else: ?>
                    <li><a href="index.php">Inicio</a></li>
                <?php endif; ?>
                <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/universidades.php' || $_SERVER["REQUEST_URI"] == '/universidades.php'): ?>
                    <li><a href="universidades.php" class="activo">Universidades</a></li>
                <?php else: ?>
                    <li><a href="universidades.php">Universidades</a></li>
                <?php endif; ?>
                <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/carreras.php' || $_SERVER["REQUEST_URI"] == '/carreras.php'): ?>
                    <li><a href="carreras.php" class="activo">Carreras</a></li>
                <?php else: ?>
                    <li><a href="carreras.php">Carreras</a></li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>