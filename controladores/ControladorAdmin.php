<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorAdmin {

    private $variables = array();
    private $emojis = array(
        array("char" => "XD", "alias" => "laughing", "class" => "twa twa-laughing"),
        array("char" => ":*", "alias" => "kissing_heart", "class" => "twa twa-kissing-heart"),
        array("char" => ":D", "alias" => "smile", "class" => "twa twa-smile"),
        array("char" => ";)", "alias" => "wink", "class" => "twa twa-wink"),
        array("char" => ":_(", "alias" => "cry", "class" => "twa twa-cry"),
        array("char" => "¬¬", "alias" => "unamused", "class" => "twa twa-unamused"),
        array("char" => "zzz", "alias" => "sleeping", "class" => "twa twa-sleeping"),
        array("char" => "^^", "alias" => "blush", "class" => "twa twa-blush"),
        array("char" => "<3", "alias" => "heart", "class" => "twa twa-heart"));

    public function __construct() {
        apunteaSec\checkAdmin();
    }

    public function anadirCarrera() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');

        return $this->variables;
    }

    public function carreras($universidad = "") {

        $this->setUpDatabase();

        $this->variables["carreras"] = ($universidad != "") ? R::find("carrera", " universidad_id = " . $universidad) : R::findAll("carrera");
        $this->variables["universidades"] = R::findAll("universidad");

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

    public function asignatura() {
        $this->setUpDatabase();
        R::close();
        return $this->variables;
    }

    public function asignaturas($carrera = "") {

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

    public function verApunte() {

        $idApunte = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $this->variables["apunte"] = R::findOne('apunte', ' id=?', [$idApunte]);

        $this->variables["likes"] = R::getAll("SELECT COUNT(*) as num, WEEK(fechalike) as semana FROM usuariointeractuaapunte WHERE TIMESTAMPDIFF(WEEK, NOW(), fechalike) >= -8 GROUP BY WEEK(fechalike)");
        $this->variables["dislikes"] = R::getAll("SELECT COUNT(*) as num, WEEK(fechadislike) as semana FROM usuariointeractuaapunte WHERE TIMESTAMPDIFF(WEEK, NOW(), fechadislike) >= -8 GROUP BY WEEK(fechadislike)");
        $this->variables["favoritos"] = R::getAll("SELECT COUNT(*) as num, WEEK(fechafavorito) as semana FROM usuariointeractuaapunte WHERE TIMESTAMPDIFF(WEEK, NOW(), fechafavorito) >= -8 GROUP BY WEEK(fechafavorito)");
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

    public function buscarEmoji($texto) {


        foreach ($this->emojis as $emoji) {

            $texto = str_replace('[' . $emoji["alias"] . ']', '<span class="' . $emoji["class"] . ' twa-lg"></span>', $texto);
        }

        return $texto;
    }

    public function mensajes() {

        $this->setUpDatabase();

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        echo $idUsuario;
        $idContacto = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $contactos = R::getAll("SELECT usuario.* FROM usuario, mensaje WHERE usuario.id = receptor_id AND emisor_id = ? OR usuario.id = emisor_id AND receptor_id = ? GROUP BY usuario.id", [$idUsuario, $idUsuario]);

        $this->variables["contactos"] = R::convertToBeans("usuario", $contactos);
        $this->variables["mensajes"] = R::findAll('mensaje', ' receptor_id = ? AND emisor_id = ? OR emisor_id = ? AND receptor_id = ? ORDER BY fecha', [$idUsuario, $idContacto, $idUsuario, $idContacto]);
        $this->variables["contacto"] = R::findOne('usuario', ' id = ?', [$idContacto]);

        return $this->variables;
    }

    public function apuntes() {
        $this->setUpDatabase();
        $this->variables["apuntes"] = R::findAll('apunte');
        $this->variables["universidades"] = R::findAll('universidad');
        $this->variables["carreras"] = R::findAll('carrera');

        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $this->variables["chart1"][$m["name"]] = R::count('apunte', 'MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -6', [$m["number"]]);
        }

        $this->variables["chart2"] = R::getAll("SELECT nick, COUNT(*) as num FROM usuario, apunte WHERE usuario.id = apunte.usuario_id GROUP BY nick ORDER BY num DESC limit 5");

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

    public function getGrupo() {
        $this->setUpDatabase();
        $idGrupo = filter_var($_GET["idGrupo"], FILTER_SANITIZE_NUMBER_INT);
        $this->variables['grupo'] = R::findOne('grupo', ' id = ? ', [$idGrupo]);

        $miembros = R::getAll('SELECT usuario.* FROM usuario, usuariogrupo '
                        . 'WHERE usuario.id=usuariogrupo.usuario_id AND usuariogrupo.grupo_id=? AND usuariogrupo.admitido = 1', [$idGrupo]); //     PABLEAR

        $this->variables["miembros"] = R::convertToBeans('usuario', $miembros);

        $comentarios = R::findAll('comentariogrupo', ' grupo_id = ? ', [$idGrupo]);
        $this->variables['comentarios'] = $comentarios;

        $this->variables["aportaciones"] = R::findAll('apunte', ' id IN(SELECT apunte_id FROM apuntegrupo WHERE grupo_id = ?) ORDER BY titulo', [$idGrupo]);

        R::close();
        return $this->variables;
    }

    private function cargarComunes() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->variables["usuario-actual"] = R::load('usuario', $idUsuario);
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        $this->cargarComunes();
    }

}
