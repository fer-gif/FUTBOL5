{include file="header.tpl"}
<main>
    {include file="mensaje.tpl"}

    <h1>Editar datos del usuario</h1>
    <form action="{$base}/usuario/update/{$usuario->id_usuario}" method="POST" class="formEditar">
        <label for="usuario">Nombre</label>
        <input type="text" name="usuario" id="" value="{$usuario->usuario}">
        <label for="apellido">Email</label>
        <input type="text" name="email" id="" value="{$usuario->email}">
        <label for="permisos">Permisos</label>
        <select name="permisos" id="">
            <option value="0">Seleccione uno...</option>
            <option value="1">Usuario</option>
            <option value="3">Capitán</option>
            <option value="5">Administrador</option>
        </select>
        <label for="equipo">Equipo</label>
        <select name="equipo" id="">
            {foreach from=$equipos item=equipo}
            <option value="{$equipo->id_equipo}" {if $equipo->id_equipo == $usuario->id_equipo}
                selected
                {/if}
                >{$equipo->nombre}</option>
            {/foreach}
        </select>

        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>
{include file="footer.tpl"}