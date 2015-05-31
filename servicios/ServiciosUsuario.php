<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ServiciosUsuario {

	public function anadirComentarioGrupo($parametros){
		
		$this->setUpDatabase();
		
		$idGrupo = $parametros["idGrupo"];
		$idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
		$fecha = strtotime('now');
		$texto = filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_MAGIC_QUOTES);
       
	   
        $comentario = R::dispense('comentariogrupo');
        
        $comentario->fecha = $fecha;
		$comentario->usuario_id = $idUsuario;
		$comentario->idGrupo = $idGrupo;
		$comentario->texto = $texto;
        try {
            R::store($comentario);
            $_SESSION["exito"] = "Comentario publicado";
            $return = " usuario/ver-grupo?id=" . $idGrupo;
        } catch (Exception $e) {
            $_SESSION["error"] = "Error al publicar el comentario";
            $return = " usuario/ver-grupo?id=" . $idGrupo;
        }
        R::close();
        return $return;
        //Añadimos la carrera
	}

    public function __construct() {
        apunteaSec\checkUsuario();
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
