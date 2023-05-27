{include file='header.tpl'}
<main>
    <form action="registrar" method="POST" class="formFixture">
        <h2>Registrar Resultado de un partido</h2>
        <div class="partido">
            <div class="selectEquipo">
                <label for="equipo1">Equipo 1</label>
                <select name="equipo1" id="">
                    {foreach from=$equipos item=equipo}
                    <option value="{$equipo->getIdEquipo()}">{$equipo->getNombre()}</option>
                    {/foreach}
                </select>
            </div>
            <input type="number" name="golesEquipo1" id="" min="0" class="inputGoles" required>
            <p>VS</p>
            <input type="number" name="golesEquipo2" min="0" id="" class="inputGoles" required>
            <div class="selectEquipo">
                <label for="equipo2">Equipo 2</label>
                <select name="equipo2" id="">
                    {foreach from=$equipos item=equipo}
                    <option value="{$equipo->getIdEquipo()}">{$equipo->getNombre()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <input type="submit" value="Registrar" class="btnRegistrarPartido">
    </form>
</main>
{include file='footer.tpl'}