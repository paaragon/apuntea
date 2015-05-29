<?php 
/* GRAFICA
 * Usuarios+/dia
 */
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->usuarios();

ob_start(); ?>
<div class="col-9">
    <h2>
        <span class="fa fa-users"></span> Administración de usuarios
    </h2>
    <hr>
    <form action="usuarios.php" method="post">
        <input id="buscar" type="text" class="campo-formulario" placeholder="Buscar Contacto...">
        
    
    <?php
    
            foreach ($variables["usuarios"] as $usuario):
                ?>
                <div class="col-6 contacto" >
                    
                   <div class="fila">
                       <div class="col-5"><p><img src="../img/usuarios/perfil/<?php echo $usuario->avatar ?>" class="img-responsive"/></p></div>
                       <div class="col-7">
                           <p>
                               <strong class="nombre"><?php echo $usuario->nombre . " " . $usuario->apellidos ?></strong> 
                               <small><a href="usuarios-detalles.php?id=<?php echo $usuario->id ?>" class="color-green nick">@<?php echo $usuario->nick ?></a></small>
                           </p>
                           <blockquote>
                               <p>
                                   <?php echo $usuario->estado ?>
                               </p>
                           </blockquote>
                           <p>
                               <span class="distintivo"><?php echo count($usuario->alias('alice')->ownContactoList) + count($usuario->alias('bob')->ownContactoList) ?> </span> Amigos<br><br>
                               <a href="mensajes.php" class="boton">Enviar mensaje</a>
                           </p>
                       </div>
                       <div class="clear"></div>
                   </div>
               </div>
                <?php
            endforeach;
            ?>
    </form>
</div>
<div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
</div>

<script>

    $(document).on("ready", function () {

        $("#buscar").on("keyup", function () {

            consulta = $(this).val();

            $(".contacto").each(function () {

                var nombre = $(this).find(".nombre").text();
                var nick = $(this).find(".nick").text();
                if (quitaAcentos(nombre.toLowerCase()).indexOf(quitaAcentos(consulta.toLowerCase())) !== -1 || quitaAcentos(nick.toLowerCase()).indexOf(quitaAcentos(consulta.toLowerCase())) !== -1){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            });
        });
    });

    function quitaAcentos(str) {
        for (var i = 0; i < str.length; i++) {
            if (str.charAt(i) == "á")
                str = str.replace(/á/, "a");
            if (str.charAt(i) == "é")
                str = str.replace(/é/, "e");
            if (str.charAt(i) == "í")
                str = str.replace(/í/, "i");
            if (str.charAt(i) == "ó")
                str = str.replace(/ó/, "o");
            if (str.charAt(i) == "ú")
                str = str.replace(/ú/, "u");
        }
        return str;
    }
</script>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
