{include file="header.tpl"}

<main>
    {include file="mensaje.tpl"}
    <h1>Editar datos del equipo</h1>
    <form action="{$base}/equipos/update/{$equipo->id_equipo}" method="post" class="formEditar">
        <label for="nombreEquipo">Nombre del equipo</label>
        <input type="text" name="nombreEquipo" id="" value="{$equipo->nombre}">
        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>

{include file="footer.tpl"}