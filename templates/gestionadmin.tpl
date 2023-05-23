{include file="header.tpl"}

<div class="registroEquipo">
    <h3>Registrar equipo</h3>
    <form action="registrarequipo" method="post" class="formEditar">
        <label for="nombreEquipo">Nombre del equipo</label>
        <input type="text" name="nombreEquipo" id="">
        <input type="submit" value="Registrar" class="btnEditar">
    </form>
</div>
<!--ALTA DE USUARIOS-->

<div class="registroEquipo">
    <h3>Registrar un nuevo jugador</h3>
    <form action="" class="formEditar">

        <label for="equipo">Seleccione equipo</label>
        <select name="equipo" id="">
            {foreach from=$equipos item=equipo}
            <option value="{$equipo->getIdEquipo()}">{$equipo->getNombre()}</option>
            {/foreach}
        </select>

        <label for="nombreJugador">Nombre</label>
        <input type="tel" name="nombreJugador" id="">
        <label for="apellidoJugador">Apellido</label>
        <input type="tel" name="apellidoJugador" id="">
        <label for="dni">DNI</label>
        <input type="number" name="dni" id="">
        <select name="posicion" id="">
            <option value="POR">Arquero</option>
            <option value="DEF">Defensor</option>
            <option value="MED">Mediocampista</option>
            <option value="DEL">Delantero</option>
        </select>
        <input type="submit" value="Registrar" class="btnEditar">
    </form>
</div>

{include file="footer.tpl"}