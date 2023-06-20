{include file='header.tpl'}
<main>
   <h1>Partidos</h1>
        <ul class="listaDePartidos">
            {foreach from=$partidos item=partido}
            <li>
                {foreach from=$equipos item=equipo}
                    {if $equipo->escudo}
                    <img src="{$base}/image/escudos/{$equipo->nombre}/{$equipo->escudo}" class="imgEscudo" alt="Escudo del equipo">
                    {else}
                    <img src="{$base}/image/escudos/escudo-generico.png" class="imgEscudo" alt="Escudo del equipo">
                     {/if}
                
                {/foreach}
            </li>
            {/foreach}
        </ul>
</main>
{include file='footer.tpl'}