{include file="header.tpl"}
<main>
    <div class="containerEquipos">
        <h1>Equipos</h1>
        <ul class="listaDeEquipos">
            {foreach from=$equipos item=equipo}
            <li><a href="equipo/{$equipo->getIdEquipo()}">{$equipo->getNombre()}</a></li>
            {/foreach}
        </ul>
    </div>
</main>
{include file="footer.tpl"}