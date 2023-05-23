<?php
/* Smarty version 4.3.1, created on 2023-05-22 22:07:39
  from 'C:\xampp\htdocs\FUTBOL5\templates\equipo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_646bcb8bd37761_33507812',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '977f64b4412322f7f81ab62429bc9ac5446a043f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\FUTBOL5\\templates\\equipo.tpl',
      1 => 1684786056,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_646bcb8bd37761_33507812 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
    <table class="tablaPosiciones">
        <h2 class="nombreEquipo"><?php echo $_smarty_tpl->tpl_vars['nombreEquipo']->value;?>
</h2>
        <thead class="theadPosiciones">
            <th>Pos</th>
            <th>Nombre</th>
            <th>Apellido</th>
        </thead>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jugadores']->value, 'jugador');
$_smarty_tpl->tpl_vars['jugador']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['jugador']->value) {
$_smarty_tpl->tpl_vars['jugador']->do_else = false;
?>
        <tr class="filaTablaPosicion">
            <td><?php echo $_smarty_tpl->tpl_vars['jugador']->value->getPosicion();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['jugador']->value->getNombre();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['jugador']->value->getApellido();?>
</td>
            <?php if ($_smarty_tpl->tpl_vars['user']->value) {?>
            <td>
                <div class="iconos">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/jugador/editar/<?php echo $_smarty_tpl->tpl_vars['jugador']->value->getIdJugador();?>
"><img
                            src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/image/iconseditar.png"></a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/jugador/eliminar/<?php echo $_smarty_tpl->tpl_vars['jugador']->value->getIdJugador();?>
"><img
                            src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/image/iconsBorrar.png"></a>
                </div>
            </td>
            <?php }?>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
</main>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
