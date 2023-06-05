{include file="header.tpl"}

<main>
    {include file="mensaje.tpl"}
    <form action="{$base}/login/ingreso" method="post" class="formEditar">
        <label for="usuario">Usuario</label>
        <input type="text" name="nombreUsuario" id="">
        <label for="pass">Password</label>
        <input type="password" name="password" id="">
        <input type="submit" value="Ingresar" class="btnSubmit">
    </form>
</main>