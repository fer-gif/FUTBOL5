
<form action="{$base}/jugadores/registrar" method="post" class="formEditar">
    <h3>Registrar un nuevo jugador</h3>
    {if $admin}
    <label for="equipo">Seleccione equipo</label>
    <select name="equipo" id="">
        {foreach from=$equipos item=equipo}
        <option value="{$equipo->id_equipo}">{$equipo->nombre}</option>
        {/foreach}
    </select>
    {/if}
    <label for="nombreJugador">Nombre</label>
    <input type="tel" name="nombreJugador" id="">
    <label for="apellidoJugador">Apellido</label>
    <input type="tel" name="apellidoJugador" id="">
    <label for="dni">DNI</label>
    <input type="number" name="dni" id="">
    <label for="telefono">Teléfono</label>
    <input type="number" name="telefono" id="">
    <label for="posicion">Seleccione una posición</label>
    <select name="posicion" id="">
        <option value="POR">Arquero</option>
        <option value="DEF">Defensor</option>
        <option value="MED">Mediocampista</option>
        <option value="DEL">Delantero</option>
    </select>
    <input type="submit" value="Registrar" class="btnSubmit">
</form>