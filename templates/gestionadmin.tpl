{include file="header.tpl"}
<main>
    <h1>ADMINISTRACIÓN</h1>
    <br>
    {include file="mensaje.tpl"}
    <div class="containerAdmin">
        <div class="panelAdmin">
            <div class="registroEquipo">
                <form action="{$base}/equipos/registrar" method="post" class="formEditar">
                    <h3>Registrar un nuevo equipo</h3>
                    <label for="nombreEquipo">Nombre del equipo</label>
                    <input type="text" name="nombreEquipo" id="">
                    <input type="submit" value="Registrar" class="btnSubmit">
                </form>
            </div>
            <div class="registroEquipo">

                {include file="formregistrarjugador.tpl"}

            </div>
        </div>
        <!--ALTA DE USUARIOS-->
        <div class="panelAdmin">
            <div class="registroEquipo">

                <form action="{$base}/usuario/registrar" method="post" class="formEditar">
                    <h3>Registrar nuevo usuario</h3>
                    <label for="nombreUsuario">Nombre del usuario</label>
                    <input type="text" name="nombreUsuario" id="">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="">
                    <label for="passwordRep">Repetir password</label>
                    <input type="password" name="passwordRep" id="">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="">
                    <label for="permisos">Seleccione el tipo de usuario</label>
                    <select name="permisos" id="">
                        <option value="0">Seleccione uno...</option>
                        <option value="1">Usuario</option>
                        <option value="3">Capitán</option>
                        <option value="5">Administrador</option>
                    </select>
                    <p class="infoUsuario">Si el usuario es Capitan de un equipo, seleccione el equipo al que pertenece
                    </p>
                    <label for="equipo">Equipo</label>
                    <select name="equipo" id="">
                        {foreach from=$equipos item=equipo}
                        <option value="{$equipo->id_equipo}">{$equipo->nombre}</option>
                        {/foreach}
                    </select>
                    <input type="submit" value="Registrar" class="btnSubmit">
                </form>
            </div>
            <div class="registroEquipo usuariosAdmin">
                <h3>Usuarios registrados</h3>
                <ul class="listaDeEquipos listaUsuarios">
                    {foreach from=$usuarios item=usuario}
                    <li><a href='{$base}/usuario/ver/{$usuario->id_usuario}'>{$usuario->usuario}</a>
                        <div class="iconos">
                            <a href="{$base}/usuario/editar/{$usuario->id_usuario}"><img
                                    src="{$base}/image/iconseditar.png"></a>
                            <a href="{$base}/usuario/eliminar/{$usuario->id_usuario}"><img
                                    src="{$base}/image/iconsBorrar.png"></a>
                        </div>
                    </li>
                    {/foreach}
                </ul>
            </div>

        </div>
    </div>
</main>
{include file="footer.tpl"}