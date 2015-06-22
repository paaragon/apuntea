<?php


class Cascade {

  
    public function borrarCarreraCascade($idCarrera) {
        
        $carrera = R::load('carrera', $idCarrera);
        $asig = $carrera->ownAsignaturaList;
        foreach ($asig as $a) {
            borrarAsignaturaCascada($a->id);
        }

        $usu = $carrera->ownUsuarioList;
        //no estoy seguro de si esto cuela, en teoria deberia porque aqui ya es un bean
        //si no cuela hay que hacer un store
        foreach ($usu as $u) {
            $u->carrera_id = NULL;
        }

        R::trash($carrera);
        
    }

    public function borrarApunteCascade($idApunte) {
        
        //borrar interactuacion
        $interactuacion = R::find('usuariointeractuaapunte', 'apunte_id= :idapunte', array(':idapunte' => $idApunte));
        R::trashAll($interactuacion);
        //borrar apuntegrupo
        $apuntegrupo = R::find('apuntegrupo', 'apunte_id= :idapunte', array(':idapunte' => $idApunte));
        R::trashAll($apuntegrupo);
        //borrar peticion
        $peticion = R::find('peticionapunte', 'apunte_id= :idapunte', array(':idapunte' => $idApunte));
        R::trashAll($peticion);
        //borrar comentarios
        $comentario = R::find('comentarioapunte', 'apunte_id= :idapunte', array(':idapunte' => $idApunte));
        R::trashAll($comentario);
        //borrar apunte
        $apunte = R::load('apunte', $id);

        R::trash($apunte);
        
    }

    public function borrarUniversidadCascade($idUniversidad) {
        $this->setUpDatabase();
        $universidad = R::load('universidad', $idUniversidad);
        $car = $universidad->ownCarreraList;
        foreach ($car as $c) {
            borrarCarreraCascada($c->id);
        }
        R::trash($universidad);
        R::close();
    }

    public function borrarAsignaturaCascade($idAsignatura) {
        $this->setUpDatabase();
        $asignatura = R::load('asignatura', $idAsignatura);
        $apuntes = $asignatura->ownApunteList;
        foreach ($apuntes as $a) {
            borrarApunteCascada($a->id);
        }
        R::trash($asignatura);
        R::close();
    }

    public function borrarUsuarioCascade($idUsuario) {
        
        $usuario = R::load('usuario', $idUsuario);
        //mensajes del usuario
        $mensaje = R::find('mensaje', 'emisor_id = :usuario or receptor_id = :usuario', array(':usuario' => $idUsuario));
        R::trashAll($mensaje);
        //contactos del usuario
        $contactos = R::find('contacto', 'bob_id = :usuario or alice_id = :usuario', array(':usuario' => $idUsuario));
        R::trashAll($contactos);
        //grupos
        $grupos = R::find('usuariogrupo', 'usuario_id = ?', [$idUsuario]);
        R::trashAll($grupos);
        //comentarios en grupos
        $comentarios = R::find('comentariogrupo', 'usuario_id = ?', [$idUsuario]);
        R::trashAll($comentarios);
        //interactuaciones
        $inter = R::find('usuariointeractuaapunte', 'usuario_id = ?', [$idUsuario]);
        R::trashAll($inter);
        //apuntes del usuario
        $apunte=R::find('apunte', 'usuario_id = ?', [$idUsuario]);
        R::trashAll($apunte);
        $peticiones=R::find('peticionapunte', 'usuario_id = ?', [$idUsuario]);
        R::trashAll($peticiones);
        //comentarios en apuntes
        $comentariosapuntes=R::find('comentarioapunte', 'usuario_id = ?', [$idUsuario]);
        R::trashAll($comentariosapuntes);

//	-Borra el usuario
        R::trash($usuario);
       
    }

    public function borrarGrupoCascade($idGrupo) {
        $this->setUpDatabase();
        $grupo = R::load('grupo', $idGrupo);
        //borrar comentarios
        $comentario = R::find('comentariogrupo', 'grupo_id= :idgrupo', array(':idgrupo' => $idGrupo));
        R::trashAll($comentario);
        //borrar usuarios del grupo
        $usuario = R::find('usuariogrupo', 'grupo_id= :idgrupo', array(':idgrupo' => $idGrupo));
        R::trashAll($usuario);
        //borrar apuntes de grupo
        $apunte = R::find('apuntegrupo', 'grupo_id= :idgrupo', array(':idgrupo' => $idGrupo));
        R::trashAll($apunte);
//	-Borra el grupo
        R::trash($grupo);
        R::close();
    }

}
