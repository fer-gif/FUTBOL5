{include file="header.tpl"}

<main>
    {include file="mensaje.tpl"}
    <div class="divImagenJugador">
        {if $equipo->escudo}
        <img src="{$base}/image/escudos/{$equipo->nombre}/{$equipo->escudo}" class="imagenJugador"
            alt="Escudo del equipo">
        {else}
        <img src="{$base}/image/escudos/escudo-generico.png" class="imagenJugador" alt="El equipo no tiene escudo">
        {/if}
    </div>


    <div class="containerEquipos">
        <h1>{$equipo->nombre}</h1>
        {include file="listajugadores.tpl"}
    </div>
    <form action="{$base}/equipos/editarescudo/{$equipo->id_equipo}" method="POST" class="formEditar"
        enctype="multipart/form-data">
        <h3>Cambia el escudo de tu equipo</h3>
        <br>
        <input type="file" name="escudo">
        <input type="submit" value="Subir Escudo" class="btnSubmit">
    </form>
    <div class="registroEquipo">

        {include file="formregistrarjugador.tpl"}

    </div>

</main>

{include file="footer.tpl"}