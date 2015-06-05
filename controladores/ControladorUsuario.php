<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorUsuario {

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

    public function idInArray($needle, $array) {

        foreach ($array as $item) {
            if ($needle->id == $item->id) {
                return true;
            }
        }

        return false;
    }

    public function __construct() {
        apunteaSec\checkUsuario();
    }

    public function inicio() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $usuario = R::load('usuario', $idUsuario);

        //Nuevos amigos      
        $this->variables["nuevosAmigos"] = array();
        $this->variables["amigos"] = array();
        $pruebaAmigos = array();

        $misBob = $usuario->alias('alice')->ownContactoList;
        foreach ($misBob as $b) {
            $contacto = $b->fetchAs('usuario')->bob;
            $this->variables["amigos"] = $contacto;
            $pruebaAmigos[] = $contacto;
            $datetime = strtotime($b->fecha);
            $current = strtotime('now');
            if (($current - $datetime) <= 86400) {
                $this->variables["nuevosAmigos"][] = $contacto;
            }
        }

        $misAlice = $usuario->alias('bob')->ownContactoList;
        foreach ($misAlice as $a) {
            $contacto = $a->fetchAs('usuario')->alice;
            $this->variables["amigos"] = $contacto;
            $pruebaAmigos[] = $contacto;
            $datetime = strtotime($a->fecha);
            $current = strtotime('now');
            if (($current - $datetime) <= 86400) {
                $this->variables["nuevosAmigos"][] = $contacto;
            }
        }

        //Nuevos apuntes de amigos
        $this->variables["nuevosApuntes"] = array();
        $this->variables["apuntesAmigo"] = array();

        foreach ($pruebaAmigos as $amigo) {
            $this->variables["apuntesAmigo"] = R::findAll("apunte", "usuario_id = ?", [$amigo->id]);
            foreach ($this->variables["apuntesAmigo"] as $apunteAmigo) {
                $datetime = strtotime($apunteAmigo->fecha);
                $current = strtotime('now');
                if (($current - $datetime) <= 86400) {
                    $this->variables["nuevosApuntes"][] = $apunteAmigo;
                }
            }
        }

        //Nuevos contactos en tus grupos
        $this->variables["nuevosContactosGrupo"] = array();

        $resultado = R::getAll(' SELECT *
                                  FROM usuario, usuariogrupo
                                  WHERE TIMESTAMPDIFF(HOUR, NOW(), usuariogrupo.fecha) >= -24 and
                                  usuariogrupo.usuario_id != ? and usuario.id = usuariogrupo.usuario_id
                                  and usuariogrupo.grupo_id IN (SELECT usuariogrupo.grupo_id
                                                                FROM usuariogrupo
                                                                WHERE usuariogrupo.usuario_id = ?) ', [$idUsuario, $idUsuario]);

        $nuevoContacto = R::convertToBeans('usuario', $resultado);
        $this->variables["nuevosContactosGrupo"] = $nuevoContacto;

        R::close();
        return $this->variables;
    }

    public function resultadoBusqueda() {

        $busqueda = filter_var($_POST["busqueda"], FILTER_SANITIZE_MAGIC_QUOTES);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->variables["busqueda"] = $busqueda;
        $this->setUpDatabase();

        //apuntes por etiquetas, carreras, asignaturas, universidades y usuarios (grupos con visibilidad para mi o total)
        $resultadosapuntesporetiquetas = R::getAll('SELECT apunte.* FROM apunte,etiquetaapunte,etiqueta WHERE LOWER(etiqueta.titulo) '
                        . 'LIKE ? AND etiquetaapunte.etiqueta_id=etiqueta.id AND apunte.id=etiquetaapunte.apunte_id', ['%' . strtolower($busqueda) . '%']);
        $apuntes = R::convertToBeans('apunte', $resultadosapuntesporetiquetas);
        $resultadosapuntesportitulo = R::find('apunte', ' apunte.titulo LIKE ?', ['%' . strtolower($busqueda) . '%']);

        $resultado = $resultadosapuntesporetiquetas + $resultadosapuntesportitulo;
        $this->variables["apuntes"] = $resultado;


        $resultadocarreras = R::find('carrera', ' LOWER(carrera.nombre) LIKE :nombre OR LOWER(carrera.rama) LIKE :rama', array(':nombre' => '%' . strtolower($busqueda) . '%', ':rama' => '%' . strtolower($busqueda) . '%'));

        foreach ($resultadocarreras as $car) {
            $acum = 0;
            $asig = $car->ownAsignaturaList;
            foreach ($asig as $as) {
                $acum+=count($as->ownApunteList);
            }
            $carapuntes[$car->id] = $acum;
        }

        $this->variables['carapuntes'] = $carapuntes;

        $this->variables["carreras"] = $resultadocarreras;

        $resultadousuarios = R::getAll('SELECT usuario.* FROM usuario WHERE (usuario.privacidadbuscador=1 OR id IN (SELECT bob_id FROM contacto WHERE alice_id = ?) OR id IN (SELECT alice_id FROM contacto WHERE bob_id = ?))
                AND (LOWER(usuario.nick) LIKE ? OR LOWER(usuario.nombre) LIKE ? '
                        . 'OR LOWER(usuario.apellidos) LIKE ?)', [$idUsuario, $idUsuario, '%' . strtolower($busqueda) . '%', '%' . strtolower($busqueda) . '%', '%' . strtolower($busqueda) . '%']);
        $personas = R::convertToBeans('usuario', $resultadousuarios);
        $this->variables["usuarios"] = $personas;



        $asignaturas = R::find('asignatura', 'LOWER(asignatura.nombre) LIKE :nombre OR LOWER(asignatura.descripcion) LIKE :desc', array(':nombre' => '%' . strtolower($busqueda) . '%', ':desc' => '%' . strtolower($busqueda) . '%'));
        $this->variables["asignaturas"] = $asignaturas;



        $resultadouniversidades = R::findAll('universidad', 'LOWER(universidad.nombre) LIKE :nombre OR LOWER(universidad.descripcion) LIKE :desc '
                        . 'OR LOWER(universidad.siglas) LIKE :siglas', array(':nombre' => '%' . strtolower($busqueda) . '%', ':desc' => $busqueda, ':siglas' => $busqueda));

        foreach ($resultadouniversidades as $uni) {
            $acumal = 0;
            $acumapun = 0;
            $carr = $uni->ownCarreraList;
            foreach ($carr as $c) {
                $acumal+=count($c->ownUsuarioList);
                $asign = $c->ownAsignaturaList;
                foreach ($asign as $a) {
                    $acumapun+=count($a->ownApunteList);
                }
            }
            $unialum[$uni->id] = $acumal;
            $uniapun[$uni->id] = $acumapun;
        }

        $this->variables["universidades"] = $resultadouniversidades;
        $this->variables['uniapun'] = $uniapun;
        $this->variables['unialum'] = $unialum;

        R::close();

        return $this->variables;
    }

    public function misContactos() {

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $usuario = R::load('usuario', $idUsuario);

        //Obtenemos la lista de contactos(alice)
        $alice = $usuario->alias('alice')->ownContactoList;
        //Obtenemos la lista de contactos(bob)
        $bob = $usuario->alias('bob')->ownContactoList;

        //Recorremos la lista de alice para obtener sus bobs
        foreach ($alice as $a) {

            //Obtenemos un amigo de alice(bob)
            $contacto = $a->fetchAs('usuario')->bob;
            //Guardamos en el array el contacto
            $this->variables["contactosUsuario"][$contacto->nombre] = $contacto;
        }

        //Recorremos la lista de alice para obtener sus alices
        foreach ($bob as $b) {

            //Obtenemos un amigo de alice(bob)
            $contacto = $b->fetchAs('usuario')->alice;
            //Guardamos en el array el contacto
            $this->variables["contactosUsuario"][$contacto->nombre] = $contacto;
        }

        //Ordenamos los contactos del array
        usort($this->variables["contactosUsuario"], "cmp2");

        //Cerramos conexioon
        R::close();

        //Devolvemos con contenido
        return $this->variables;
    }

    public function buscarEmoji($texto) {


        foreach ($this->emojis as $emoji) {

            $texto = str_replace('[' . $emoji["alias"] . ']', '<span class="' . $emoji["class"] . ' twa-lg"></span>', $texto);
        }

        return $texto;
    }

    public function editarApunte() {

        $this->setUpDatabase();

        $idApunte = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->variables["apunte"] = R::findOne("apunte", ' id = ? AND (usuario_id = ? OR id IN (SELECT apunte_id FROM usuariointeractuaapunte WHERE usuario_id = ? AND permiso > 1))', [$idApunte, $idUsuario, $idUsuario]);
        $this->variables["usuario"] = R::findOne('usuario', 'id=?', [$idUsuario]);

        $this->variables["interaccion"] = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $idApunte]);

        $this->variables["lectores"] = R::findAll('usuario', 'id IN (SELECT usuario_id FROM usuariointeractuaapunte WHERE apunte_id = ? AND permiso = 1)', [$idApunte]);
        $this->variables["modificadores"] = R::findAll('usuario', 'id IN (SELECT usuario_id FROM usuariointeractuaapunte WHERE apunte_id = ? AND permiso = 2)', [$idApunte]);
        $this->variables["permisores"] = R::findAll('usuario', 'id IN (SELECT usuario_id FROM usuariointeractuaapunte WHERE apunte_id = ? AND permiso = 3)', [$idApunte]);

        $misAlice = R::findAll('contacto', " bob_id=?", [$idUsuario]);
        $misBob = R::findAll('contacto', " alice_id=?", [$idUsuario]);
        foreach ($misAlice as $a) {
            $this->variables["contactos"][] = $a->fetchAs('usuario')->alice;
        }
        foreach ($misBob as $b) {
            $this->variables["contactos"][] = $b->fetchAs('usuario')->bob;
        }

        if (isset($this->variables["contactos"])) {
            usort($this->variables["contactos"], "cmp2");
        }

        return $this->variables;
    }

    public function misMensajes() {

        $this->setUpDatabase();

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $idContacto = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $contactos = R::getAll("SELECT usuario.* FROM usuario, mensaje WHERE usuario.id = receptor_id AND emisor_id = ? OR usuario.id = emisor_id AND receptor_id = ? GROUP BY usuario.id", [$idUsuario, $idUsuario]);

        $this->variables["contactos"] = R::convertToBeans("usuario", $contactos);
        $this->variables["mensajes"] = R::findAll('mensaje', ' receptor_id = ? AND emisor_id = ? OR emisor_id = ? AND receptor_id = ? ORDER BY fecha', [$idUsuario, $idContacto, $idUsuario, $idContacto]);
        $this->variables["contacto"] = R::findOne('usuario', ' id = ?', [$idContacto]);

        return $this->variables;
    }

    public function miConfiguracion() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $this->variables["usuario"] = R::findOne('usuario', " id=?", [$idUsuario]);
        $this->variables["universidades"] = R::findAll('universidad');
        if ($this->variables["usuario"]->carrera_id == NULL) {
            $this->variables["usuario"]->carrera = R::dispense('carrera');
            $this->variables["usuario"]->carrera->universidad = R::dispense('universidad');
        }
        if ($this->variables["usuario"]->direccion == NULL) {
            $this->variables["usuario"]->direccion = "";
        }
        R::close();
        return $this->variables;
    }

    public function misApuntes() {
        //porsiaca se filtra
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();

        $misapuntes = R::findAll('apunte', 'usuario_id = ?', [$idUsuario]);

        $this->variables["apuntes"] = $misapuntes;

        R::close();

        return $this->variables;
    }

    public function misApuntesFavoritos() {
        //porsiaca se filtra
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();

        $misapuntes = R::findAll('apunte', ' id IN (SELECT apunte_id FROM usuariointeractuaapunte WHERE usuario_id = ? AND favorito = 1)', [$idUsuario]);

        $this->variables["apuntes"] = $misapuntes;

        R::close();

        return $this->variables;
    }

    public function subirApuntes() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $this->variables["universidades"] = R::findAll('universidad');
        $this->variables["usuario"] = R::findOne("usuario", " id=?", [$idUsuario]);

        $misAlice = R::findAll('contacto', " bob_id=?", [$idUsuario]);
        $misBob = R::findAll('contacto', " alice_id=?", [$idUsuario]);
        foreach ($misAlice as $a) {
            $this->variables["contactos"][] = $a->fetchAs('usuario')->alice;
        }
        foreach ($misBob as $b) {
            $this->variables["contactos"][] = $b->fetchAs('usuario')->bob;
        }

        if (isset($this->variables["contactos"])) {
            usort($this->variables["contactos"], "cmp2");
        }
        R::close();
        return $this->variables;
    }

    public function perfilUsuario() {
        $currentUser = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $this->variables["usuario"] = R::findOne('usuario', ' (privacidadperfil = 1 OR id IN (SELECT bob_id FROM contacto WHERE alice_id = ?) OR id IN (SELECT alice_id FROM contacto WHERE bob_id = ?)) AND id = ?', [$currentUser, $currentUser, $idUsuario]);
        $this->variables["apuntes"] = R::findAll('apunte', ' usuario_id = ? AND (permisovisualizacion = 2 OR id IN (SELECT apunte_id FROM usuariointeractuaapunte WHERE usuario_id = ? AND permiso != 0))', [$idUsuario, $currentUser]);

        $this->variables["currentuser"] = $currentUser;
        $this->variables["idUsuario"] = $idUsuario;

        $this->variables["sonAmigos"] = $this->sonAmigos($currentUser, $idUsuario);

        R::close();
        return $this->variables;
    }

    private function sonAmigos($currentUser, $idUsuario) {

        $contacto = R::findOne('contacto', ' (alice_id = ? AND bob_id = ? OR bob_id = ? AND alice_id = ?) AND admitido = 1', [$currentUser, $idUsuario, $currentUser, $idUsuario]);

        return $contacto != null || $currentUser == $idUsuario;
    }

    public function verApunte() {
        try {
            $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
            $idApunte = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

            $this->setUpDatabase();

            $apunte = R::load('apunte', $idApunte);
            $usuario = R::load('usuario', $idUsuario);

            if ($apunte->usuario_id != $usuario->id) {

                $interaccion = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $idApunte]);

                if ($interaccion == null) {

                    $interaccion = R::dispense('usuariointeractuaapunte');

                    $interaccion->usuario_id = $idUsuario;
                    $interaccion->apunte_id = $idApunte;
                    $interaccion->visto = 1;
                    $apunte->visualizaciones++;

                    R::store($interaccion);
                    R::store($apunte);
                } else if ($interaccion->visto == 0) {

                    $interaccion->visto = 1;
                    $apunte->visualizaciones++;

                    R::store($interaccion);
                    R::store($apunte);
                }

                $this->variables["interaccion"] = $interaccion;
            }

            $this->variables["apunte"] = $apunte;
            $this->variables["comentarios"] = R::findAll('comentarioapunte', 'apunte_id = ? ORDER BY fecha DESC', [$idApunte]);

            R::close();
            return $this->variables;
        } catch (Exception $e) {
            $this->errorPage();
        }
    }

    public function recomendados() {

        //Sobre este usuario hare la insersion de nuevos 
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        //Conectamos a la base de datos
        $this->setUpDatabase();

        //Obtenemos el usuario asociado al idUsuario
        $usuario = R::load('usuario', $idUsuario);


        //Obtenemos la lista de contactos(alice)
        $alice = $usuario->alias('alice')->ownContactoList;
        //Obtenemos la lista de contactos(bob)
        $bob = $usuario->alias('bob')->ownContactoList;

        $miscontactos = array();

        //Recorremos la lista de alice para obtener sus bobs
        foreach ($alice as $a) {

            //Obtenemos un amigo de alice(bob)
            $contacto = $a->fetchAs('usuario')->bob;
            //Guardamos en el array el contacto
            $miscontactos[$contacto->id] = $contacto;
        }
        //Recorremos la lista de bob para obtener sus alices
        foreach ($bob as $b) {

            //Obtenemos un amigo de alice(bob)
            $contacto = $b->fetchAs('usuario')->alice;
            //Guardamos en el array el contacto
            $miscontactos[$contacto->id] = $contacto;
        }


        //Recorremos cada contacto
        //array con los amigos de mis amigos
        $contactosAmigos = array();

        foreach ($miscontactos as $contacto) {
            //Obtenemos la lista de contactos(alice)
            $alice2 = $contacto->alias('alice')->ownContactoList;
            //Obtenemos la lista de contactos(bob)
            $bob2 = $contacto->alias('bob')->ownContactoList;


            //Recorremos la lista de alice para obtener sus bobs
            foreach ($alice2 as $a) {

                //Obtenemos un amigo de alice(bob)
                $contactoA = $a->fetchAs('usuario')->bob;
                //Guardamos en el array el contacto
                if (!isset($contactosAmigos[$contactoA->id]) && $contactoA->id != $idUsuario) {
                    $contactosAmigos[$contacto->id] = $contactoA;
                }
            }

            //Recorremos la lista de bob para obtener sus alices
            foreach ($bob2 as $b) {

                //Obtenemos un amigo de alice(bob)
                $contactoB = $b->fetchAs('usuario')->alice;
                //Guardamos en el array el contacto
                if (!isset($contactosAmigos[$contactoB->id]) && $contactoB->id != $idUsuario) {
                    $contactosAmigos[$contacto->id] = $contactoB;
                }
            }
        }

        //Recorrer los elementos del contacto para saber cuales no tiene
        //si son distintos los guardo
        $this->variables["contactosUsuario"] = array();

        foreach ($contactosAmigos as $contacto) {

            if (!isset($miscontactos[$contacto->id])) {

                $this->variables["contactosUsuario"][$contacto->id] = $contacto;
            }
        }


        //Cerramos conexioon
        R::close();

        return $this->variables;
    }

    public function peticiones() {

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $this->variables["peticiones"] = R::findAll("contacto", "bob_id = ? AND admitido = 0 ORDER BY fecha DESC", [$idUsuario]);

        return $this->variables;
    }

    public function universidades() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');

        R::close();

        return $this->variables;
    }

    public function universidad() {

        $this->setUpDatabase();

        if (!isset($_GET["id"])) {

            $this->variables["universidad"] = R::dispense('universidad');
            $this->variables["carreras"] = $this->variables["universidad"]->ownCarreraList;
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $this->variables["universidad"] = R::findOne('universidad', ' id = ?', [$id]);
            $this->variables["carreras"] = R::findAll('carrera', ' universidad_id = ? ORDER BY rama, nombre ASC', [$id]);
        }

        $this->variables["ramas"] = array(array("Artes y humanidades", "fa-paint-brush"), array("Ciencias", "fa-rocket"), array("Ciencias de la salud", "fa-user-md"), array("Ingeniería y arquitectura", "fa-cogs"), array("Ciencias sociales y jurídicas", "fa-gavel"));
        R::close();
        return $this->variables;
    }

    public function carrera() {

        $this->setUpDatabase();

        if (!isset($_GET["id"])) {

            $this->variables["carrera"] = R::dispense('carrera');
            $this->variables["asignaturas"] = $this->variables["carrera"]->ownAsignaturaList;
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $this->variables["carrera"] = R::findOne('carrera', ' id = ?', [$id]);
            $this->variables["asignaturas"] = R::findAll('asignatura', ' carrera_id = ? ORDER BY curso, nombre ASC', [$id]);
        }

        R::close();
        return $this->variables;
    }

    public function asignatura() {

        $this->setUpDatabase();

        if (!isset($_GET["id"])) {

            $this->variables["asignatura"] = R::dispense('asignatura');
            $this->variables["apuntes"] = $this->variables["carrera"]->ownApunteList;
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $this->variables["asignatura"] = R::findOne('asignatura', ' id = ?', [$id]);
            $this->variables["apuntes"] = R::findAll('apunte', ' asignatura_id = ? ORDER BY titulo ASC', [$id]);
        }

        R::close();
        return $this->variables;
    }

    public function notFound() {
        $this->setUpDatabase();
        R::close();
        return $this->variables;
    }

    private function cargarComunes() {

        $this->variables["usuario-actual"] = R::load('usuario', $_SESSION["idUsuario"]);
        $this->variables["n-peticiones"] = R::count('contacto', ' bob_id = ? AND admitido = 0', [$_SESSION["idUsuario"]]);

        if ($this->variables["usuario-actual"]->carrera_id == "" || $this->variables["usuario-actual"]->email == "") {
            $_SESSION["error"] = "Su perfil no contiene toda la información necesaria para mostrar toda la funcionalidad de apuntea. Por favor, entra en \"Mi configuración\" para completar tu perfil";
        }
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        $this->cargarComunes();
    }

    private function errorPage() {
        $_SESSION["error"] = "ERROR inesperado.";
        header("location: inicio.php");
        exit();
    }

}

function cmp2($a, $b) {
    if ($a->nombre == $b->nombre) {
        return 0;
    }
    return ($a->nombre < $b->nombre) ? -1 : 1;
}
