<?php

require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorUsuario {
    /* GUARDAMOS TODAS LAS VARIABLES A UTILIZAR */

    private $variables = array();

    public function __construct() {
        $this->cargarComunes();
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

    //Publico
    public function misContactos() {

        /*

         * Obteneer el id de usuario !Cuando recogemos variables del array
         * hay que filtrar(seguridad)
         * filter_var 
         * 
         * filter_input: array globales (no usua session)
         * 
         * ->Te lo convierte a entero con el filter
         * para cadenas el magic_quoute!
         *          */

        /* filtramos 
          $_SESSION["idUsuario"]; -> nos pueden meter mierda,
         * por lo que filtramos y lo convertimos 
         *          */

        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);


        /*
         * Nos conectamos llamando a la funcion Setup...
         * Recogmoes contactos con ese id */

        $this->setUpDatabase();


        //Creamos indce contactos en este array para ir metiendo datos 
        /*
          Comillas dobles interpreta variables ! ojo
         * 
         * 
         *         */

        //Obtenemos el usuario asociado al idUsuario
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

        //Recorremos la lista de bob para obtener sus alices
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

    private function cmp($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }

   

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
