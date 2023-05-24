{include file="header.tpl"}

<div class="registroEquipo">
    <h3>Registrar equipo</h3>
    <form action="registrarequipo" method="post" class="formEditar">
        <label for="nombreEquipo">Nombre del equipo</label>
        <input type="text" name="nombreEquipo" id="">
        <input type="submit" value="Registrar" class="btnEditar">
    </form>
</div>
<!--ALTA DE USUARIOS-->

<div class="registroEquipo">

    {include file="formregistrojugador.tpl"}

</div>

{include file="footer.tpl"}