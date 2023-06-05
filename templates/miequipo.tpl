{include file="header.tpl"}

<main>
    {include file="mensaje.tpl"}
    <div class="divImagenJugador">
        {if $equipo->escudo}
        <img src="{$base}/image/escudos/{$equipo->escudo}" class="imagenJugador" alt="Escudo del equipo">
        {else}
        <img src="{$base}/image/escudos/escudo-generico.png" class="imagenJugador" alt="El equipo no tiene escudo">
        {/if}
    </div>

    <div class="containerEquipos">
        <h1>{$equipo->nombre}</h1>
        {include file="listajugadores.tpl"}
    </div>

    <div class="registroEquipo">

        {include file="formregistrarjugador.tpl"}

    </div>

</main>

{include file="footer.tpl"}