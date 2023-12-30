<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Html.html to edit this template
-->
<html>
    <head>
        <title>Información del usuario</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estilosPerfil.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
              crossorigin="anonymous" />
    </head>
    <body>
        <div class="container">
            <h2>PERFIL</h2>
            <form id="profile-form" action="tu_ruta_de_envio" method="POST">
                <div class="profile-container">
                    <div class="profile-info">
                        <div class="editable-field" id="name-field">
                            <label><i class="fas fa-user"></i> Nombre:</label>
                            <div class="field-value" id="name" contenteditable="false">Nombre</div>
                        </div>
                        <div class="editable-field" id="last-name-field">
                            <label><i class="fas fa-user"></i> Apellidos:</label>
                            <div class="field-value" id="last-name" contenteditable="false">Apellidos</div>
                        </div>
                        <div class="editable-field" id="email-field">
                            <label><i class="fas fa-envelope"></i> Correo Electrónico:</label>
                            <div class="field-value" id="email" contenteditable="false">correo@example.com</div>
                        </div>
                        <div class="editable-field" id="username-field">
                            <label><i class="fas fa-user"></i> Nickname:</label>
                            <div class="field-value" id="username" contenteditable="false">usuario123</div>
                        </div>
                        <div class="editable-field" id="password-field">
                            <label><i class="fas fa-key"></i> Clave de Acceso:</label>
                            <div class="field-value" id="password" contenteditable="false">********</div>
                        </div>
                        <div class="editable-field" id="calendar-field">
                            <label><i class="fas fa-calendar"></i> Fecha de nacimiento:</label>
                            <div class="field-value" id="calendar" contenteditable="false">123-456-7890</div>
                        </div>
                        <div class="editable-field" id="user-field">
                            <label><i class="fas fa-user"></i> Rol:</label>
                            <div class="field-value" id="user" contenteditable="false">0</div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="parking-icons">
                <div class="parking-icon" title="Cerrar Sesión" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="parking-icon" title="Borrar Cuenta" onclick="deleteAccount()">
                    <i class="fas fa-trash-alt"></i>
                </div>
            </div>
        </div>
    </body>
</html>