{include file="header.tpl"}
<main>
    <h1>Editar datos del jugador</h1>
    <form action="{$base}/jugador/update/{$jugador->getIdJugador()}" method="POST" class="formEditar">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="" value="{$jugador->getNombre()}">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="" value="{$jugador->getApellido()}">
        <label for="dni">DNI</label>
        <input type="number" name="dni" id="" value="{$jugador->getDNI()}">
        <label for="telefono">Telefono</label>
        <input type="number" name="telefono" id="" value="{$jugador->getTelefono()}">
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