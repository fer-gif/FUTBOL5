{include file="header.tpl"}
<main>
    {if isset($confirmacion)}
        <div class="confirmacion">
            <p>Desea ELIMINAR el equipo y sus jugadores?</p>
            <div class="btnConfirm">
                <a href="{$base}/equipos/eliminarconfirmado/{$equipo->id_equipo}">Si</a>
                <a href="{$base}/equipos/ver/{$equipo->id_equipo}">No</a>
            </div>
        </div>
    {/if}
    <h2 class="nombreEquipo">{$equipo->nombre}</h2>
    <table class="tablaPosiciones">
        <thead class="theadPosiciones">
            <th>Pos</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Telefono</th>

        </thead>
        {foreach from=$jugadores item=jugador}
        <tr class="filaTablaPosicion">
            <td>{$jugador["posicion"]}</td>
            <td>{$jugador["nombre"]}</td>
            <td>{$jugador["apellido"]}</td>
            <td>{$jugador["dni"]}</td>
            {if $jugador["telefono"]!=0}
                <td>{$jugador["telefono"]}</td>
            {else}
                <td>-</td>
            {/if}
            {if $admin}
            <td>
                <div class="iconos">
                    <a href='{$base}/jugadores/editar/{$jugador["id_jugador"]}'><img
                            src="{$base}/image/iconseditar.png"></a>
                    <a href='{$base}/jugadores/eliminar/{$jugador["id_jugador"]}'><img
                            src="{$base}/image/iconsBorrar.png"></a>
                </div>
            </td>
            {/if}
        </tr>
        {/foreach}
    </table>
</main>
{include file="footer.tpl"}