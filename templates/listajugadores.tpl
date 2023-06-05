<ul class="listaDeEquipos">
    {foreach from=$jugadores item=jugador}
    <li><span class="spanPos">{$jugador["posicion"]}</span><a
            href='{$base}/jugadores/ver/{$jugador["id_jugador"]}'>{$jugador["apellido"]}
            {$jugador["nombre"]}</a>
        {if $admin}
        <div class="iconos">
            <a href="{$base}/jugadores/editar/{$jugador['id_jugador']}"><img src="{$base}/image/iconseditar.png"></a>
            <a href="{$base}/jugadores/eliminar/{$jugador['id_jugador']}"><img src="{$base}/image/iconsBorrar.png"></a>
        </div>
        {/if}
    </li>
    {/foreach}
</ul>