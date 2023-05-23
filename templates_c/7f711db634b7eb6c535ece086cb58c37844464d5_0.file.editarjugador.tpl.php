<?php
/* Smarty version 4.3.1, created on 2023-05-22 21:57:38
  from 'C:\xampp\htdocs\FUTBOL5\templates\editarjugador.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_646bc9327b6685_56847243',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f711db634b7eb6c535ece086cb58c37844464d5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\FUTBOL5\\templates\\editarjugador.tpl',
      1 => 1684785454,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_646bc9327b6685_56847243 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
    <h1>Editar datos del jugador</h1>
    <form action="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/jugador/update/<?php echo $_smarty_tpl->tpl_vars['jugador']->value->getIdJugador();?>
" method="POST" class="formEditar">
        <label for="posicion">Posicion</label>
        <input type="text" name="posicion" id="" value="<?php echo $_smarty_tpl->tpl_vars['jugador']->value->getPosicion();?>
">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="" value="<?php echo $_smarty_tpl->tpl_vars['jugador']->value->getNombre();?>
">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="" value="<?php echo $_smarty_tpl->tpl_vars['jugador']->value->getApellido();?>
">
        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
