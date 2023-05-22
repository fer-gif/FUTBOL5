<?php
/* Smarty version 4.3.1, created on 2023-05-22 16:10:11
  from 'C:\xampp\htdocs\FUTBOL5\templates\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_646b77c35efe99_33726524',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a90d5393c17690ca55ad7f722085948f6ec15462' => 
    array (
      0 => 'C:\\xampp\\htdocs\\FUTBOL5\\templates\\home.tpl',
      1 => 1684764530,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_646b77c35efe99_33726524 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
    <table class="tablaPosiciones">
        <thead class="theadPosiciones">
            <th>Pos</th>
            <th>Equipo</th>
            <th>Pts</th>
            <th>PJ</th>
            <th>PG</th>
            <th>PE</th>
            <th>PP</th>
            <th>GF</th>
            <th>GC</th>
        </thead>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['equipos']->value, 'equipo');
$_smarty_tpl->tpl_vars['equipo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['equipo']->value) {
$_smarty_tpl->tpl_vars['equipo']->do_else = false;
?>
        <tr class="filaTablaPosicion">
            <td>Pos</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getNombre();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getPuntos();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getPJ();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getPG();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getPE();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getPP();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getGF();?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equipo']->value->getGC();?>
</td>

        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
</main>
<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
