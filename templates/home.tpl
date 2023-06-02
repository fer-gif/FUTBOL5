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

        {foreach name="tablaequipos" from=$equipos item=equipo}
        <tr class="filaTablaPosicion">
            <td>{$smarty.foreach.tablaequipos.iteration}</td>
            <td>{$equipo["nombre"]}</td>
            <td>{$equipo["puntos"]}</td>
            <td>{$equipo["pj"]}</td>
            <td>{$equipo["pg"]}</td>
            <td>{$equipo["pe"]}</td>
            <td>{$equipo["pp"]}</td>
            <td>{$equipo["gf"]}</td>
            <td>{$equipo["gc"]}</td>

        </tr>
        {/foreach}
    </table>
</main>
{include file='footer.tpl'}