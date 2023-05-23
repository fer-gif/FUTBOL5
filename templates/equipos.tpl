{include file="header.tpl"}
<main>
    <div class="containerEquipos">
        <h1>Equipos</h1>
        <ul class="listaDeEquipos">
            {foreach from=$equipos item=equipo}
            <li><a href="equipo/ver/{$equipo->getIdEquipo()}">{$equipo->getNombre()}</a>
                {if $admin}
                <div class="iconos">
                    <a href="{$base}/equipo/editar/{$equipo->getIdEquipo()}"><img
                            src="{$base}/image/iconseditar.png"></a>
                    <a href="{$base}/equipo/eliminar/{$equipo->getIdEquipo()}"><img
                            src="{$base}/image/iconsBorrar.png"></a>
                </div>
                {/if}
            </li>
            {/foreach}
        </ul>
    </div>
</main>
{include file="footer.tpl"}