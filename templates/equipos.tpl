{include file="header.tpl"}
<main>
    {include file="mensaje.tpl"}
    <div class="containerEquipos">
        <h1>Equipos</h1>
        <ul class="listaDeEquipos">
            {foreach from=$equipos item=equipo}
            <li>
                {if $equipo->escudo}
                <img src="{$base}/image/escudos/{$equipo->nombre}/{$equipo->escudo}" class="imgEscudo" alt="Escudo del equipo">
                {else}
                <img src="{$base}/image/escudos/escudo-generico.png" class="imgEscudo" alt="Escudo del equipo">
                {/if}
                <a href="{$base}/equipos/ver/{$equipo->id_equipo}">{$equipo->nombre}</a>
                {if $admin}
                <div class="iconos">
                    <a href="{$base}/equipos/editar/{$equipo->id_equipo}"><img src="{$base}/image/iconseditar.png"></a>
                    <a href="{$base}/equipos/eliminar/{$equipo->id_equipo}"><img
                            src="{$base}/image/iconsBorrar.png"></a>
                </div>
                {/if}
            </li>
            {/foreach}
        </ul>
    </div>
</main>
{include file="footer.tpl"}