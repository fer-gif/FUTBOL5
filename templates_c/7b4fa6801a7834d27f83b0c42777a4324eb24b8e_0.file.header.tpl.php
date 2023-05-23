<?php
/* Smarty version 4.3.1, created on 2023-05-23 02:48:06
  from 'C:\xampp\htdocs\FUTBOL5\templates\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_646c0d46ca0585_85555281',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b4fa6801a7834d27f83b0c42777a4324eb24b8e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\FUTBOL5\\templates\\header.tpl',
      1 => 1684800848,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_646c0d46ca0585_85555281 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/css/estilos.css">
    <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/home">HOME</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/equipos">EQUIPOS</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/fixture">FIXTURE</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/estadisticas">ESTADISTICAS</a></li>
                <?php if ($_smarty_tpl->tpl_vars['user']->value) {?>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/miequipo">MI EQUIPO</a></li>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['admin']->value) {?>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/admin">GESTION</a></li>
                <?php }?>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
/login">LOGIN</a></li>
            </ul>
        </nav>
    </header><?php }
}
