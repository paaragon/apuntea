<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ServiciosAdmin {

    public function __construct() {
        apunteaSec\checkAdmin();
    }

    public function anadirAdmin() {

        $alias = filter_input(INPUT_POST, "alias", FILTER_SANITIZE_MAGIC_QUOTES);
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_MAGIC_QUOTES);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_MAGIC_QUOTES);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_MAGIC_QUOTES);
        $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();
        if ($password != $password2) {

            $_SESSION["error"] = "Error. Las contraseñas deben coincidir";
            header("location: ../admin/anadir-admin.php");
            exit();
        }
        
        $used=R::findOne("usuario", "nick=?", [$alias]);
        
        if ($used!=NULL){
            
            $_SESSION["error"] = "Error. El nombre de usuario ya está cogido";
            header("location: ../admin/anadir-admin.php");
            exit();
        }
        $usuario = R::dispense('usuario');
        $usuario->nombre = $nombre;
        $usuario->nick = $alias;
        $usuario->apellidos = $apellidos;
        $usuario->password = password_hash($password . "pimienta_de_la_buena", PASSWORD_DEFAULT);
        $usuario->email = $email;
        $usuario->tipo= "2";
        R::store($usuario);
        $_SESSION["exito"] = "Registro completado. Notificar al nuevo administrador";

        return "admin/administradores.php";
        
        
    }

    public function anadirCarrera() {

        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $idUniversidad = filter_input(INPUT_POST, "universidad", FILTER_SANITIZE_NUMBER_INT);
        $rama = filter_input(INPUT_POST, "rama", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();

        $carrera = R::dispense('carrera');
        $carrera->nombre = $nombre;
        $carrera->universidad_id = $idUniversidad;
        $carrera->rama = $rama;


        try {

            $idCarrera = R::store($carrera);
            $_SESSION["exito"] = "Carrera insertada con éxito";
            $return = "admin/perfil-carrera.php?id=" . $idCarrera;
        } catch (Exception $e) {

            $_SESSION["error"] = "Error al insertar carrera";
            $return = "admin/anadir-carrera.php";
        }

        R::close();

        return $return;
    }

    //Añadimos la carrera
    public function anadirAsignatura() {

        $idCarrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_MAGIC_QUOTES);
        $curso = filter_input(INPUT_POST, "curso", FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();

        $asignatura = R::dispense('asignatura');

        $asignatura->carrera_id = $idCarrera;
        $asignatura->curso = $curso;
        $asignatura->nombre = $nombre;


        try {

            $idAsignatura = R::store($asignatura);
            $_SESSION["exito"] = "Asignatura insertada con éxito";
            $return = "admin/asignatura.php?id=" . $idAsignatura;
        } catch (Exception $e) {

            $_SESSION["error"] = "Error al insertar asignatura";
            $return = "admin/asignturas-nuevas.php";
        }

        R::close();

        return $return;
    }

    public function editarUniversidad() {

        require __DIR__ . "/../util/CropAvatar.php";

        $idUniversidad = filter_input(INPUT_POST, "idUniversidad", FILTER_SANITIZE_MAGIC_QUOTES);
        $nombre = filter_input(INPUT_POST, "universidad", FILTER_SANITIZE_MAGIC_QUOTES);
        $siglas = filter_input(INPUT_POST, "siglas", FILTER_SANITIZE_MAGIC_QUOTES);
        $imgPerfil = $_FILES["img-perfil"];
        $perfilData = filter_input(INPUT_POST, "img-perfil-data", FILTER_SANITIZE_MAGIC_QUOTES);
        $perfilSrc = filter_input(INPUT_POST, "img-perfil-src", FILTER_SANITIZE_MAGIC_QUOTES);
        $imgPortada = $_FILES["img-portada"];
        $portadaData = filter_input(INPUT_POST, "img-portada-data", FILTER_SANITIZE_MAGIC_QUOTES);
        $portadaSrc = filter_input(INPUT_POST, "img-portada-src", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();
        $universidad = R::findOne('universidad', 'id=?', [$idUniversidad]);

        $universidad->nombre = $nombre;
        $universidad->siglas = $siglas;

        if ($imgPerfil["name"] != "") {
            $crop = new CropAvatar($perfilSrc, $perfilData, $imgPerfil, "universidades/perfil");

            $namearr = explode("/", $crop->getResult());
            unlink(__DIR__ . "/../img/universidades/perfil/" . $universidad->imagenperfil);
            $universidad->imagenperfil = $namearr[4];
        }

        if ($imgPortada["name"] != "") {
            $crop2 = new CropAvatar($portadaSrc, $portadaData, $imgPortada, "universidades/portada");

            $namearr2 = explode("/", $crop2->getResult());
            unlink(__DIR__ . "/../img/universidades/portada/" . $universidad->imagenportada);
            $universidad->imagenportada = $namearr2[4];
        }

        try {
            R::store($universidad);
            $return = "admin/universidades.php";
        } catch (Exception $e) {
            $_SESSION["error"] = $e->getMessage();
            $return = "admin/universidades.php";
        }
        R::close();
        return $return;
    }

    public function borrarUniversidad() {

        $idUniversidad = filter_input(INPUT_GET, "idUniversidad", FILTER_SANITIZE_MAGIC_QUOTES);

        try {
            $this->setUpDatabase();
            //Ceamos un bean
            $universidad = R::load('universidad', $idUniversidad);
            //Borramos 
            R::trash($universidad);
            $_SESSION["exito"] = $universidad->nombre . "  borrada con éxito";
            $return = "admin/universidades.php";
        } catch (Exception $ex) {
            $_SESSION["error"] = "Error al borrar la universidad elegida";
            $return = "admin/universidades.php";
        }
        R::close();
        return $return;
    }

    public function anadirUniversidad() {
        require __DIR__ . "/../util/CropAvatar.php";
        $nombre = filter_input(INPUT_POST, "universidad", FILTER_SANITIZE_MAGIC_QUOTES);
        $siglas = filter_input(INPUT_POST, "siglas", FILTER_SANITIZE_MAGIC_QUOTES);
        $imgPerfil = $_FILES["img-perfil"];
        $perfilData = filter_input(INPUT_POST, "img-perfil-data", FILTER_SANITIZE_MAGIC_QUOTES);
        $perfilSrc = filter_input(INPUT_POST, "img-perfil-src", FILTER_SANITIZE_MAGIC_QUOTES);
        $imgPortada = $_FILES["img-portada"];
        $portadaData = filter_input(INPUT_POST, "img-portada-data", FILTER_SANITIZE_MAGIC_QUOTES);
        $portadaSrc = filter_input(INPUT_POST, "img-portada-src", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();

        $universidad = R::dispense('universidad');
        $universidad->nombre = $nombre;
        $universidad->siglas = $siglas;

        if ($imgPerfil["name"] != "") {
            $crop = new CropAvatar($perfilSrc, $perfilData, $imgPerfil, "universidades/perfil");

            $namearr = explode("/", $crop->getResult());
            $universidad->imagenperfil = $namearr[4];
        }

        if ($imgPortada["name"] != "") {
            $crop2 = new CropAvatar($portadaSrc, $portadaData, $imgPortada, "universidades/portada");

            $namearr2 = explode("/", $crop2->getResult());
            $universidad->imagenportada = $namearr2[4];
        }

        try {
            $idUniversidad = R::store($universidad);
            $_SESSION["exito"] = "Universidad insertada con éxito";
            $return = "admin/perfil-universidad.php?id=" . $idUniversidad;
        } catch (Exception $e) {
            $_SESSION["error"] = $e->getMessage();
            unlink(__DIR__ . "/../img/universidades/perfil/" . $universidad->imagenperfil);
            unlink(__DIR__ . "/../img/universidades/portada/" . $universidad->imagenportada);
            $return = "admin/universidad-nueva.php";
        }
        R::close();
        return $return;
    }

    public function borrarUsuario($parametros) {

        try {
            $this->setUpDatabase();
            $idUsuario = filter_input(INPUT_GET, "idUsuario", FILTER_SANITIZE_NUMBER_INT);
            //Ceamos un bean
            $usuario = R::findOne('usuario', 'id=?', [$idUsuario]);
            unlink(__DIR__ . "/../img/usuarios/perfil/" . $usuario->avatar);
            unlink(__DIR__ . "/../img/usuarios/portada/" . $usuario->imagenportada);
            //Borramos 
            R::trash($usuario);
            $_SESSION["exito"] = "@" . $usuario->nick . "  borrado con éxito";
            $return = "admin/usuarios.php";
        } catch (Exception $ex) {
            $_SESSION["error"] = "Error al borrar usuario";
            $return = "admin/usuario.php";
        }
        R::close();
        return $return;
    }

    public function removeGrupo() {
        $idGrupo = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $grupo = R::findOne('grupo', ' id = ? ', [$idGrupo]);
        R::trash($grupo);
        R::close();
        $_SESSION['exito'] = "Grupo eliminado con éxito";
        return "admin/grupos.php";
    }

    public function removeApunte() {
        $idApunte = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $apunte = R::findOne('apunte', ' id = ? ', [$idApunte]);
        R::trash($apunte);
        R::close();
        $_SESSION['exito'] = "Apunte eliminado con éxito";
        return "admin/apuntes.php";
    }

    public function sendToAdmin() {
        $idGrupo = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $usuariogrupo = R::findOne('usuariogrupo', ' grupo_id = ? AND isadmin = 1 ', [$idGrupo]);
        R::close();
        return "admin/mensajes.php?id=" . $usuariogrupo->usuario_id;
    }

    public function borrarAsignatura($parametros) {


        /*
          usar parametros obtenemos el id por este parametro
         *          */

        try {
            $this->setUpDatabase();

            //Ceamos un bean
            $asignatura = R::load('asignatura', $parametros['idAsignatura']);
            //Borramos 
            R::trash($asignatura);

            $_SESSION["exito"] = $asignatura->nombre . " - (" . $asignatura->carrera->nombre . ") borrada con éxito";
            $return = "admin/asignaturas.php";
        } catch (Exception $ex) {

            $_SESSION["error"] = "Error al borrar asignatura";
            $return = "admin/asignaturas.php";
        }


        R::close();

        return $return;
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
                return "admin/mensajes.php?id=" . $params["redirect"];
            }
        } catch (Exception $e) {
            echo $e;
        }

        R::close();
    }

    public function borrarCarrera() {
        $this->setUpDatabase();

        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $carrera = R::load('carrera', $id);

        R::trash($carrera);

        R::close();
        $_SESSION["exito"] = "Carrera eliminada con éxito";
        return "admin/carreras.php";
    }

    public function editarAsignatura($parametros) {

        $this->setUpDatabase();

        $asignatura = R::load('asignatura', $parametros['idAsignatura']);


        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);

        $universidad = filter_input(INPUT_POST, "universidad", FILTER_SANITIZE_MAGIC_QUOTES);

        $carrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_MAGIC_QUOTES);

        $asignatura->nombre = $nombre;
        $asignatura->carrera_id = $carrera;

        try {
            R::store($asignatura);
            $_SESSION["exito"] = "Asignatura cambiada con éxito";
            $return = "admin/asignaturas.php";
        } catch (Exception $e) {
            $_SESSION["error"] = "Error al cambiar asignatura";
            $return = "admin/asignaturas.php";
        }
        R::close();
        return $return;
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

    public function cambiarConfiguracion() {

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_MAGIC_QUOTES);
        $email = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_MAGIC_QUOTES);
        $newPass = filter_input(INPUT_POST, "new-password", FILTER_SANITIZE_MAGIC_QUOTES);
        $pass3 = filter_input(INPUT_POST, "pass3", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();

        $usuario = R::findOne('usuario', ' id = ?', [$idUsuario]);
        $usuario->nombre = $nombre;
        $usuario->apellidos = $apellidos;
        $usuario->email = $email;

        if ($newPass != "" && $newPass == $pass3) {

            $usuario->password = password_hash($newPass, PASSWORD_DEFAULT);

            R::store($usuario);

            $_SESSION["exito"] = "Los datos y la contraseña han sido guardadas con exito.";

            $return = "admin/inicio.php";
        } else if ($newPass == "") {

            R::store($usuario);

            $_SESSION["exito"] = "Los datos  han sido guardadas con exito.";

            $return = "admin/inicio.php";
        } else {

            $_SESSION["error"] = "Error. Las contraseñas deben ser iguales";

            //Volvemos a la pagina 
            $return = "admin/editar-admin.php";
        }


        R::close();


        return $return;
    }

    public function notFound() {

        return "404.php";
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        R::freeze(TRUE);
    }

}
