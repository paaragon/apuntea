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
    
    public function nuevosContactos() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $usuario = R::load('usuario', $idUsuario);
        
        $this->variables["nuevosContactos"] = array();
       
       //Me han agregado
        $misBob = $usuario->alias('alice')->ownContactoList;
       //Yo he agregado
        $misAlice = $usuario->alias('bob')->ownContactoList;
        
        foreach($misBob as $b){
            if((time() - strtotime($b->fecha)) <= 86400000 ){ // <= 24 horas
                $contacto = $b->fetchAs('usuario')->bob;
                $this->variables["nuevosContactos"][$contacto->nombre] = $contacto;   
            }
        }
        
        foreach($misAlice as $a){
            if((time() - strtotime($a->fecha)) <= 86400000){ //= 24 horas
                $contacto = $a->fetchAs('usuario')->alice;
                $this->variables["nuevosContactos"][$contacto->nombre] = $contacto;
            }
        }  
        
        R::close();
        return $this->variables;
    }
    
    public function nuevosContactosGrupo() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $this->variables["nuevosContactosGrupo"] = array();
       
        $resultado = R::getAll( ' SELECT *
                                  FROM usuario, usuariogrupo
                                  WHERE TIMESTAMPDIFF(HOUR, NOW(), fecha) >= -24 and
                                  usuariogrupo.usuario_id != ? and usuario.id = usuariogrupo.usuario_id
                                  and usuariogrupo.grupo_id IN (SELECT usuariogrupo.grupo_id
                                                                FROM usuariogrupo
                                                                WHERE usuariogrupo.usuario_id = ?) ', [$idUsuario, $idUsuario]);
        
        $user = R::convertToBeans('usuario', $resultado);
                
      
       $this->variables["nuevosContactosGrupo"] = $user;   
        
        R::close();
        return $this->variables;
    }
    
    public function contactoAnadeApunte() {
        //Todos los apuntes
        $this->variables["apuntes"] = array();
        
        $apuntes = R::getAll( ' SELECT *
                                FROM apunte
                                WHERE TIMESTAMPDIFF(HOUR, NOW(), apunte.fecha) >= -24  
                            ' );
        
        $apunte = R::convertToBeans('apunte', $apuntes);      
      
       // $this->variables["apuntes"] = $apunte;
        
        $misAmigos = $this->variables["contactosUsuario"];
       
        foreach ($misAmigos as $a) {
            foreach($apunte as $ap) {
                if ($a->id = $ap->usuario_id) {
                    $this->variables["apuntes"] = $apunte;
                
                    $this->variables["amigos"] = $misAmigos;
                }
            }
        }
        
        
    }
   /* public function inicio() {
        /*
         * Modificaciones recientes de archivos
         * Saber si idUsuario está relacionado con algún apunte:  sus apuntes o apuntes grupo
         * Si es así --> 
         */
        
        //Nuevas subidas de amigos
        //nuevas subidas de archivos a tus grupos
        //Has sido añadido a x grupo
        
        
    /*}*/
    
    public function misContactos() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $usuario = R::load('usuario', $idUsuario);
      
        $misBob = $usuario->alias('alice')->ownContactoList;
        foreach ($misBob as $b) {
            $contacto = $b->fetchAs('usuario')->alice;
            $this->variables["contactosUsuario"][$contacto->nombre] = $contacto;
        }
        
        $misAlice = $usuario->alias('bob')->ownContactoList;
        foreach ($misAlice as $a) {
            $contacto = $a->fetchAs('usuario')->bob;
            $this->variables["contactosUsuario"][$contacto->nombre] = $contacto;
        }

        usort($this->variables["contactosUsuario"], array("self", "cmp"));

        R::close();
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
