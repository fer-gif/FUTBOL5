<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{$base}/css/estilos.css">
    <title>{$titulo}</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="{$base}/home">HOME</a></li>
                <li><a href="{$base}/equipos">EQUIPOS</a></li>
                <li><a href="{$base}/jugador/todos">JUGADORES</a></li>
                {if $capitan}
                <li><a href="{$base}/miequipo">MI EQUIPO</a></li>
                {/if}
                {if $admin}
                <li><a href="{$base}/fixture">FIXTURE</a></li>
                <li><a href="{$base}/admin">GESTION</a></li>
                {/if}
                {if !$admin && !$capitan}
                <li><a href="{$base}/login">LOGIN</a></li>
                {else}
                <li><a href="{$base}/login/logout">LOGOUT</a></li>
                {/if}
            </ul>
        </nav>
    </header>