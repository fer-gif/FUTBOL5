{include file="header.tpl"}
<main>
    {include file="mensaje.tpl"}
    
    <h1>Editar datos del partido</h1>
    <form action="{$base}/partidos/update/{$partidos->id_partido}" method="POST" class="formEditar">
        <label for="">Equipo 1</label>
        <input type="text" name="equipo1" id="" value="{$partido->id_equipo1}">
        <label for="">Equipo 2</label>
        <input type="text" name="equipo2" id="" value="{$partido->id_equipo2}">
        <label for="">Goles equipo 1</label>
        <input type="number" name="golesEquipo1" id="" value="{$partido->goles_equipo1}">
        <label for="">Goles equipo 2</label>
        <input type="number" name="golesEquipo1" id="" value="{$partido->goles_equipo2}">
        <label for="">fecha</label>
        <input type="number" name="golesEquipo1" id="" value="{$partido->fecha}">
        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>
{include file="footer.tpl"}