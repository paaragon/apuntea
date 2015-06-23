<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";
require __DIR__ . "/../util/Validate.php";

class ServiciosUsuario {

    public function __construct() {
        apunteaSec\checkUsuario();
    }

    public function borrarapunte() {

        $this->setUpDatabase();

        $fields = array("id" => array($_POST, "entero", "required" => true));
        $validate = new Validate($fields);

        if (!$validate->validate()) {
            return json_encode(false);
        }

        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $apunte = R::findOne('apunte', "id = ? AND usuario_id = ?", [$id, $idUsuario]);

        Cascade::borrarApunteCascade($apunte->id);

        R::close();

        return json_encode(true);
    }

    public function editando() {

        $idApunte = filter_input(INPUT_POST, "idApunte", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $apunte = R::findOne("apunte", ' id = ? '
                        . 'AND ('
                        . 'usuario_id = ? '
                        . 'OR id IN ('
                        . 'SELECT apunte_id '
                        . 'FROM usuariointeractuaapunte '
                        . 'WHERE usuario_id = ? '
                        . 'AND permiso > 1)'
                        . ') '
                        . 'AND ('
                        . 'TIMESTAMPDIFF(SECOND, ultimaedicion, NOW()) >= 15 '
                        . 'OR TIMESTAMPDIFF(SECOND, ultimaedicion, NOW()) < 15 AND ultimoeditor = ?'
                        . ')', [$idApunte, $idUsuario, $idUsuario, $idUsuario]);
        print_r($apunte);
        $apunte->ultimaedicion = date("Y-m-d H:i:s", time());
        $apunte->ultimoeditor = $idUsuario;

        try {
            R::store($apunte);
            return json_encode(true);
        } catch (Exceptio $e) {
            return json_encode(false);
        }

        R::close();
    }

    public function darDeBaja() {

        $fields = array(
            "idUsuario" => array($_SESSION, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/mi-configuracion.php";
        }

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $usuario = R::load('usuario', $idUsuario);
        unlink(__DIR__ . '/../img/usuarios/perfil/' . $usuario->avatar);
        unlink(__DIR__ . '/../img/usuarios/portada/' . $usuario->imagenportada);
        unlink(__DIR__ . '/../img/dst/usuarios/perfil/' . $usuario->avatar);
        unlink(__DIR__ . '/../img/dst/usuarios/portada/' . $usuario->imagenportada);
        Cascade::borrarUsuarioCascade($idUsuario);
        R::close();
        $_SESSION["error"] = "Te has dado de baja en apuntea. Esperamos verte pronto";
        return "index.php";
    }

    public function pedirPermisoApunte() {

        $idApunte = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $apunte = R::load('apunte', $idApunte);

        if ($apunte != null && R::count('peticionapunte', 'apunte_id = ? AND usuario_id = ?', [$idApunte, $idUsuario]) == 0) {
            $peticion = R::dispense('peticionapunte');
            $peticion->apunte_id = $idApunte;
            $peticion->usuario_id = $idUsuario;

            R::store($peticion);

            $_SESSION["exito"] = "Petición realizada con éxito.";
            return "usuario/inicio.php";
        } else {
            $_SESSION["error"] = "Usted ya ha pedido permiso para ver este apunte";
            return "usuario/inicio.php";
        }
    }

    public function aceptarPeticionApunte() {
        $idPeticion = filter_input(INPUT_GET, "idPeticion", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $fields = array(
            "idPeticion" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/inicio.php";
        }

        $this->setUpDatabase();

        $peticion = R::findOne('peticionapunte', 'id = ? AND apunte_id IN (SELECT id FROM apunte WHERE usuario_id = ?)', [$idPeticion, $idUsuario]);

        if ($peticion == null) {

            $_SESSION["error"] = "Error al aceptar la peticion.";
            return "usuario/inicio.php";
        }

        $peticion->admitido = 1;
        R::store($peticion);
        $interaccion = R::findOne('usuariointeractuaapunte', 'usuario_id = ? AND apunte_id = ?', [$peticion->usuario_id, $peticion->apunte_id]);
        if ($interaccion == null) {
            $interaccion = R::dispense('usuariointeractuaapunte');
            $interaccion->usuario_id = $peticion->usuario_id;
            $interaccion->apunte_id = $peticion->apunte_id;
        }
        $interaccion->permiso = 1;
        R::store($interaccion);
        R::close();
        $_SESSION["exito"] = "Petición aceptada con éxito.";
        return "usuario/inicio.php";
    }

    public function borrarPeticionApunte() {
        $idPeticion = filter_input(INPUT_GET, "idPeticion", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $fields = array(
            "idPeticion" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/editar-apunte.php?id=" . filter_input(INPUT_POST, "apunte", FILTER_SANITIZE_NUMBER_INT);
        }
        $this->setUpDatabase();
        $peticion = R::findOne('peticionapunte', 'id = ? AND apunte_id IN (SELECT id FROM apunte WHERE usuario_id = ?)', [$idPeticion, $idUsuario]);

        if ($peticion == null) {

            $_SESSION["error"] = "Error al cancelar la peticion.";
            return "usuario/inicio.php";
        }

        R::trash($peticion);
        R::close();
        $_SESSION["exito"] = "Petición cancelada con éxito.";
        return "usuario/inicio.php";
    }

    public function getUsuariosConectados() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $usuario = R::findOne('usuario', ' id = ' . $idUsuario);
        $usuario->ultimaconexion = date("Y-m-d H:i:s");
        R::store($usuario);

        $usuariosConectados = R::findAll('usuario', ' TIMESTAMPDIFF(SECOND, NOW(), ultimaconexion) >= -30 AND (id IN (SELECT alice_id FROM contacto WHERE bob_id = ' . $idUsuario . ' AND admitido = 1) OR id IN (SELECT bob_id FROM contacto WHERE alice_id = ' . $idUsuario . ' AND admitido = 1))');

        $infoConectados = array();

        foreach ($usuariosConectados as $usu) {

            $sinleer = R::count('mensaje', ' emisor_id = ' . $usu->id . ' AND receptor_id = ' . $idUsuario . ' AND visto = 0');

            $infoConectados[] = array("usuario" => array("nombre" => $usu->nombre, "apellidos" => $usu->apellidos, "id" => $usu->id, "avatar" => $usu->avatar), "sin-leer" => $sinleer);
        }
        R::close();

        echo json_encode($infoConectados);
    }

    public function guardarApunte() {

        $fields = array(
            "apunte" => array($_POST, "entero", true),
            "contenido" => array($_POST, "texto", false),
            "visualizacion" => array($_POST, "entero", true),
            "modificacion" => array($_POST, "entero", true),
            "edicion-permisos" => array($_POST, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/editar-apunte.php?id=" . filter_input(INPUT_POST, "apunte", FILTER_SANITIZE_NUMBER_INT);
        }

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $idApunte = filter_input(INPUT_POST, "apunte", FILTER_SANITIZE_NUMBER_INT);
        $contenido = filter_input(INPUT_POST, "contenido", FILTER_SANITIZE_MAGIC_QUOTES);
        $permiso1 = filter_input(INPUT_POST, "visualizacion", FILTER_SANITIZE_NUMBER_INT);
        $permiso2 = filter_input(INPUT_POST, "modificacion", FILTER_SANITIZE_NUMBER_INT);
        $permiso3 = filter_input(INPUT_POST, "edicion-permisos", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $apunte = R::findOne("apunte", ' id = ? AND (usuario_id = ? OR id IN (SELECT apunte_id FROM usuariointeractuaapunte WHERE usuario_id = ?))', [$idApunte, $idUsuario, $idUsuario]);

        $apunte->contenido = $contenido;
        $apunte->permisovisualizacion = $permiso1;
        $apunte->permisoedicion = $permiso2;
        $apunte->permisoedicionpermiso = $permiso3;

        $interaccion = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $idApunte]);
        if (isset($interaccion) && ($interaccion->permiso == 3 || $apunte->usuario_id == $idUsuario)) {
//Elimino los permisos anteriores
            $visualizaciones = R::findAll('usuariointeractuaapunte', 'apunte_id = ? AND permiso = 1', [$idApunte]);
            foreach ($visualizaciones as $visualizacion) {
                $visualizacion->permiso = 0;
                R::store($visualizacion);
            }
            $modificaciones = R::findAll('usuariointeractuaapunte', 'apunte_id = ? AND permiso = 2', [$idApunte]);
            foreach ($modificaciones as $modificacion) {
                $modificacion->permiso = 0;
                R::store($modificacion);
            }

            $edicionespermisos = R::findAll('usuariointeractuaapunte', 'apunte_id = ? AND permiso = 3', [$idApunte]);
            foreach ($edicionespermisos as $edicionpermisos) {
                $edicionpermisos->permiso = 0;
                R::store($edicionpermisos);
            }

//Doy los nuevos permisos
            if ($permiso1 != 0 && $permiso1 != 2) {
                $lectores = $_POST["lector"];
                foreach ($lectores as $l) {
                    $idLector = filter_var($l, FILTER_SANITIZE_NUMBER_INT);

                    if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idLector, $idApunte]) > 0) {
                        $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idLector, $idApunte]);
                    } else {
                        $interaccion = R::dispense("usuariointeractuaapunte");
                        $interaccion->apunte_id = $idApunte;
                        $interaccion->usuario_id = $idLector;
                    }

                    $interaccion->permiso = 1;
                    R::store($interaccion);
                }
            }

