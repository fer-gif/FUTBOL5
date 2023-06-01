{include file="header.tpl"}
<main>

    <div class="registroEquipo">
        
        <form action="equipo/registrar" method="post" class="formEditar">
            <h3>Registrar un nuevo equipo</h3>
            <label for="nombreEquipo">Nombre del equipo</label>
            <input type="text" name="nombreEquipo" id="">
            <input type="submit" value="Registrar" class="btnSubmit">
        </form>
    </div>
    <!--ALTA DE USUARIOS-->

    <div class="registroEquipo">

        {include file="formregistrarjugador.tpl"}

    </div>
    <div class="registroEquipo">
        
        <form action="usuario/registrar" method="post" class="formEditar">
            <h3>Registrar nuevo usuario</h3>
            <label for="nombreUsuario">Nombre del usuario</label>
            <input type="text" name="nombreUsuario" id="">
            <label for="password">Password</label>
            <input type="password" name="password" id="">
            <label for="email">Email</label>
            <input type="email" name="email" id="">
            <label for="permisos">Seleccione el tipo de usuario</label>
            <select name="permisos" id="">
                <option value="0">Seleccione uno...</option>
                <option value="1">Usuario</option>
                <option value="3">Capitán</option>
                <option value="5">Administrador</option>
            </select>
            <p class="infoUsuario">Si el usuario es Capitan de un equipo, seleccione el equipo al que pertenece</p>
            <label for="equipo">Equipo</label>
            <select name="equipo" id="">
                {foreach from=$equipos item=equipo}
                <option value="{$equipo->getIdEquipo()}">{$equipo->getNombre()}</option>
                {/foreach}
            </select>
            <input type="submit" value="Registrar" class="btnSubmit">
        </form>
    </div>
</main>
{include file="footer.tpl"}