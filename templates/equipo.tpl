{include file="header.tpl"}
<main>
    <h2 class="nombreEquipo">{$nombreEquipo}</h2>
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
            <td>{$jugador->getPosicion()}</td>
            <td>{$jugador->getNombre()}</td>
            <td>{$jugador->getApellido()}</td>
            <td>{$jugador->getDNI()}</td>
            <td>{$jugador->getTelefono()}</td>

            {if $capitan}
            <td>
                <div class="iconos">
                    <a href="{$base}/jugador/editar/{$jugador->getIdJugador()}"><img
                            src="{$base}/image/iconseditar.png"></a>
                    <a href="{$base}/jugador/eliminar/{$jugador->getIdJugador()}"><img
                            src="{$base}/image/iconsBorrar.png"></a>
                </div>
            </td>
            {/if}
        </tr>
        {/foreach}
    </table>
</main>
{include file="footer.tpl"}