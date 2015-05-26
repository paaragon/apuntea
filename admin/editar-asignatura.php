<?php ob_start(); ?>

<div class="col-9">
    <h2>
        <span class="fa fa-file-text-o"></span> Editar asignatura
    </h2>
    <hr>
        <form action="asignatura.php" method="post">
            <label>Nombre:</label>
            <input type="text" name="nombre" required="" class="campo-formulario" placeholder="Introduce el nuevo nombre">
            <label>Universidad:</label>
            <select class="campo-formulario">
                <option value="[universidad]">[Universidad]</option>
                <option value="[universidad]">[Universidad]</option>
                <option value="[universidad]">[Universidad]</option>
                <option value="[universidad]">[Universidad]</option>
            </select>
            <label>Carrera:</label>
            <select class="campo-formulario">
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
                <option value="[carrera]">[Carrera]</option>
            </select>
            <input type="submit" value="Guardar cambios" class="campo-formulario">
        </form>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
