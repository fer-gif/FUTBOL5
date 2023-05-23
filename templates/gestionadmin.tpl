{include file="header.tpl"}

<div class="registroEquipo">
    <form action="registrarequipo" method="post">
        <label for="nombreEquipo">Nombre del equipo</label>
        <input type="text" name="nombreEquipo" id="">
        <input type="submit" value="Registrar">
    </form>
</div>
<!--ALTA DE USUARIOS-->

<div>
    <form action="">
        <select name="equipo" id="">
            {foreach from=$equipos item=equipo}
            <option value="{$equipo->getIdEquipo()}">{$equipo->getNombre()}</option>
            {/foreach}
        </select>
        <h3>Registrar un nuevo jugador</h3>
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
    </form>
</div>

{include file="footer.tpl"}