<?php
/* Smarty version 4.3.1, created on 2023-05-22 22:07:08
  from 'C:\xampp\htdocs\FUTBOL5\templates\equipos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_646bcb6c54e262_05733219',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ea7e740a64633a2d9ea13d4cf73f1afd01ba0ae' => 
    array (
      0 => 'C:\\xampp\\htdocs\\FUTBOL5\\templates\\equipos.tpl',
      1 => 1684786024,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_646bcb6c54e262_05733219 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
    <div class="containerEquipos">
        <h1>Equipos</h1>
        <ul class="listaDeEquipos">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['equipos']->value, 'equipo');
$_smarty_tpl->tpl_vars['equipo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['equipo']->value) {
$_smarty_tpl->tpl_vars['equipo']->do_else = false;
?>
            <li><a href="equipo/ver/<?php echo $_smarty_tpl->tpl_vars['equipo']->value->getIdEquipo();?>
"><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getNombre();?>
</a>
                <?php if ($_smarty_tpl->tpl_vars['admin']->value) {?>
                <div class="iconos">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/equipo/editar/<?php echo $_smarty_tpl->tpl_vars['equipo']->value->getIdEquipo();?>
"><img
                            src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/image/iconseditar.png"></a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/equipo/eliminar/<?php echo $_smarty_tpl->tpl_vars['equipo']->value->getIdEquipo();?>
"><img
                            src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/image/iconsBorrar.png"></a>
                </div>
                <?php }?>
            </li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>
</main>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
