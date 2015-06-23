<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";
require __DIR__ . "/../util/charts.php";

class ControladorAdmin {

    use charts;

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

    public function anadirAdmin() {

        $this->setUpDatabase();

        $this->variables["administrador"] = R::find('usuario', "tipo = 2");

        return $this->variables;
    }

    public function administradores() {
        $this->setUpDatabase();

        $this->variables['administrador'] = R::find("usuario", "tipo = 2");


        R::close();

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

        $this->variables["chart1"] = $this->apuntesPorUniversidades();
        $this->variables["chart2"] = $this->universidadesUsuarios();
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
            }


            $this->variables["numCarreras"] = $numCarreras;
            $this->variables["numAlumnos"] = $numAlumnos;
            $this->variables["numAsign"] = $numAsign;
            $this->variables["apuntes"] = R::findAll('apunte', 'asignatura_id IN (SELECT carrera.id FROM carrera, universidad WHERE universidad_id = universidad.id AND universidad.id = ?)', [$idUniversidad]);


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
        $this->variables["chart1"] = $this->carrerasUsuarios();
        $this->variables["chart2"] = $this->carrerasApuntes();
        $this->variables["carreras"] = ($universidad != "") ? R::find("carrera", " universidad_id = " . $universidad) : R::findAll("carrera");
        $this->variables["universidades"] = R::findAll("universidad");

        return $this->variables;
    }

    public function perfilCarrera() {

        $idCarrera = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $this->variables["chart1"] = $this->usuariosMesesCarreras($idCarrera);
        $this->variables["chart2"] = $this->apuntesMesesCarreras($idCarrera);
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

        $this->variables["chart1"] = $this->usuariosMeses();
        $this->variables["chart2"] = $this->usuariosConMasApuntes();

        R::close();

        return $this->variables;
    }

    public function usuario() {

        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        //Usuario
        $this->setUpDatabase();
        $this->variables["usuario"] = R::findOne("usuario", "id = ?", [$id]);

        if (isset($this->variables["usuario"])) {

            $this->variables["chart1"] = $this->numApuntesDeUsuario($id);
            $this->variables["chart2"] = $this->apuntesMasPopulares($id);

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

        $this->setUpDatabase();
        $this->variables["asignaturas"] = R::convertToBeans('asignatura', R::getAll('SELECT asignatura.* FROM asignatura, carrera WHERE carrera_id = carrera.id ORDER BY rama'));

        $this->variables["ramas"] = array("Artes y humanidades" => "fa-paint-brush", "Ciencias" => "fa-rocket", "Ciencias de la salud" => "fa-user-md", "Ingeniería y arquitectura" => "fa-cogs", "Ciencias sociales y jurídicas" => "fa-gavel");

        $this->variables["universidades"] = R::findAll("universidad");

        R::close();

        return $this->variables;
    }

    public function verApunte() {

        $idApunte = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        $this->variables["apunte"] = R::findOne('apunte', ' id=?', [$idApunte]);

        $this->variables["chart1"] = $this->numLikes($idApunte);
        $this->variables["chart2"] = $this->numDislikes($idApunte);
        $this->variables["chart3"] = $this->numFavs($idApunte);
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

        $this->variables["chart1"] = $this->usuariosMeses();
        $this->variables["chart2"] = $this->apuntesPorUniversidades();
        $this->variables["chart3"] = $this->apuntesMeses();

        $this->variables["numcarreras"] = R::count('carrera');
        $this->variables["numuniversidades"] = R::count('universidad');
        $this->variables["numapuntes"] = R::count('apunte');
        $this->variables["numasignaturas"] = R::count('asignatura');
        $this->variables["numusuarios"] = R::count('usuario', 'tipo=1 AND activo = 1');
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

        $this->variables["chart1"] = $this->apuntesMeses();

        $this->variables["chart2"] = $this->usuariosConMasApuntes();

        R::close();
        return $this->variables;
    }

    public function grupos() {
        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');
        $this->variables["grupos"] = R::findAll('grupo');

        $this->variables["chart1"] = $this->gruposConMasParticipantes();
        $this->variables["chart2"] = $this->gruposConMasApuntes();

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
