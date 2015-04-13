<?php ob_start(); ?>

<div class="col-9" id="principal">
    
    <div>
        <fieldset>
            <legend>Datos personales: </legend>
            Nombre completo: <Strong> Nombre y apellidos del usuario</Strong>   <input type="text" name="nombre" size="30"> <br>
            E-mail:          <Strong> e-mail del usuario</Strong>               <input type="text" name="email" size="30"> <br>
            Dirección:       <Strong>Calle falsa 123</Strong>                   <input type="text" name="direccion" size="60"> <br>
            Universidad:     <Strong>Universidad en la que estudia</Strong>     <input type="text" name="universidad" size="30"> <br>
            Imagen de perfil: <img src="../img/carnet.PNG"  id="foto-user">     <input type="image" value="Subir nueva imagen">  <br>
            
        </fieldset>
        
        
    </div>
    <br>
    <div>
        <fieldset>
            <legend>Privacidad: </legend>
            ¿Quién puede ver mi perfil? <br>
            <input type="radio" name="visibilidad" value="Todo el mundo" checked="checked"/> Todo el mundo
            <input type="radio" name="visibilidad" value="Solo amigos" checked="checked"/> Solo mis amigos
            <hr>
            ¿Quién puede ver mi actividad? <br>
            <input type="radio" name="visibilidad" value="Todo el mundo" checked="checked"/> Todo el mundo
            <input type="radio" name="visibilidad" value="Solo amigos" checked="checked"/> Solo mis amigos
            <hr>
            ¿Quién puede ver mi perfil? <br>
            <input type="radio" name="visibilidad" value="Todo el mundo" checked="checked"/> Todo el mundo
            <input type="radio" name="visibilidad" value="Solo amigos" checked="checked"/> Solo mis amigos
        </fieldset>
        
    </div>
    <br>
    <div>
     <input type="submit" name="actualizar" value="Enviar">
    </div>
</div>

<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";