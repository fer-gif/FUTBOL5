{include file="header.tpl"}
<main>
    <div class="registroEquipo">
        <h3>Registrar un nuevo equipo</h3>
        <form action="equipo/registrar" method="post" class="formEditar">
            <label for="nombreEquipo">Nombre del equipo</label>
            <input type="text" name="nombreEquipo" id="">
            <input type="submit" value="Registrar" class="btnSubmit">
        </form>
    </div>
    <!--ALTA DE USUARIOS-->

    <div class="registroEquipo">

        {include file="formregistrarjugador.tpl"}

    </div>
</main>
{include file="footer.tpl"}