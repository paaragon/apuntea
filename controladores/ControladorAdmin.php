<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorAdmin {

    private $variables = array();

    public function __construct() {
        apunteaSec\checkAdmin();
    }

    public function anadirCarrera() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');
        R::close();
        return $this->variables;
    }

    public function grupos() {// = getUniversidades()...
        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');
        $this->variables["grupos"] = R::findAll('grupo');

        R::close();
        return $this->variables;
    }

    public function getGrupo() {// = getUniversidades()...
        $this->setUpDatabase();
        $idGrupo = filter_var($_GET["idGrupo"], FILTER_SANITIZE_NUMBER_INT);
        $this->variables['grupo'] = R::findOne('grupo', ' id = ? ', [$idGrupo]);

        $miembros = R::getAll('SELECT * FROM usuario, usuariogrupo '
                        . 'WHERE usuario.id=usuariogrupo.usuario_id AND usuariogrupo.grupo_id=' . $idGrupo); //     PABLEAR
        
        foreach ($miembros as $m) {
            $usuario = R::dispense('usuario');
            /*$usuario->carrera_id = $m->carrera_id;
            $usuario->ultimaconexion = $m->ultimaconexion;
            $usuario->nombre = $m->nombre;
            $usuario->apellidos = $m->apellidos;
            $usuario->nick = $m->nick;
            $usuario->password = $m->password;
            $usuario->tipo = $m->tipo;
            $usuario->avatar = $m->avatar;
            $usuario->imagenportada = $m->imagenportada;
            $usuario->email = $m->email;
            $usuario->privacidadperfil = $m->privacidadperfil;
            $usuario->privacidadactividad = $m->privacidadactividad;
            $usuario->privacidadbuscador = $m->privacidadbuscador;
            $usuario->estado = $m->estado;
            $usuario->direccion = $m->direccion;*/
            
            $usuario->carrera_id = $m["carrera_id"];
            $usuario->ultimaconexion = $m["ultimaconexion"];
            $usuario->nombre = $m["nombre"];
            $usuario->apellidos = $m["apellidos"];
            $usuario->nick = $m["nick"];
            $usuario->password = $m["password"];
            $usuario->tipo = $m["tipo"];
            $usuario->avatar = $m["avatar"];
            $usuario->imagenportada = $m["imagenportada"];
            $usuario->email = $m["email"];
            $usuario->privacidadperfil = $m["privacidadperfil"];
            $usuario->privacidadactividad = $m["privacidadactividad"];
            $usuario->privacidadbuscador = $m["privacidadbuscador"];
            $usuario->estado = $m["estado"];
            
            $this->variables['miembros'][] = $usuario;
        }
        
        $comentarios = R::findAll('comentariogrupo', ' grupo_id = ? ', [$idGrupo]);
        $this->variables['comentarios'] = $comentarios;
        
        R::close();
        return $this->variables;
    }

    public function carreras($universidad = "") {

        $this->setUpDatabase();

        $this->variables["carreras"] = ($universidad != "") ? R::find("carrera", " universidad_id = " . $universidad) : R::findAll("carrera");
        $this->variables["universidades"] = R::findAll("universidad");

        R::close();

        return $this->variables;
    }

    public function anadirAsignatura() {

        //Establecemos conexion con bd
        $this->setUpDatabase();


        //Para obtener las universidades disponibles
        $this->variables["universidades"] = R::findAll('universidad');

        //Para obtener las carreras disponibles
        $this->variables["carrera"] = R::findAll('carrera');


        R::close();

        return $this->variables;
    }

    public function asignatura($carrera = "") {

        $idCarrera = (isset($_POST["carrera"])) ? filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_NUMBER_INT) : "";
        $nombre = (isset($_POST["nombre"])) ? filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES) : "";

        $this->setUpDatabase();

        if ($idCarrera == "") {

            $this->variables["asignaturas"] = R::findAll("asignatura");
        } else {

            $this->variables["asignaturas"] = R::findAll("asignatura", " carrera_id = ? AND LOWER(nombre) LIKE ?", [$idCarrera, "%" . strtolower($nombre) . "%"]);
        }

        $this->variables["universidades"] = R::findAll("universidad");

        R::close();

        return $this->variables;
    }

    public function miConfiguracion() {

        //Obtencion de la idUsuario
        $idAdmin = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        //Establecemos conexion con bd
        $this->setUpDatabase();


        $this->variables["admin"] = R::findOne('usuario', " id=?", [$idAdmin]);

        R::close();


        return $this->variables;
    }

    private function cargarComunes() {

        $this->variables["usuario-actual"] = R::load('usuario', $_SESSION["idUsuario"]);
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        $this->cargarComunes();
    }

}
