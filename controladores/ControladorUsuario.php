<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorUsuario {

    private $variables = array();

    public function __construct() {
        apunteaSec\checkUsuario();
    }

    public function inicio() {
        $this->setUpDatabase();
        R::close();
        return $this->variables;
    }

    public function resultadoBusqueda() {

        $busqueda = filter_var($_POST["busqueda"], FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();

        //apuntes por etiquetas, carreras, asignaturas, universidaddes y usuarios (grupos con visibilidad para mi o total)
        $resultadosapuntes = R::exec('SELECT * FROM apunte,etiquetaapunte,etiqueta WHERE etiqueta.titulo=' . $busqueda .
                        ' AND etiquetaapunte.id=etiqueta.id AND apunte.id=etiquetaapunte.apunte_id');

        $this->variables["apuntes"] = $resultadosapuntes;

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
        usort($this->variables["contactosUsuario"], array("self", "cmp"));

        //Cerramos conexioon
        R::close();

        //Devolvemos con contenido
        return $this->variables;
    }

    public function editarApunte() {

        $this->setUpDatabase();

        $idApunte = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->variables["apunte"] = R::findOne("apunte", ' id = ? AND (usuario_id = ? OR id IN (SELECT apunte_id FROM usuariointeractuaapunte WHERE usuario_id = ?))', [$idApunte, $idUsuario, $idUsuario]);

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

    public function subirApuntes() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $this->variables["universidades"] = R::findAll('universidad');
        $misAlice = R::findAll('contacto', " bob_id=?", [$idUsuario]);
        $misBob = R::findAll('contacto', " alice_id=?", [$idUsuario]);
        $this->variables["usuario"] = R::findOne("usuario", " id=?", [$idUsuario]);
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

    private function cmp($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }

    private function cargarComunes() {

        $this->variables["usuario-actual"] = R::load('usuario', $_SESSION["idUsuario"]);

        if ($this->variables["usuario-actual"]->carrera_id == "" || $this->variables["usuario-actual"]->email == "") {
            $_SESSION["error"] = "Su perfil no contiene toda la información necesaria para mostrar toda la funcionalidad de apuntea. Por favor, entra en \"Mi configuración\" para completar tu perfil";
        }
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        $this->cargarComunes();
    }

}

function cmp2($a, $b) {
    if ($a->nombre == $b->nombre) {
        return 0;
    }
    return ($a->nombre < $b->nombre) ? -1 : 1;
}
