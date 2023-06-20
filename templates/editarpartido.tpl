{include file="header.tpl"}
<main>
    {include file="mensaje.tpl"}

    <h1>Editar datos del partido</h1>
    <form action="{$base}/fixture/update/{$partido['id_partido']}" method="POST" class="formEditar editPartido">
        <div class="divEquiposEdit">
            <span>{$partido['nom_equipo1']}</span>
            <input type="number" name="golesEquipo1" id="" min="0" value="{$partido['goles_equipo1']}">
            <span>Vs</span>
            <input type="number" name="golesEquipo2" id="" min="0" value="{$partido['goles_equipo2']}">
            <span>{$partido['nom_equipo2']}</span>
        </div>
        <label for="" class="txtFecha">fecha</label>
        <input type="number" name="fecha" id="" min="1" class="inputFecha" value="{$partido['fecha']}">
        <input type="submit" value="Editar" class="btnEditar">
    </form>
</main>
{include file="footer.tpl"}