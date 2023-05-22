{include file="header.tpl"}
<main>
    <table class="tablaPosiciones">
        <h2 class="nombreEquipo">{$nombreEquipo}</h2>
        <thead class="theadPosiciones">
            <th>Pos</th>
            <th>Nombre</th>
            <th>Apellido</th>
        </thead>
        {foreach from=$jugadores item=jugador}
        <tr class="filaTablaPosicion">
            <td>{$jugador->getPosicion()}</td>
            <td>{$jugador->getNombre()}</td>
            <td>{$jugador->getApellido()}</td>
            <td>
                <div class="iconos">
                    <a href="{$base}/editarJugador/{$jugador->getIdJugador()}"><img src="../image/iconseditar.png"></a>
                    <a href="{$base}/eliminarJugador/{$jugador->getIdJugador()}"><img
                            src="../image/iconsBorrar.png"></a>
                </div>
            </td>
        </tr>
        {/foreach}
    </table>
</main>
{include file="footer.tpl"}