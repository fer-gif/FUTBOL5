<?php
/* Smarty version 4.3.1, created on 2023-05-22 16:10:25
  from 'C:\xampp\htdocs\FUTBOL5\templates\equipo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_646b77d1d4fa77_83914501',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '977f64b4412322f7f81ab62429bc9ac5446a043f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\FUTBOL5\\templates\\equipo.tpl',
      1 => 1684764489,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_646b77d1d4fa77_83914501 (Smarty_Internal_Template $_smarty_tpl) {
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
            <td>
                <div class="iconos">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/editarJugador/<?php echo $_smarty_tpl->tpl_vars['jugador']->value->getIdJugador();?>
"><img src="../image/iconseditar.png"></a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/eliminarJugador/<?php echo $_smarty_tpl->tpl_vars['jugador']->value->getIdJugador();?>
"><img
                            src="../image/iconsBorrar.png"></a>
                </div>
            </td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
</main>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
