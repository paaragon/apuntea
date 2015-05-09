<?php

require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorUsuario {
    /* GUARDAMOS TODAS LAS VARIABLES A UTILIZAR */

    private $variables = array();

    public function __construct() {
        $this->cargarComunes();
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

     private function cmp($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }
    
    
    public function misContactosReco() {

        //Sobre este usuario hare la insersion de nuevos 
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        //Conectamos a la base de datos
        $this->setUpDatabase();

        //Obtenemos el usuario asociado al idUsuario
        $usuario = R::load('usuario', $idUsuario);

        $alice = $usuario->alias('alice')->ownContactoList; //Lista donde yo soy alice (para comprobar quienes son mis bobs)
        $bob = $usuario->alias('bob')->ownContactoList; //Lista donde yo soy bob (para comprobar quienes son mis alices)
        //contactos Amigos de Amigos
        $contactosAA = array();

        $contactosAA = array_merge($contactosAA, $this->getAmigosDeMisBob($alice, $idUsuario));
        $contactosAA = array_merge($contactosAA, $this->getAmigosDeMisAlice($bob, $idUsuario));

        var_dump($contactosAA);

        R::close();
    }

    private function getAmigosDeMisBob($alice, $idUsuario) {

        //array con los amigos de mis alices
        $contactosAA = array();

        foreach ($alice as $a) { //recorro los contactos donde yo soy alice
            $micontacto = $a->fetchAs('usuario')->bob; //recojo mis bobs

            //alice Amigo de Amigo
            $aliceAA = $micontacto->alias('alice')->ownContactoList; //Contacto donde mis bobs son alice
            //bob Amigo de Amigo
            $bobAA = $micontacto->alias('bob')->ownContactoList; //Contactos donde mis bobs son bobs

            foreach ($aliceAA as $aAA) { //recorro todos los contactos donde mis bobs son alices
                $contacto = $aAA->fetchAs('usuario')->bob;

                if (isset($contactosAA[$contacto->nombre]) && $contacto->id != $idUsuario) {
                    $contactosAA[$contacto->nombre] ++;
                } else if ($contacto->id != $idUsuario) {
                    $contactosAA[$contacto->nombre] = 1;
                }
            }

            foreach ($bobAA as $bAA) {//recorro todos contactos donde mis bobs son bobs
                $contacto = $bAA->fetchAs('usuario')->alice;

                if (isset($contactosAA[$contacto->nombre]) && $contacto->id != $idUsuario) {
                    $contactosAA[$contacto->nombre] ++;
                } else if ($contacto->id != $idUsuario) {
                    $contactosAA[$contacto->nombre] = 1;
                }
            }
        }

        return $contactosAA;
    }

    private function getAmigosDeMisAlice($bob, $idUsuario) {
        
        //array con los amigos de mis alices
        $contactosAA = array();

        foreach ($bob as $b) {//recorro los contactos donde yo soy bob

            $micontacto = $a->fetchAs('usuario')->alice;//recojo mis alices

            //alice Amigo de Amigo
            $aliceAA = $micontacto->alias('alice')->ownContactoList;//Contacto donde mis alices son alice
            //bob Amigo de Amigo
            $bobAA = $micontacto->alias('bob')->ownContactoList;//Contacto donde mis alices son bob

            foreach ($aliceAA as $aAA) {//recorro todos los contactos donde mis alices son alices
                $contacto = $aAA->fetchAs('usuario')->bob;

                if (isset($contactosAA[$contacto->nombre]) && $contacto->id != $idUsuario) {
                    $contactosAA[$contacto->nombre] ++;
                } else if ($contacto->id != $idUsuario) {
                    $contactosAA[$contacto->nombre] = 1;
                }
            }

            foreach ($bobAA as $bAA) {//recorro todos los contactos donde mis alices son bob
                $contacto = $bAA->fetchAs('usuario')->alices;

                if (isset($contactosAA[$contacto->nombre]) && $contacto->id != $idUsuario) {
                    $contactosAA[$contacto->nombre] ++;
                } else if ($contacto->id != $idUsuario) {
                    $contactosAA[$contacto->nombre] = 1;
                }
            }
        }
        return $contactosAA;
    }

   

    private function cargarComunes() {
        
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
