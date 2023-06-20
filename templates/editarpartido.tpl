{include file="header.tpl"}
<main>
    {include file="mensaje.tpl"}

    <h1>Editar datos del partido</h1>
    <form action="{$base}/fixture/update/{$partido['id_partido']}" method="POST" class="formEditar editPartido">
        <div>
            <span>{$partido['nom_equipo1']}</span>
            <label for="Goles equipo 1"></label>
            <input type="number" name="golesEquipo1" id="" min="0" value="{$partido['goles_equipo1']}">
            <span>Vs</span>
            <label for="Goles equipo 2"></label>
            <input type="number" name="golesEquipo2" id="" min="0" value="{$partido['goles_equipo2']}">
            <span>{$partido['nom_equipo2']}</span>
        </div>
        <label for="">fecha</label>
        <input type="number" name="fecha" id="" min="1" value="{$partido['fecha']}">
        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>
{include file="footer.tpl"}