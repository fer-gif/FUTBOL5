<?php
/* Smarty version 4.3.1, created on 2023-05-19 17:25:35
  from 'C:\xampp\htdocs\FUTBOL5\templates\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_646794ef574305_48888591',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b4fa6801a7834d27f83b0c42777a4324eb24b8e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\FUTBOL5\\templates\\header.tpl',
      1 => 1684509930,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_646794ef574305_48888591 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="home">HOME</a></li>
                <li><a href="fixture">FIXTURE</a></li>
                <li><a href="goleadores">GOLEADORES</a></li>
                <li><a href="otros">OTROS</a></li>
            </ul>
        </nav>
    </header><?php }
}
