{include file="header.tpl"}
<main>
    {include file="mensaje.tpl"}

    <h1>Editar datos del usuario</h1>
    <form action="{$base}/usuario/update/{$usuario->id_usuario}" method="POST" class="formEditar">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="" value="{$usuario->usuario}">
        <label for="apellido">Email</label>
        <input type="text" name="email" id="" value="{$usuario->email}">
        <label for="permisos">Permisos</label>
        {if $usuario->permisos == 1}
        <span>Usuario</span>
        {elseif $usuario->permisos == 3}
        <span>Capitán</span>
        {elseif $usuario->permisos == 5}
        <span>Administrador</span>
        {/if}

        {if $usuario->nombre_equipo}
        <label for="equipo">Equipo</label>
        <span>{$usuario->nombre_equipo}</span>
        {/if}
        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>
{include file="footer.tpl"}