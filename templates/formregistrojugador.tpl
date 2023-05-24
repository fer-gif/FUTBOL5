<h3>Registrar un nuevo jugador</h3>
<form action="" class="formEditar">
    {if $admin}
    <label for="equipo">Seleccione equipo</label>
    <select name="equipo" id="">
        {foreach from=$equipos item=equipo}
        <option value="{$equipo->getIdEquipo()}">{$equipo->getNombre()}</option>
        {/foreach}
    </select>
    {elseif $user}
    <h2>EQUIPO</h2>
    {/if}
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