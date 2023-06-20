<form action="{$base}/fixture/registrar" method="POST" class="formFixture">
    <h2>Registrar Resultado de un partido</h2>
    <div class="partido">
        <div class="selectEquipo">
            <label for="equipo1">Equipo 1</label>
            <select name="equipo1" id="">
                {foreach from=$equipos item=equipo}
                <option value="{$equipo->id_equipo}">{$equipo->nombre}</option>
                {/foreach}
            </select>
        </div>
        <input type="number" name="golesEquipo1" id="" min="0" class="inputGoles">
        <p>VS</p>
        <input type="number" name="golesEquipo2" min="0" id="" class="inputGoles">
        <div class="selectEquipo">
            <label for="equipo2">Equipo 2</label>
            <select name="equipo2" id="">
                {foreach from=$equipos item=equipo}
                <option value="{$equipo->id_equipo}">{$equipo->nombre}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="fecha">
        <label for="fecha">Fecha numero:</label>
        <input type="number" name="fecha" id="" min="1">
    </div>

    <input type="submit" value="Registrar" class="btnRegistrarPartido">
</form>