{include file="header.tpl"}
<main>
    {include file="mensaje.tpl"}
    
    <h1>Editar datos del jugador</h1>
    <form action="{$base}/jugadores/update/{$jugador->id_jugador}" method="POST" class="formEditar">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="" value="{$jugador->nombre}">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="" value="{$jugador->apellido}">
        <label for="dni">DNI</label>
        <input type="number" name="dni" id="" value="{$jugador->dni}">
        <label for="telefono">Telefono</label>
        <input type="number" name="telefono" id="" value="{$jugador->telefono}">
        <label for="posicion">Posicion</label>
        <select name="posicion" id="">
            <option value="POR">Arquero</option>
            <option value="DEF">Defensor</option>
            <option value="MED">Mediocampista</option>
            <option value="DEL">Delantero</option>
        </select>
        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>
{include file="footer.tpl"}