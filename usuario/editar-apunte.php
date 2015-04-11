<?php ob_start(); ?>
<div id="head-apunte">
    <span class="col-7">
        <a href="#">[Universidad]</a> / 
        <a href="#">[Carrera]</a> /
        <a href="#">[Asignatura]</a>
    </span>
    <span class="col-1"><a href="#" data-toggle="modal" data-target="#permisosModal"><span class="fa fa-key"></span> Permisos</a></span>
    <span class="col-1"><a href="ver-apunte-propio.php"><span class="fa fa-floppy-o"></span> Guardar</a></span>
    <span class="col-1"><a href="ver-apunte-propio.php"><span class="fa fa-times"></span> Cancelar</a></span>
    <div class="clear"></div>
</div>
<div id="contenido-apunte">
    <textarea id="area-apunte">


Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu. Vestibulum neque elit, convallis quis fringilla at, aliquam nec nibh. Quisque eu magna quis sapien feugiat porttitor. Duis rutrum enim eu leo venenatis, id lobortis lectus ultrices. Nam orci est, euismod vel nibh a, commodo aliquam odio. Aliquam dapibus nibh in nunc porttitor ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;

Aenean lacinia in tellus sed luctus. Phasellus faucibus nibh sed risus pellentesque rutrum. Maecenas rhoncus justo lectus, sit amet efficitur neque posuere sed. Maecenas efficitur metus faucibus, finibus est et, varius ex. Cras enim lacus, facilisis a tortor vitae, varius viverra lacus. Donec placerat bibendum elit, convallis ullamcorper dolor tincidunt vitae. Sed ornare venenatis sem ac semper. Quisque sit amet nisl in purus consectetur venenatis rhoncus vel magna.

Maecenas auctor metus vel nulla tempor aliquet. In at lacinia nisi. Ut vehicula nulla nisi. Proin in bibendum metus. Sed tempus turpis quis elit porttitor pulvinar. Maecenas consectetur velit quis quam bibendum, id hendrerit metus imperdiet. Nunc auctor eu sapien quis aliquam. Pellentesque quis tortor ante. Nam fermentum ac risus eu lobortis.

Nam euismod vestibulum erat non pharetra. Morbi imperdiet eu dui ac porttitor. Integer semper turpis et libero dictum, eget fermentum orci scelerisque. Aliquam scelerisque est risus, vel vestibulum massa luctus in. Nullam aliquam auctor leo, vitae laoreet odio iaculis a. Suspendisse molestie pharetra tortor, vel feugiat lectus commodo nec. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur luctus mauris ut lorem condimentum sodales. Ut ultrices enim eu auctor maximus. Pellentesque at lacus imperdiet metus pretium vehicula. Nulla commodo risus sit amet massa egestas suscipit eget et ante.

Sed non eros justo. Duis quis tellus leo. Phasellus dapibus imperdiet ultricies. Nullam ac semper nisi. Sed ac lectus a leo bibendum dapibus malesuada in sem. Maecenas a ultrices risus. Aliquam sed lacinia dolor. Fusce ut tincidunt eros. Maecenas id elit nulla. Aenean sit amet lacinia metus, vitae tincidunt arcu. 
    </textarea>
</div>
<!-- Modal -->
<div class="modal fade" id="permisosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Permisos</h4>
            </div>
            <div class="modal-body">
                <div>
                    <strong class="col-3">Lectura:</strong>
                    <span class="col-3">
                        <input type="radio" name="lectura" checked> Privado<br>
                        <input type="radio" name="lectura"> Público
                    </span>
                    <span class="col-3">
                        <strong>Lectores:</strong>&nbsp;&nbsp;&nbsp;<a href="#"><span class="fa fa-plus"></span></a>
                        <ul>
                            <li>[Usuario]</li>
                            <li>[Grupo]</li>
                            <li>[Usuario]</li>
                        </ul>
                    </span>
                    <div class="clear"></div>
                </div>
                <br>
                <div>
                    <strong class="col-3">Escritura</strong>
                    <span class="col-4">
                        <strong>Usuarios:</strong>&nbsp;&nbsp;&nbsp;<a href="#"><span class="fa fa-plus"></span></a>
                        <ul>
                            <li>[Usuario]</li>
                            <li>[Usuario]</li>
                            <li>[Usuario]</li>
                        </ul>
                    </span>
                    <span class="col-4">
                        <strong>Grupos:</strong>&nbsp;&nbsp;&nbsp;<a href=""><span class="fa fa-plus"></span></a>
                        <ul>
                            <li>Grupo</li>
                            <li>Grupo</li>
                        </ul>
                    </span>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
