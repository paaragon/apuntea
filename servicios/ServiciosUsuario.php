<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ServiciosUsuario {

    public function __construct() {
        apunteaSec\checkUsuario();
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

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $idApunte = filter_input(INPUT_POST, "apunte", FILTER_SANITIZE_NUMBER_INT);
        $contenido = filter_input(INPUT_POST, "contenido", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();

        $apunte = R::findOne("apunte", ' id = ? AND (usuario_id = ? OR id IN (SELECT apunte_id FROM usuariointeractuaapunte WHERE usuario_id = ?))', [$idApunte, $idUsuario, $idUsuario]);

        $apunte->contenido = $contenido;

        R::store($apunte);
        R::close();

        $_SESSION["exito"] = "Apunte guardado con éxito";
        return "usuario/editar-apunte.php?id=" . $idApunte;
    }

    public function getMensajesDeUsuario($params) {

        $idContacto = $params["contacto"];
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        if (!isset($params["nuevos"])) {

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
            echo json_encode($mensaje->export());
        } catch (Exception $e) {
            echo $e;
        }

        R::close();
    }

    public function getCarreras() {
        $idUni = filter_input(INPUT_POST, "idUniversidad", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $carreras = R::findAll("carrera", " universidad_id = ? ORDER BY nombre", [$idUni]);
        R::close();

        return json_encode(R::exportAll($carreras));
    }

    public function getAsignaturas() {
        $idCar = filter_input(INPUT_POST, "idCarrera", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $asignaturas = R::findAll("asignatura", " carrera_id = ? ORDER BY nombre", [$idCar]);
        R::close();
        return json_encode(R::exportAll($asignaturas));
    }

    private function checkUserPwd($pwd1, $pwd2, $pwd3, $currentPwd) {
        $estado = FALSE;
        if ($pwd1 != "") {
            if (password_verify(password_hash($pwd1, PASSWORD_DEFAULT), $currentPwd)) {
                if ($pwd2 != $pwd3) {
                    $message = "Las contraseñas nuevas no coinciden";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                } else {//Cambios en la contrasela hechos efectivos!!
                    $estado = TRUE;
                }
            } else {
                $message = "La contraseña no es válida";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        } else {//Ningun cambio en los campos de formulario
            $estado = TRUE;
        }
        return $estado;
    }

    public function guardarConfiguracionUsuario() {

        $nick = filter_input(INPUT_POST, "nick", FILTER_SANITIZE_MAGIC_QUOTES);
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_MAGIC_QUOTES);
        $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
        $direccion = filter_input(INPUT_POST, "direccion", FILTER_SANITIZE_MAGIC_QUOTES);
        $carrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_NUMBER_INT);
        $pwd1 = filter_input(INPUT_POST, "pwd1", FILTER_SANITIZE_MAGIC_QUOTES);
        $pwd2 = filter_input(INPUT_POST, "pwd2", FILTER_SANITIZE_MAGIC_QUOTES);
        $pwd3 = filter_input(INPUT_POST, "pwd3", FILTER_SANITIZE_MAGIC_QUOTES);
        $privacidadperfil = filter_input(INPUT_POST, "vis-perfil", FILTER_SANITIZE_NUMBER_INT);
        $privacidadactividad = filter_input(INPUT_POST, "vis-actividad", FILTER_SANITIZE_NUMBER_INT);
        $privacidadbuscador = filter_input(INPUT_POST, "vis-buscador", FILTER_SANITIZE_NUMBER_INT);

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

        $usuario = R::findOne("usuario", " id = ? ", [$idUser]);
        $currentPwd = $usuario->password;

        $usuario->nick = $nick;
        $usuario->nombre = $nombre;
        $usuario->apellidos = $apellidos;
        $usuario->mail = $mail;
        $usuario->direccion = $direccion;
        $usuario->carrera_id = $carrera;
        $usuario->privacidadperfil = $privacidadperfil;
        $usuario->privacidadactividad = $privacidadactividad;
        $usuario->privacidadbuscador = $privacidadbuscador;

        if ($this->checkUserPwd($pwd1, $pwd2, $pwd3, $currentPwd)) {
            $usuario->password = password_hash($pwd2, PASSWORD_DEFAULT);
        } else {
            $_SESSION["error"] = "Las contraseñas no coinciden";
            return "usuario/mi-configuracion.php";
        }

        R::store($usuario);

        //END TRANSACTION
        R::close();

        $_SESSION["exito"] = "Configuración modificada correctamente";

        return "usuario/mi-configuracion.php";
    }

    public function subirApunte() {
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
        $apunte->contenido = ""; //estos valores (default) deberiamos ponerlos bien en la BD

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
            $permisores = $_POST["permisores"]; // Sí, se llama permisor, no es una errata. El que da un permiso... ¿no?
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

    public function logout() {

        apunteaSec\logout();
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
