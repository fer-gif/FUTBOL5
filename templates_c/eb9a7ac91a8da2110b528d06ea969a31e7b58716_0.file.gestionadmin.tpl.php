<?php
/* Smarty version 4.3.1, created on 2023-05-23 23:10:14
  from 'C:\xampp\htdocs\FUTBOL5\templates\gestionadmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_646d2bb65db4f2_66351658',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb9a7ac91a8da2110b528d06ea969a31e7b58716' => 
    array (
      0 => 'C:\\xampp\\htdocs\\FUTBOL5\\templates\\gestionadmin.tpl',
      1 => 1684876212,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_646d2bb65db4f2_66351658 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="registroEquipo">
    <h3>Registrar equipo</h3>
    <form action="registrarequipo" method="post" class="formEditar">
        <label for="nombreEquipo">Nombre del equipo</label>
        <input type="text" name="nombreEquipo" id="">
        <input type="submit" value="Registrar" class="btnEditar">
    </form>
</div>
<!--ALTA DE USUARIOS-->

<div class="registroEquipo">
    <h3>Registrar un nuevo jugador</h3>
    <form action="" class="formEditar">

        <label for="equipo">Seleccione equipo</label>
        <select name="equipo" id="">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['equipos']->value, 'equipo');
$_smarty_tpl->tpl_vars['equipo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['equipo']->value) {
$_smarty_tpl->tpl_vars['equipo']->do_else = false;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['equipo']->value->getIdEquipo();?>
"><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getNombre();?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>

        <label for="nombreJugador">Nombre</label>
        <input type="tel" name="nombreJugador" id="">
        <label for="apellidoJugador">Apellido</label>
        <input type="tel" name="apellidoJugador" id="">
        <label for="dni">DNI</label>
        <input type="number" name="dni" id="">
        <select name="posicion" id="">
            <option value="POR">Arquero</option>
            <option value="DEF">Defensor</option>
            <option value="MED">Mediocampista</option>
            <option value="DEL">Delantero</option>
        </select>
        <input type="submit" value="Registrar" class="btnEditar">
    </form>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
