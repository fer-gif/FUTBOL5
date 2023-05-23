{include file="header.tpl"}

<div class="registroEquipo">
    <form action="registrarequipo" method="post">
        <label for="nombre">Nombre del equipo</label>
        <input type="text" name="nombre" id="">
        <input type="submit" value="Registrar">
    </form>
</div>
<!--ALTA DE USUARIOS-->

<div>
    <select name="equipo" id="">
        {foreach from=$equipos item=equipo}
        <option value="{$equipo->getIdEquipo()}">{$equipo->getNombre()}</option>
        {/foreach}
    </select>
</div>

{include file="footer.tpl"}