            if ($permiso2 != 0) {
                $modificadores = $_POST["modificador"];
                foreach ($modificadores as $m) {
                    $idModificador = filter_var($m, FILTER_SANITIZE_NUMBER_INT);

                    if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idModificador, $idApunte]) > 0) {
                        $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idModificador, $idApunte]);
                    } else {
                        $interaccion = R::dispense("usuariointeractuaapunte");
                        $interaccion->apunte_id = $idApunte;
                        $interaccion->usuario_id = $idModificador;
                    }

                    $interaccion->permiso = 2;
                    R::store($interaccion);
                }
            }

            if ($permiso3 != 0) {
                $permisores = $_POST["permisor"]; // Sí, se llama permisor, no es una errata. El que da un permiso... ¿no?
                foreach ($permisores as $p) {
                    $idPermisor = filter_var($p, FILTER_SANITIZE_NUMBER_INT);

                    if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idPermisor, $idApunte]) > 0) {
                        $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idPermisor, $idApunte]);
                    } else {
                        $interaccion = R::dispense("usuariointeractuaapunte");
                        $interaccion->apunte_id = $idApunte;
                        $interaccion->usuario_id = $idPermisor;
                    }

                    $interaccion->permiso = 3;
                    R::store($interaccion);
                }
            }
        }

        R::store($apunte);
        R::close();

        $_SESSION["exito"] = "Apunte guardado con éxito";
        return "usuario/editar-apunte.php?id=" . $idApunte;
    }

    public function anadirComentarioGrupo() {

        $admin = (isset($_POST["isAdmin"])) ? "-admin" : "";
        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);

        $fields = array(
            "idUsuario" => array($_SESSION, "entero", true),
            "comentario" => array($_POST, "texto", true));

        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-grupo" . $admin . ".php?id=" . $idGrupo;
        }

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();

        $fecha = date("Y-m-d h:i:s", time());
        $texto = filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_MAGIC_QUOTES);

        $comentario = R::dispense('comentariogrupo');

        $comentario->fecha = $fecha;
        $comentario->usuario_id = $idUsuario;
        $comentario->grupo_id = $idGrupo;
        $comentario->texto = $texto;
        R::store($comentario);
        $_SESSION["exito"] = "Comentario publicado";
        $return = "usuario/ver-grupo" . $admin . ".php?id=" . $idGrupo;

        R::close();
        return $return;
    }

    public function editarGrupo() {

        $fields = array(
            "idGrupo" => array($_POST, "entero", true),
            "privacidad" => array($_POST, "texto", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-grupo-admin.php?id=" . filter_input(INPUT_POST, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        }

        $idGrupo = filter_input(INPUT_POST, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $privacidad = filter_input(INPUT_POST, "privacidad", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        try {
            $grupo = R::findOne("grupo", 'id=?', [$idGrupo]);
            $grupo->privacidad = $privacidad;
            $_SESSION["exito"] = "Privacidad cambiada con éxito";
            R::store($grupo);
        } catch (Exception $e) {
            $_SESSION["error"] = "Error modificando el grupo";
        }


        R::close();

        return "usuario/ver-grupo-admin.php?id=" . $idGrupo;
    }

    public function peticionGrupo() {

        $fields = array(
            "idGrupo" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/mis-grupos-sugeridos.php";
        }

        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $usuariogrupo = R::findOne('usuariogrupo', 'usuario_id = ? AND grupo_id = ?', [$idUsuario, $idGrupo]);

        if (!isset($usuariogrupo)) {
            $grupo = R::findOne("grupo", 'id=?', [$idGrupo]);

            if ($grupo->privacidad == 1) {
                $return = "usuario/permiso-grupo-pedido.php";
                $admitido = 0;
            } else if ($grupo->privacidad == 2) {
                $return = "usuario/ver-grupo.php?id=" . $idGrupo;
                $admitido = 1;
            }

            $usergrupo = R::dispense('usuariogrupo');

            $usergrupo->fecha = date("Y-m-d h:i:s", time());
            $usergrupo->usuario_id = $idUsuario;
            $usergrupo->grupo_id = $idGrupo;
            $usergrupo->admitido = $admitido;
            $usergrupo->isadmin = 0;

            try {
                R::store($usergrupo);
                $_SESSION["exito"] = "Peticion enviada";
            } catch (Exception $e) {
                $_SESSION["error"] = "Error al enviar la petición";
                $return = "usuario/mis-grupos-sugeridos.php";
            }
            R::close();
        } else {

            $_SESSION["error"] = "Ya has realizado una petición a para entrar a este grupo.";
            $return = "usuario/mis-grupos-sugeridos.php";
        }
        return $return;
    }

    public function anadirUsuarioGrupo() {

        $fields = array(
            "nick" => array($_POST, "texto", true),
            "idGrupo" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-grupo-admin.php?id=" . filter_input(INPUT_POST, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        }

        $nick = filter_input(INPUT_POST, "nick", FILTER_SANITIZE_MAGIC_QUOTES);
        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        try {
            $usuario = R::findOne('usuario', " nick=? ", [$nick]);
            $usergrupo = R::dispense('usuariogrupo');
            $usergrupo->grupo_id = $idGrupo;
            $usergrupo->usuario_id = $usuario->id;
            $usergrupo->isadmin = 0;
            $usergrupo->admitido = 1;
            R::store($usergrupo);
            $_SESSION["exito"] = "Usuario añadido";
            $return = "usuario/ver-grupo-admin.php?id=" . $idGrupo;
        } catch (Exception $e) {
            $_SESSION["error"] = "No es posible añadir este usuario al grupo";
            $return = "usuario/ver-grupo-admin.php?id=" . $idGrupo;
        }

        return $return;
    }

    public function anadirApunteGrupo() {

        $admin = isset($_GET["admin"]) ? "-admin" : "";

        $fields = array(
            "apunte" => array($_POST, "entero", true),
            "idGrupo" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-grupo" . $admin . ".php?id=" . filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        }

        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $idApunte = filter_input(INPUT_POST, "apunte", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        if (R::count('apuntegrupo', 'apunte_id = ? AND grupo_id = ?', [$idApunte, $idGrupo]) == 0) {
            $apunte = R::dispense('apuntegrupo');
            $apunte->apunte_id = $idApunte;
            $apunte->grupo_id = $idGrupo;
            R::store($apunte);
            $_SESSION["exito"] = "Apunte añadido al grupo.";
        } else {
            $_SESSION["error"] = "Apunte ya perteneciente al grupo.";
        }
        R::close();

        $return = "usuario/ver-grupo" . $admin . ".php?id=" . $idGrupo;

        return $return;
    }

    public function aceptarPeticionGrupo() {

        $fields = array(
            "idUsuario" => array($_GET, "entero", true),
            "idGrupo" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/peticiones-grupo.php?id=" . filter_input(INPUT_POST, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        }

        $this->setUpDatabase();
        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_input(INPUT_GET, "idUsuario", FILTER_SANITIZE_NUMBER_INT);

        try {
            $usuario = R::findOne('usuariogrupo', "grupo_id = " . $idGrupo . " AND usuario_id = " . $idUsuario);
            $usuario->admitido = 1;
            R::store($usuario);
            $_SESSION["exito"] = "Usuario admitido en el grupo";
            $return = "usuario/ver-grupo-admin.php?id=" . $idGrupo;
        } catch (Exception $ex) {
            $_SESSION["error"] = "Error al aceptar la petición";
            $return = "usuario/peticiones-grupo.php?id=" . $idGrupo;
        }

        return $return;
    }

    public function borrarUsuarioGrupo() {

        $fields = array(
            "idUsuario" => array($_GET, "entero", true),
            "idGrupo" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-grupo-admin.php?id=" . filter_input(INPUT_POST, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        }

        $this->setUpDatabase();
        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_input(INPUT_GET, "idUsuario", FILTER_SANITIZE_NUMBER_INT);
        try {
            $usuario = R::findOne('usuariogrupo', "grupo_id = " . $idGrupo . " AND usuario_id = " . $idUsuario);
            R::trash($usuario);
            $_SESSION["exito"] = $usuario->usuario->nombre . "  borrado con éxito";
            $return = "usuario/ver-grupo-admin.php?id=" . $idGrupo;
        } catch (Exception $ex) {
            $_SESSION["error"] = "Error al borrar el usuario elegido";
            $return = "usuario/ver-grupo-admin.php?id=" . $idGrupo;
        }
        R::close();
        return $return;
    }

    public function eliminarAdminGrupo() {

        $fields = array(
            "idUsuario" => array($_GET, "entero", true),
            "idGrupo" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-grupo-admin.php?id=" . filter_input(INPUT_POST, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        }

        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_input(INPUT_GET, "idUsuario", FILTER_SANITIZE_NUMBER_INT);

        $this->setupDatabase();
        $nAdmin = R::count('usuariogrupo', 'grupo_id = ? AND isadmin = 1', [$idGrupo]);

        if ($nAdmin == 1) {

            $_SESSION["error"] = "No puede eliminar al último administrador de este grupo.";
        } else {

            $usuariogrupo = R::findOne('usuariogrupo', 'grupo_id = ? AND usuario_id = ?', [$idGrupo, $idUsuario]);
            $usuariogrupo->isadmin = 0;
            R::store($usuariogrupo);
            $_SESSION["exito"] = "Administrador eliminado.";
        }
        R::close();
        return "usuario/ver-grupo-admin.php?id=" . $idGrupo;
    }

    public function eliminarApunteGrupo() {

        $isadmin = filter_input(INPUT_GET, "admin", FILTER_SANITIZE_NUMBER_INT);
        $admin = ($isadmin == 1) ? "-admin" : "";

        $fields = array(
            "idGrupo" => array($_POST, "entero", true),
            "idApunte" => array($_POST, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-grupo" . $admin . ".php?id=" . filter_input(INPUT_POST, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        }

        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $idApunte = filter_input(INPUT_GET, "idApunte", FILTER_SANITIZE_NUMBER_INT);

        $this->setupDatabase();

        $apuntegrupo = R::findOne('apuntegrupo', 'grupo_id = ? AND apunte_id = ?', [$idGrupo, $idApunte]);
        R::trash($apuntegrupo);
        $_SESSION["exito"] = "Apunte eliminado.";
        R::close();


        return "usuario/ver-grupo" . $admin . ".php?id=" . $idGrupo;
    }

    public function anadirAdminGrupo() {

        $fields = array(
            "idGrupo" => array($_GET, "entero", true),
            "idUsuario" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-grupo-admin.php?id=" . filter_input(INPUT_POST, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        }

        $this->setUpDatabase();
        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_input(INPUT_GET, "idUsuario", FILTER_SANITIZE_NUMBER_INT);

        try {
            $usuario = R::findOne('usuariogrupo', "grupo_id = " . $idGrupo . " AND usuario_id = " . $idUsuario);
            $usuario->isadmin = 1;
            R::store($usuario);
            $_SESSION["exito"] = $usuario->usuario->nombre . " es ahora administrador del grupo";
            $return = "usuario/ver-grupo-admin.php?id=" . $idGrupo;
        } catch (Exception $ex) {
            $_SESSION["error"] = "Error al añadir un administrador";
            $return = "usuario/ver-grupo-admin.php?id=" . $idGrupo;
        }
        R::close();
        return $return;
    }

    public function comentarApunte() {

        $fields = array(
            "comentario" => array($_POST, "texto", true),
            "idApunte" => array($_POST, "entero", true),
            "idUsuario" => array($_SESSION, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/ver-apunte.php?id=" . filter_input(INPUT_POST, "idApunte", FILTER_SANITIZE_NUMBER_INT);
        }

        $texto = filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_SPECIAL_CHARS);
        $idApunte = filter_input(INPUT_POST, "apunte", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $comentario = R::dispense('comentarioapunte');
        $comentario->apunte_id = $idApunte;
        $comentario->usuario_id = $idUsuario;
        $comentario->texto = $texto;
        $comentario->fecha = date("Y-m-d h:i:s", time());
        try {
            R::store($comentario);
            $_SESSION["exito"] = "Apunte comentado con éxito";
        } catch (Exception $e) {
            echo $e->getMessage();
            $_SESSION["error"] = $e->getMessage();
        }

        R::close();
        return "usuario/ver-apunte.php?id=" . $idApunte;
    }

    public function getMensajesDeUsuario() {

        $fields = array(
            "contacto" => array($_GET, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            echo json_encode(false);
        }

        $idContacto = filter_input(INPUT_GET, "contacto", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        if (!isset($_GET["nuevos"])) {

            $mensajes = R::findAll('mensaje', ' emisor_id = ' . $idContacto . ' AND receptor_id = ' . $idUsuario . ' OR emisor_id = ' . $idUsuario . ' AND receptor_id = ' . $idContacto . ' ORDER BY fecha');
        } else {

            $mensajes = R::findAll('mensaje', ' emisor_id = ' . $idContacto . ' AND receptor_id = ' . $idUsuario . ' AND visto = 0 ORDER BY fecha');
        }
        foreach ($mensajes as $mensaje) {

            if ($mensaje->visto == 0 && $mensaje->emisor_id == $idContacto) {
                $mensaje->visto = 1;
                R::store($mensaje);
            }
        }

        R::close();

        echo json_encode(R::exportAll($mensajes));
    }

    public function enviarMensaje() {

        $fields = array(
            "texto" => array($_POST, "texto", true),
            "idContacto" => array($_POST, "entero", true),
            "idUsuario" => array($_SESSION, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/mis-mensajes.php?id=" . filter_input(INPUT_GET, "redirect", FILTER_SANITIZE_NUMBER_INT);
        }

        $idContacto = filter_input(INPUT_POST, "idContacto", FILTER_SANITIZE_NUMBER_INT);
        $texto = filter_input(INPUT_POST, "texto", FILTER_SANITIZE_MAGIC_QUOTES);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $mensaje = R::dispense('mensaje');
        $mensaje->emisor_id = $idUsuario;
        $mensaje->receptor_id = $idContacto;
        $mensaje->texto = $texto;
        $mensaje->fecha = date("Y-m-d H:i:s", time());
        $mensaje->visto = 0;

        try {
            R::store($mensaje);

            if (!isset($_GET["redirect"])) {
                echo json_encode($mensaje->export());
            } else {
                return "usuario/mis-mensajes.php?id=" . filter_input(INPUT_GET, "redirect", FILTER_SANITIZE_NUMBER_INT);
            }
        } catch (Exception $e) {
            echo $e;
        }

        R::close();
    }

    public function aceptarPeticion() {

        $fields = array(
            "user" => array($_GET, "entero", true),
            "idUsuario" => array($_SESSION, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/peticiones.php";
        }

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $contacto = filter_input(INPUT_GET, "user", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $peticion = R::findOne("contacto", " bob_id = ? AND alice_id = ?", [$idUsuario, $contacto]);
        $peticion->admitido = 1;
        $peticion->fecha = date("Y-m-d h:i:s", time());
        R::store($peticion);
        R::close();

        $_SESSION["exito"] = "Petición aceptada";
        return "usuario/peticiones.php";
    }

    public function getCarreras() {
        $idUni = filter_input(INPUT_POST, "idUniversidad", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $carreras = R::findAll("carrera", " universidad_id = ? ORDER BY nombre", [$idUni]);
        R::close();

        $arrCar = array();
        foreach ($carreras as $car) {
            $arrCar[] = $car->export();
        }

        return json_encode($arrCar);
    }

    public function crearGrupo() {

        $fields = array(
            "nombre" => array($_POST, "texto", true),
            "privacidad" => array($_POST, "entero", true),
            "idUsuario" => array($_SESSION, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/peticiones.php";
        }

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $privacidad = filter_input(INPUT_POST, "privacidad", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $grupo = R::dispense('grupo');
        $grupo->nombre = $nombre;
        $grupo->privacidad = $privacidad;

        $idGrupo = R::store($grupo);

        $usuariogrupo = R::dispense('usuariogrupo');
        $usuariogrupo->usuario_id = $idUsuario;
        $usuariogrupo->admitido = 1;
        $usuariogrupo->isadmin = 1;
        $usuariogrupo->grupo_id = $idGrupo;
        R::store($usuariogrupo);
        R::close();
        $_SESSION["exito"] = "Grupo creado con éxito";
        return "usuario/ver-grupo-admin.php?id=" . $idGrupo;
    }

    public function getAsignaturas() {
        $idCar = filter_input(INPUT_POST, "idCarrera", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $asignaturas = R::findAll("asignatura", " carrera_id = ? ORDER BY nombre", [$idCar]);
        R::close();
        return json_encode(R::exportAll($asignaturas));
    }

    public function dislike() {
        $idApunte = filter_input(INPUT_POST, "idApunte", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $interaccion = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $idApunte]);

        if ($interaccion == null) {

            $interaccion = R::dispense('usuariointeractuaapunte');
            $interaccion->apunte_id = $idApunte;
            $interaccion->usuario_id = $idUsuario;
            $interaccion->like = -1;
            $interaccion->fechadislike = date("Y-m-d h:i:s", time());

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes++;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(array(true, $apunte->likes, $apunte->dislikes));
        } else if ($interaccion->like == 0) {

            $interaccion->like = -1;

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes--;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(array(true, $apunte->likes, $apunte->dislikes));
        } else if ($interaccion->like == 1) {

            $interaccion->like = -1;

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes--;
            $apunte->dislikes++;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(array(true, $apunte->likes, $apunte->dislikes));
        }

        return json_encode(false);
    }

    public function enviarSolicitud($params) {
        $alice = filter_var($params["alice"], FILTER_SANITIZE_NUMBER_INT);
        $bob = filter_var($params["bob"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        R::debug(true);
        if (R::findOne('contacto', 'alice_id = ? AND bob_id = ?', [$alice, $bob]) != null) {

            $_SESSION["error"] = "Ya ha enviado una solicitud de amistad a este usuario";
            return "usuario/inicio.php";
        }

        $peticion = R::dispense('contacto');
        $peticion->alice_id = $alice;
        $peticion->bob_id = $bob;
        $peticion->admitido = 0;

        R::store($peticion);

        $_SESSION["exito"] = "Petición realizada con éxito";
        return "usuario/inicio.php";
    }

    public function like() {
        $idApunte = filter_input(INPUT_POST, "idApunte", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $interaccion = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $idApunte]);

        if ($interaccion == null) {

            $interaccion = R::dispense('usuariointeractuaapunte');
            $interaccion->apunte_id = $idApunte;
            $interaccion->usuario_id = $idUsuario;
            $interaccion->like = 1;
            $interaccion->fechalike = date("Y-m-d h:i:s", time());

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes++;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(true);
        } else if ($interaccion->like == 0) {

            $interaccion->like = 1;

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes++;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(array(true, $apunte->likes, $apunte->dislikes));
        } else if ($interaccion->like == -1) {

            $interaccion->like = 1;

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes++;
            $apunte->dislikes--;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(array(true, $apunte->likes, $apunte->dislikes));
        }

        return json_encode(array(false));
    }

    public function fav() {
        $idApunte = filter_input(INPUT_POST, "idApunte", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $interaccion = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $idApunte]);

        if ($interaccion == null) {

            $interaccion = R::dispense('usuariointeractuaapunte');
            $interaccion->apunte_id = $idApunte;
            $interaccion->usuario_id = $idUsuario;
            $interaccion->favorito = 1;
            $interaccion->fechafavorito = date("Y-m-d h:i:s", time());

            R::store($interaccion);

            return json_encode(true);
        } else if ($interaccion->favorito == 0) {

            $interaccion->favorito = 1;

            R::store($interaccion);

            return json_encode(true);
        } else if ($interaccion->favorito == 1) {

            $interaccion->favorito = 0;

            R::store($interaccion);
            return json_encode(false);
        }

        return json_encode("");
    }

    private function checkUserPwd($pwd1, $pwd2, $pwd3, $currentPwd) {

        return password_verify(password_hash($pwd1, PASSWORD_DEFAULT), $currentPwd) && $pwd2 !==
                $pwd3;
    }

    public function guardarConfiguracionUsuario() {

        $fields = array(
            "nick" => array($_POST, "texto", true),
            "estado" => array($_POST, "entero", false),
            "mail" => array($_POST, "email", true),
            "carrera" => array($_POST, "entero", true),
            "pwd1" => array($_POST, "texto", false),
            "pwd2" => array($_POST, "texto", false),
            "pwd3" => array($_POST, "texto", false),
            "vis-perfil" => array($_POST, "entero", true),
            "vis-actividad" => array($_POST, "entero", true),
            "vis-buscador" => array($_POST, "entero", true),
            "apellidos" => array($_POST, "texto", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/mi-configuracion.php";
        }

        require __DIR__ . "/../util/CropAvatar.php";

        $nick = filter_input(INPUT_POST, "nick", FILTER_SANITIZE_SPECIAL_CHARS);
        $estado = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_SPECIAL_CHARS);
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_SPECIAL_CHARS);
        $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
        $carrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_NUMBER_INT);
        $pwd1 = filter_input(INPUT_POST, "pwd1", FILTER_SANITIZE_MAGIC_QUOTES);
        $pwd2 = filter_input(INPUT_POST, "pwd2", FILTER_SANITIZE_MAGIC_QUOTES);
        $pwd3 = filter_input(INPUT_POST, "pwd3", FILTER_SANITIZE_MAGIC_QUOTES);
        $privacidadperfil = filter_input(INPUT_POST, "vis-perfil", FILTER_SANITIZE_NUMBER_INT);
        $privacidadactividad = filter_input(INPUT_POST, "vis-actividad", FILTER_SANITIZE_NUMBER_INT);
        $privacidadbuscador = filter_input(INPUT_POST, "vis-buscador", FILTER_SANITIZE_NUMBER_INT);
        $imgPerfil = isset($_FILES["img-perfil"]) ? $_FILES["img-perfil"] : null;
        $perfilData = filter_input(INPUT_POST, "img-perfil-data", FILTER_SANITIZE_MAGIC_QUOTES);
        $perfilSrc = filter_input(INPUT_POST, "img-perfil-src", FILTER_SANITIZE_MAGIC_QUOTES);
        $imgPortada = isset($_FILES["img-portada"]) ? $_FILES["img-portada"] : null;
        $portadaData = filter_input(INPUT_POST, "img-portada-data", FILTER_SANITIZE_MAGIC_QUOTES);
        $portadaSrc = filter_input(INPUT_POST, "img-portada-src", FILTER_SANITIZE_MAGIC_QUOTES);

        if ($nick == "" ||
                $nombre == "" ||
                $apellidos == "" ||
                $mail == "" ||
                $carrera == "") {
            $_SESSION["error"] = "Formulario incompleto, campo vacío";
            return "usuario/mi-configuracion.php";
        }

        $idUser = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();

        $usuario = R:: findOne("usuario", " id = ? ", [$idUser]);
        $currentPwd = $usuario->password;

        if ($pwd1 != "") {
            if ($this->checkUserPwd($pwd1, $pwd2, $pwd3, $currentPwd)) {
                $usuario->password = password_hash($pwd2, PASSWORD_DEFAULT);
            } else {
                $_SESSION["error"] = "Las contraseñas no coinciden";
                return "usuario/mi-configuracion.php";
            }
        }

        $usuario->nick = $nick;
        $usuario->estado = $estado;
        $usuario->nombre = $nombre;
        $usuario->apellidos = $apellidos;
        $usuario->email = $mail;
        $usuario->carrera_id = $carrera;
        $usuario->privacidadperfil = $privacidadperfil;
        $usuario->privacidadactividad = $privacidadactividad;
        $usuario->privacidadbuscador = $privacidadbuscador;

        if ($imgPerfil["name"] != "") {
            $crop = new CropAvatar($perfilSrc, $perfilData, $imgPerfil, "usuarios/perfil");

            $namearr = explode("/", $crop->getResult());

            unlink(__DIR__ . "/../img/usuarios/perfil/" . $usuario->avatar);
            $usuario->avatar = $namearr[4];
        }

        if ($imgPortada["name"] != "") {
            $crop2 = new CropAvatar($portadaSrc, $portadaData, $imgPortada, "usuarios/portada");
            $response2 = array(
                'state' => 200,
                'message' => $crop2->getMsg(),
                'result' => $crop2->getResult()
            );

            $namearr2 = explode("/", $crop2->getResult());
            unlink(__DIR__ . "/../img/usuarios/portada/" . $usuario->imagenportada);
            $usuario->imagenportada = $namearr2[4];
        }

        R::store($usuario);

//END TRANSACTION
        R::close();

        $_SESSION["exito"] = "Configuración modificada correctamente";

        return

                "usuario/mi-configuracion.php";
    }

    public function subirApunte() {

        $fields = array(
            "titulo" => array($_POST, "texto", true),
            "asignatura" => array($_POST, "entero", true),
            "visualizacion" => array($_POST, "entero", true),
            "modificacion" => array($_POST, "entero", true),
            "edicion-permisos" => array($_POST, "entero", true));
        $validate = new Validate($fields);
        if (!$validate->validate()) {
            $_SESSION["error"] = $validate->getErrorMessage();
            return "usuario/mi-configuracion.php";
        }


        $idUser = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $titulo = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $asignatura = filter_input(INPUT_POST, "asignatura", FILTER_SANITIZE_NUMBER_INT);
        $permiso1 = filter_input(INPUT_POST, "visualizacion", FILTER_SANITIZE_NUMBER_INT);
        $permiso2 = filter_input(INPUT_POST, "modificacion", FILTER_SANITIZE_NUMBER_INT);
        $permiso3 = filter_input(INPUT_POST, "edicion-permisos", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $apunte = R::dispense("apunte");

        $apunte->titulo = $titulo;
        $apunte->usuario_id = $idUser;
        $apunte->asignatura_id = $asignatura;
        $apunte->permisovisualizacion = $permiso1;
        $apunte->permisoedicion = $permiso2;
        $apunte->permisoedicionpermiso = $permiso3;
        $apunte->likes = 0;
        $apunte->dislikes = 0;
        $apunte->visualizaciones = 0;
        $apunte->contenido = "";
        $apunte->ultimoeditor = $idUser;

        $idApunte = R::store($apunte);

        if ($permiso1 != 0 && $permiso1 != 2) {
            $lectores = $_POST["lector"];
            foreach ($lectores as $l) {
                $idLector = filter_var($l, FILTER_SANITIZE_NUMBER_INT);

                if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idLector, $idApunte]) > 0) {
                    $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idLector, $idApunte]);
                } else {
                    $interaccion = R::dispense("usuariointeractuaapunte");
                    $interaccion->apunte_id = $idApunte;
                    $interaccion->usuario_id = $idLector;
                }

                $interaccion->permiso = 1;
                R::store($interaccion);
            }
        }

        if ($permiso2 != 0) {
            $modificadores = $_POST["modificador"];
            foreach ($modificadores as $m) {
                $idModificador = filter_var($m, FILTER_SANITIZE_NUMBER_INT);

                if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idModificador, $idApunte]) > 0) {
                    $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idModificador, $idApunte]);
                } else {
                    $interaccion = R::dispense("usuariointeractuaapunte");
                    $interaccion->apunte_id = $idApunte;
                    $interaccion->usuario_id = $idModificador;
                }

                $interaccion->permiso = 2;
                echo "adsf";
                R::store($interaccion);
            }
        }

        if ($permiso3 != 0) {
            $permisores = $_POST["permisor"]; // Sí, se llama permisor, no es una errata. El que da un permiso... ¿no?
            foreach ($permisores as $p) {
                $idPermisor = filter_var($p, FILTER_SANITIZE_NUMBER_INT);

                if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idPermisor, $idApunte]) > 0) {
                    $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [$idPermisor, $idApunte]);
                } else {
                    $interaccion = R::dispense("usuariointeractuaapunte");
                    $interaccion->apunte_id = $idApunte;
                    $interaccion->usuario_id = $idPermisor;
                }

                $interaccion->permiso = 3;
                R::store($interaccion);
            }
        }

        R::close();

        $_SESSION["exito"] = "Apunte creado correctamente";

        return "usuario/editar-apunte.php?id=" . $idApunte;
    }

    public function notFound() {

        return "usuario/404.php";
    }

    public function logout() {

        apunteaSec\logout
        ();
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        R::freeze(TRUE);
    }

}
