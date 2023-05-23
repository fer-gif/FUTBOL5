{include file='header.tpl'}
<main>
    <table class="tablaPosiciones">
        <thead class="theadPosiciones">
            <th>Pos</th>
            <th>Equipo</th>
            <th>Pts</th>
            <th>PJ</th>
            <th>PG</th>
            <th>PE</th>
            <th>PP</th>
            <th>GF</th>
            <th>GC</th>
        </thead>
        {foreach from=$equipos item=equipo}
        <tr class="filaTablaPosicion">
            <td>Pos</td>
            <td>{$equipo->getNombre()}</td>
            <td>{$equipo->getPuntos()}</td>
            <td>{$equipo->getPartidos_jugados()}</td>
            <td>{$equipo->getPG()}</td>
            <td>{$equipo->getPE()}</td>
            <td>{$equipo->getPP()}</td>
            <td>{$equipo->getGF()}</td>
            <td>{$equipo->getGC()}</td>

        </tr>
        {/foreach}
    </table>
</main>
{include file='footer.tpl'}