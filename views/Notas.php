<?php
//Creado por Ray para guardar notas de algunas formas de hacer algo en php

//<textarea><?php echo ($cb->__toString()); ? ></textarea>




?>

<?php
    //Para crear un combobox de la base de datos
    $dTEstado = new dataTable("SELECT Codigo, Descripcion FROM catalogo where catalogo = 'Estado'");
    $Estado = new comboBox("Estado", $dTEstado );
    $Estado->setValue($usuario->Estado);
    $Estado->display();
    //------------------------------------------------------------
    $td = new dataTable("SELECT Codigo, Descripcion FROM catalogo where catalogo = 'TipoUsuario'");
                                    $cb = new comboBox("Tipo", $td );
                                    $cb->setValue($usuario->Tipo);
                                    echo ($cb->__toString());
                                    $cb->display();
?>

<?php
    //Para crear un Grid de la base de datos
    $sql="select * from usuario";
    $grid=new dataGrid(new dataTable($sql));
    $grid->noVisibles = array('Id', 'Clave');
    $grid->setRowAction('onclick','editar',array('Id'));
    $grid->display();

?>
