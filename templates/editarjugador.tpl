{include file="header.tpl"}
<main>
    <h1>Editar datos del jugador</h1>
    <form action="{$base}/jugador/update/{$jugador->getIdJugador()}" method="POST" class="formEditar">
        <label for="posicion">Posicion</label>
        <input type="text" name="posicion" id="" value="{$jugador->getPosicion()}">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="" value="{$jugador->getNombre()}">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="" value="{$jugador->getApellido()}">
        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>
{include file="footer.tpl"}