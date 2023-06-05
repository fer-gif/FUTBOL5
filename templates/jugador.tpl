{include file="header.tpl"}
<main>
    {if isset($confirmacion)}
    <div class="confirmacion">
        <p>Desea ELIMINAR el jugador?</p>
        <div class="btnConfirm">
            <a href="{$base}/jugadores/eliminarconfirmado/{$jugador->id_jugador}">Si</a>
            <a href="{$base}/jugadores/ver/{$jugador->id_jugador}">No</a>
        </div>
    </div>
    {/if}
    <div class="containerEquipos">
        <div class="divImagenJugador">
            {if $jugador->foto}
            <img src="{$base}/image/jugadores/{$jugador->foto}" class="imagenJugador"
                alt="El Jugador no tiene foto de perfil">
            {else}
            <img src="{$base}/image/jugadores/sin-foto.png" class="imagenJugador"
                alt="El Jugador no tiene foto de perfil">
            {/if}
        </div>
        <ul class="listaDeEquipos ulJugador">
            <li><span class="atributoJugador">DNI:</span><span>{$jugador->dni}</span></li>
            <li><span class="atributoJugador">Nombre:</span>{$jugador->nombre}</li>
            <li><span class="atributoJugador">Apellido:</span>{$jugador->apellido}</li>
            {if $jugador->telefono}
            <li><span class="atributoJugador">Telefono:</span>{$jugador->telefono}</li>
            {else}
            <li><span class="atributoJugador">Telefono:</span>-</li>
            {/if}
            <li><span class="atributoJugador">Posicion:</span>{$jugador->posicion}</li>
            <li><span class="atributoJugador">Equipo:</span>{$jugador->nombre_equipo}</li>
        </ul>
        {if $admin}
        <div class="iconos iconosJugador">
            <a href="{$base}/jugadores/editar/{$jugador->id_jugador}"><img src="{$base}/image/iconseditar.png"></a>
            <a href="{$base}/jugadores/eliminar/{$jugador->id_jugador}"><img src="{$base}/image/iconsBorrar.png"></a>
        </div>
        {/if}
    </div>
</main>
{include file="footer.tpl"}