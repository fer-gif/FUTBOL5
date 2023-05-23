{include file="header.tpl"}

<div class="registroEquipo">
    <form action="registrarequipo" method="post">
        <label for="nombre">Nombre del equipo</label>
        <input type="text" name="nombre" id="">
        <input type="submit" value="Registrar">
    </form>
</div>

<div>
    <select name="equipo" id="">
        {foreach from=$equipos item=equipo}
        <option value="{$equipo->getIdEquipo()}">{$equipo->getNombre()}</option>
    </select>
</div>

{include file="footer.tpl"}