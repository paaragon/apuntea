<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ServiciosUsuario {

    public function __construct() {
        apunteaSec\checkUsuario();
    }

    public function borrarapunte() {

        $this->setUpDatabase();
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        //borrar etiquetas
        $etiquetas = R::find('etiquetaapunte', 'apunte_id= :idapunte', array(':idapunte' => $id));
        R::trashAll($etiquetas);
        //borrar interactuacion
        $interactuacion = R::find('usuariointeractuaapunte', 'apunte_id= :idapunte', array(':idapunte' => $id));
        R::trashAll($interactuacion);

        //borrar apunte
        $apunte = R::load('apunte', $id);

        R::trash($apunte);

        R::close();
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
        if ($interaccion->permiso == 3 || $apunte->usuario_id == $idUsuario) {
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

                    if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idLector, $idApunte]) > 0) {
                        $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idLector, $idApunte]);
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

                    if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idModificador, $idApunte]) > 0) {
                        $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idModificador, $idApunte]);
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

                    if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idPermisor, $idApunte]) > 0) {
                        $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idPermisor, $idApunte]);
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

    public function comentarApunte() {

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

    public function enviarMensaje($params) {

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

            if (!isset($params["redirect"])) {
                echo json_encode($mensaje->export());
            } else {
                return "usuario/mis-mensajes.php?id=" . $params["redirect"];
            }
        } catch (Exception $e) {
            echo $e;
        }

        R::close();
    }

    public function aceptarPeticion($params) {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $contacto = filter_var($params["user"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $peticion = R::findOne("contacto", " bob_id = ? AND alice_id = ?", [$idUsuario, $contacto]);
        $peticion->admitido = 1;
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
            return json_encode(true);
        } else if ($interaccion->like == 0) {

            $interaccion->like = -1;

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes--;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(true);
        } else if ($interaccion->like == 1) {

            $interaccion->like = -1;

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes--;
            $apunte->dislikes++;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(true);
        }

        return json_encode(false);
    }

    public function enviarSolicitud($params) {
        $alice = filter_var($params["alice"], FILTER_SANITIZE_NUMBER_INT);
        $bob = filter_var($params["bob"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

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
            return json_encode(true);
        } else if ($interaccion->like == -1) {

            $interaccion->like = 1;

            $apunte = R::load("apunte", $idApunte);
            $apunte->likes++;
            $apunte->dislikes--;

            R::store($interaccion);
            R::store($apunte);
            return json_encode(true);
        }

        return json_encode(false);
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

        if ($imgPerfil ["name"] != "") {
            $crop = new CropAvatar($perfilSrc, $perfilData, $imgPerfil, "usuarios/perfil");

            $namearr = explode("/", $crop->getResult());

            unlink(__DIR__ . "/../img/usuarios/perfil/" . $usuario->avatar);
            $usuario->avatar = $namearr[4];
        }

        if ($imgPortada ["name"] != "") {
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

                if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idLector, $idApunte]) > 0) {
                    $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idLector, $idApunte]);
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

                if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idModificador, $idApunte]) > 0) {
                    $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idModificador, $idApunte]);
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

                if (R::count("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idPermisor, $idApunte]) > 0) {
                    $interaccion = R::findOne("usuariointeractuaapunte", " usuario_id = ? AND apunte_id = ?", [ $idPermisor, $idApunte]);
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

        return "usuario/editar-apunte.php?id=" .
                $idApunte;
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
    }

}
