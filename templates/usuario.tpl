{include file="header.tpl"}

<main>
    {if isset($confirmacion)}
    <div class="confirmacion">
        <p>Desea ELIMINAR el usuario?</p>
        <div class="btnConfirm">
            <a href="{$base}/usuario/eliminarconfirmado/{$usuario->id_usuario}">Si</a>
            <a href="{$base}/usuario/ver/{$usuario->id_usuario}">No</a>
        </div>
    </div>
    {/if}
    <div class="containerEquipos">
        {include file="mensaje.tpl"}
        <h1>Usuario</h1>
        <ul class="listaDeEquipos ulJugador">
            <li><span class="atributoJugador">Nombre:</span>{$usuario->usuario}</li>
            <li><span class="atributoJugador">Email:</span>{$usuario->email}</li>
            {if $usuario->permisos == 5}
            <li><span class="atributoJugador">Permisos:</span>Administrador</li>
            {elseif $usuario->permisos == 3}
            <li><span class="atributoJugador">Permisos:</span>Capitan</li>
            {/if}
            {if $usuario->nombre_equipo}
            <li><span class="atributoJugador">Equipo:</span>{$usuario->nombre_equipo}</li>
            {else}
            <li><span class="atributoJugador">Equipo:</span>-</li>
            {/if}
        </ul>
        {if $admin}
        <div class="iconos iconosJugador">
            <a href="{$base}/usuario/editar/{$usuario->id_usuario}"><img src="{$base}/image/iconseditar.png"></a>
            <a href="{$base}/usuario/eliminar/{$usuario->id_usuario}"><img src="{$base}/image/iconsBorrar.png"></a>
        </div>
        {/if}
    </div>
</main>

{include file="footer.tpl"}