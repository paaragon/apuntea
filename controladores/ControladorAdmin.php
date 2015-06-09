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

    public function asignatura() {

        $idAsignatura = (isset($_GET["id"])) ? filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) : "";
        $this->setUpDatabase();
        $this->variables["asignatura"] = R::findOne("asignatura", " id=? ", [$idAsignatura]);

        if (count($this->variables["asignatura"]) > 0) {
            $apuntes = $this->variables["asignatura"]->ownApunteList;


            if (isset($apuntes)) {
                $this->variables["apuntes"] = $apuntes;
            } else {
                $this->variables["apuntes"] = array();
            }
        }

        R::close();
        return $this->variables;
    }

    public function editarAsignatura() {

        $idAsignatura = (isset($_GET["id"])) ? filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) : "";
        $this->setUpDatabase();
        $this->variables["asignatura"] = R::findOne("asignatura", " id=? ", [$idAsignatura]);

        $this->variables["universidades"] = R::findAll('universidad');

        return $this->variables;
    }

    public function anadirCarrera() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');

        return $this->variables;
    }

    public function editarCarrera() {
        $this->setUpDatabase();

        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $this->variables["carrera"] = R::findOne('carrera', 'id=?', [$id]);

        $this->variables["universidades"] = R::findAll('universidad');

        return $this->variables;
    }

    public function universidades() {
        $this->setUpDatabase();
        $this->variables["universidades"] = R::findAll("universidad");

        if (count($this->variables["universidades"]) > 0) {
            foreach ($this->variables["universidades"] as $uni) {
                $acumapun = 0;
                $carr = $uni->ownCarreraList;
                foreach ($carr as $c) {
                    $asign = $c->ownAsignaturaList;
                    foreach ($asign as $a) {
                        $acumapun+=count($a->ownApunteList);
                    }
                }
                $uniapun[$uni->id] = $acumapun;
            }
            $this->variables['uniapun'] = $uniapun;
        }
        R::close();
        return $this->variables;
    }

    public function universidad() {

        $idUniversidad = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();

        if (isset($idUniversidad)) {
            $this->variables["universidad"] = R::findOne("universidad", " id=? ", [$idUniversidad]);
            $uni = $this->variables["universidad"];

            $this->variables["carreras"] = $uni->ownCarreraList;
            $numCarreras = 0;
            $numAlumnos = 0;
            $numAsign = 0;
            $carr = $uni->ownCarreraList;
            $numCarreras = count($uni->ownCarreraList);
            foreach ($carr as $c) {
                foreach ($c->ownUsuarioList as $user) {
                    $this->variables["usuarios"][] = $user;
                }
                $numAlumnos += count($c->ownUsuarioList);
                $numAsign += count($c->ownAsignaturaList);
                $asign = $c->ownAsignaturaList;
                foreach ($asign as $a) {
                    $apuntes = $a->ownApunteList;
                }
            }


            $this->variables["numCarreras"] = $numCarreras;
            //} else $this->variables["numCarreras"]=array();
            //if (isset($alumnos)){
            $this->variables["numAlumnos"] = $numAlumnos;
            //} else $this->variables["alumnos"]=array();
            //if (isset($numAsig)){
            $this->variables["numAsign"] = $numAsign;
            //} else $this->variables["numAsign"]=array();
            if (isset($apuntes)) {
                $this->variables["apuntes"] = $apuntes;
            } else
                $this->variables["apuntes"] = array();


            //novedades

            foreach ($this->variables["apuntes"] as $apunteNov) {
                $datetime = strtotime($apunteNov->fecha);
                $current = strtotime('now');
                if (($current - $datetime) <= 86400) {
                    $apuntesNovedades = $apunteNov;
                }
            }

            if (isset($apuntesNovedades)) {
                $this->variables["apuntesNuevos"][] = $apuntesNovedades;
            } else
                $this->variables["apuntesNuevos"] = array();


            if (isset($this->variables["usuarios"])) {
                foreach ($this->variables["usuarios"] as $usuarioNov) {
                    $datetime = strtotime($usuarioNov->fecha);
                    $current = strtotime('now');
                    if (($current - $datetime) <= 86400) {
                        $usuariosNovedades = $usuarioNov;
                    }
                }
            }

            if (isset($usuariosNovedades)) {
                $this->variables["usuariosNuevos"][] = $usuariosNovedades;
            } else {
                $this->variables["usuariosNuevos"] = array();
            }
        }
        R::close();
        return $this->variables;
    }

    public function carreras($universidad = "") {

        $this->setUpDatabase();

        $this->variables["carreras"] = ($universidad != "") ? R::find("carrera", " universidad_id = " . $universidad) : R::findAll("carrera");
        $this->variables["universidades"] = R::findAll("universidad");

        return $this->variables;
    }

    public function perfilCarrera() {

        $idCarrera = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $this->variables["carrera"] = R::findOne("carrera", "id=?", [$idCarrera]);
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

    public function usuarios() {
        $this->setUpDatabase();

        $this->variables["usuarios"] = R::findAll('usuario', " tipo != 2 ");

        //Gráfica 1
        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $this->variables["chart1"][$m["name"]] = R::count('usuario', 'MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -6', [$m["number"]]);
        }

        $this->variables["chart2"] = R::getAll("SELECT nick, COUNT(*) as num FROM usuario, apunte WHERE usuario.id = apunte.usuario_id GROUP BY nick ORDER BY num DESC limit 5");

        R::close();

        return $this->variables;
    }

    public function usuario() {

        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        //Usuario
        $this->setUpDatabase();
        $this->variables["usuario"] = R::findOne("usuario", "id = ?", [$id]);

        if (isset($this->variables["usuario"])) {



            setlocale(LC_ALL, 'esp');

            //Gráfica 1  
            $month = time();
            for ($i = 1; $i <= 2; $i++) {
                $month = strtotime('last month', $month);
                $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
            }

            foreach ($months as $m) {
                $this->variables["chart1"][$m["name"]] = R::count('apunte', 'usuario_id = ? AND MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -1', [$id, $m["number"]]);
            }

            $this->variables["chart2"] = R::getAll("SELECT apunte.titulo, apunte.likes FROM apunte, usuario WHERE apunte.usuario_id = usuario.id AND usuario_id = ? ORDER BY apunte.likes DESC limit 5", [$id]);

            //Carrera usuario
            $this->variables["carrera"] = R::findOne("carrera", "id = " . $this->variables["usuario"]->carrera_id);

            //Universidad usuario
            $this->variables["universidad"] = R::findOne("universidad", "id = " . $this->variables["carrera"]->universidad_id);

            //Apuntes usuario
            $this->variables["apuntes"] = R::findAll("apunte", "usuario_id = ?", [$id]);

            //Grupos usuario
            $this->variables["usuariogrupo"] = R::findAll("usuariogrupo", "usuario_id = ?", [$id]);

            foreach ($this->variables["usuariogrupo"] as $usuariogrupo) {
                $this->variables["grupos"] = R::findAll("grupo", "id = " . $usuariogrupo->grupo_id);
            }

            //Amigos usuario
            $user = R::load('usuario', $id);

            $misBob = $user->alias('alice')->ownContactoList;
            foreach ($misBob as $b) {
                $contacto = $b->fetchAs('usuario')->bob;
                $this->variables["amigos"][$contacto->nombre] = $contacto;
            }

            $misAlice = $user->alias('bob')->ownContactoList;
            foreach ($misAlice as $a) {
                $contacto = $a->fetchAs('usuario')->alice;
                $this->variables["amigos"][$contacto->nombre] = $contacto;
            }

            if (isset($this->variables["amigos"])) {
                usort($this->variables["amigos"], array("self", "cmp"));
            }
        }
        R::close();

        return $this->variables;
    }

    public function asignaturas() {

        $idCarrera = (isset($_POST["carrera"])) ? filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_NUMBER_INT) : "";
        $nombre = (isset($_POST["nombre"])) ? filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES) : "";

        $this->setUpDatabase();

        if ($idCarrera == "") {

            $this->variables["asignaturas"] = R::findAll("asignatura");
        } else {

            $this->variables["asignaturas"] = R::findAll("asignatura", " carrera_id = ? AND LOWER(nombre) LIKE ?", [$idCarrera, "%" . strtolower($nombre) . "%"]);
        }

        $this->variables["ramas"] = array("Artes y humanidades" => "fa-paint-brush", "Ciencias" => "fa-rocket", "Ciencias de la salud" => "fa-user-md", "Ingeniería y arquitectura" => "fa-cogs", "Ciencias sociales y jurídicas" => "fa-gavel");

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

    public function inicio() {

        $this->setUpDatabase();
        setlocale(LC_ALL, 'esp');

        //Gráfica 1
        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $this->variables["chart1"][$m["name"]] = R::count('usuario', 'MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -6', [$m["number"]]);
            $this->variables["chart3"][$m["name"]] = R::count('apunte', 'MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -6', [$m["number"]]);
        }

        $this->variables["chart2"] = R::getAll('SELECT universidad.siglas, COUNT(*) / (SELECT COUNT(*) / 100 FROM apunte) as num FROM universidad, carrera, asignatura, apunte WHERE universidad.id = universidad_id AND carrera.id = carrera_id AND asignatura.id = asignatura_id GROUP BY universidad.id ORDER BY num DESC');

        $this->variables["numcarreras"] = R::count('carrera');
        $this->variables["numuniversidades"] = R::count('universidad');
        $this->variables["numapuntes"] = R::count('apunte');
        $this->variables["numasignaturas"] = R::count('asignatura');
        $this->variables["grupos"] = array();
        $this->variables["usuarios"] = array();
        $this->variables["apuntes"] = array();

        //grupos recientes
        $grupos = R::findAll('grupo');
        foreach ($grupos as $g) {
            $datetime = strtotime($g->fecha);
            $current = strtotime('now');
            if (($current - $datetime) <= 43200) {
                $this->variables["grupos"][] = $g;
            }
        }
        //usuarios recientes
        $usuarios = R::findAll('usuario');
        foreach ($usuarios as $u) {
            $datetime = strtotime($u->fecha);
            $current = strtotime('now');
            if (($current - $datetime) <= 43200) {
                $this->variables["usuarios"][] = $u;
            }
        }
        //apuntes recientes
        $apuntes = R::findAll('apunte');
        foreach ($apuntes as $a) {
            $datetime = strtotime($a->fecha);
            $current = strtotime('now');
            if (($current - $datetime) <= 43200) {
                $this->variables["apuntes"][] = $a;
            }
        }
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
        $idGrupo = filter_input(INPUT_GET, "idGrupo", FILTER_SANITIZE_NUMBER_INT);
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

    private function cmp($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }

    private function cargarComunes() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->variables["usuario-actual"] = R::load('usuario', $idUsuario);
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        R::freeze(TRUE);
        $this->cargarComunes();
    }

}
