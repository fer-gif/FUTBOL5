{include file='header.tpl'}
<main>
    {if isset($confirmacion)}
    <div class="confirmacion">
        <p>Desea ELIMINAR el partido?</p>
        <div class="btnConfirm">
            <a href="{$base}/fixture/deletePartido/{$idPartido}">Si</a>
            <a href="{$base}/fixture">No</a>
        </div>
    </div>
    {/if}
    {include file="mensaje.tpl"}
    <div class="containerPartidos">
        <h1>Partidos</h1>
            <table class="listaDePartidos tablaPosiciones">
            {foreach from=$partidos item=partido}
                
                    <tr class="filaPartido">
                        <td>
                            {if $partido['escudo1']}
                            <img src="{$base}/image/escudos/{$partido['nom_equipo1']}/{$partido['escudo1']}"
                                class="imgEscudo" alt="Escudo del equipo">
                            {else}
                            <img src="{$base}/image/escudos/escudo-generico.png" class="imgEscudo" alt="Escudo del equipo">
                            {/if}
                        </td>
                        <td>
                            {$partido['nom_equipo1']}
                        </td>
                        <td>
                            {$partido['goles_equipo1']}
                        </td>
                        <td>
                            <span>VS</span>
                        </td>
                        <td>
                            {$partido['goles_equipo2']}
                        </td>
                        <td>
                            {$partido['nom_equipo2']}
                        </td>
                        <td>
                            {if $partido['escudo2']}
                            <img src="{$base}/image/escudos/{$partido['nom_equipo2']}/{$partido['escudo2']}"
                                class="imgEscudo" alt="Escudo del equipo">
                            {else}
                            <img src="{$base}/image/escudos/escudo-generico.png" class="imgEscudo" alt="Escudo del equipo">
                            {/if}
                        </td>
                        {if $admin}
                        <td>
                            <div class="iconos">
                                <a href="{$base}/fixture/editar/{$partido['id_partido']}"><img
                                        src="{$base}/image/iconseditar.png"></a>
                                <a href="{$base}/fixture/eliminar/{$partido['id_partido']}"><img
                                        src="{$base}/image/iconsBorrar.png"></a>
                            </div>
                        </td>
                        {/if}
                    </tr>
                    {/foreach}
                </table>
    </div>
    
</main>
{include file='footer.tpl'}