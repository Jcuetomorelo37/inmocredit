<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="imgs/icon.png" type="image/png">
  <title>IC - Registrarse</title>
  <!-- <link rel="stylesheet" href="styles/bulma.min.css" /> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="styles/comentarios.css" />
  <link rel="stylesheet" href="styles/registro.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  @if(session('loggedIn'))
  <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('btnlogout').style.display = 'flex';
            document.getElementById('arrnd').style.display = 'flex';
            document.getElementById('props').style.display = 'flex';
            document.getElementById('reg').style.display = 'none';
            document.getElementById('lgin').style.display = 'none';
        });
    </script>
    @endif
</head>

<body>
  <!-- Menú de Navegación -->
  <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" id="InmoCredit">
        <strong>InmoCredit</strong>
      </a>
      <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasic">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasic" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="{{ route('welcome') }}">Inicio</a>
        <a class="navbar-item" href="{{ route('1propiedades') }}">Propiedades</a>
        <a class="navbar-item" href="{{ route('2arrendatarios') }}">Arrendatarios</a>
        <a class="navbar-item" href="{{ route('3comentarios') }}">Comentarios</a>
        <a class="navbar-item" href="{{ route('4acerca_de') }}">Acerca de</a>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
          <a id="lgin" class="button is-light" href="{{ route('5login') }}">Iniciar sesión</a>
            <a id="reg" class="button is-link" href="{{ route('6registro') }}">Regístrate</a>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: flex;">
              @csrf
              <button type="submit" id="btnlogout" class="button is-light"
                style="display: none;    
              width: 115px;
    height: 36px;
    font-size: medium;
    font-style: normal;
    font-weight: bold;">
                Cerrar sesión
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="register-container">
    <div class="register-box">
      <div class="left">
        <h2 class="title is-4">Registrarse</h2>

        <div class="field">
          <div class="control">
            <input class="input" id="nombre" type="text" placeholder="Nombre" />
          </div>
        </div>

        <div class="field">
          <div class="control">
            <input class="input" id="correo" type="email" placeholder="Correo" />
          </div>
        </div>

        <div class="field">
          <div class="control">
            <input class="input" id="contraseña" type="password" placeholder="Contraseña" />
          </div>
        </div>

        <div class="field">
          <div class="control">
            <input class="input" id="fecha_registro" type="date" placeholder="Fecha de registro" />
          </div>
        </div>

        <div class="field">
          <div class="control">
            <button class="button is-dark" id="registerbtn">Registrarse</button>
          </div>
        </div>

        <p class="login-link">
          ¿Ya tienes cuenta? <a href="{{ route('5login') }}">Inicia sesión</a>
        </p>
      </div>

      <div class="right">
        <div style="margin-bottom: 18%;" id="d"></div>
        <h1 style="color: antiquewhite;" class="title is-3">¡ÚNETE A INMOCREDIT!</h1>
        <p>
          Forma parte de INMOCREDIT, plataforma de calificaciones y
          opiniones sobre arrendatarios. Regístrate para acceder a toda la
          información y compartir tus experiencias con otros arrendadores.
        </p>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("registerbtn").addEventListener("click", function(event) {
      event.preventDefault(); // Evitar que el formulario se envíe de la manera tradicional

      // Obtener los valores de los campos de entrada
      const nombre = document.getElementById("nombre").value;
      const correo = document.getElementById("correo").value;
      const contraseña = document.getElementById("contraseña").value;
      const fecha_registro = document.getElementById("fecha_registro").value;

      fetch("/usuarios", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({
            nombre: nombre,
            correo: correo,
            contraseña: contraseña,
            fecha_registro: fecha_registro,
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data) {
            alert("¡Registro exitoso!");
            window.location.href = "{{ route('5login') }}";
          } else {
            alert("Error al registrarse. Por favor, intenta de nuevo.");
          }
        })
        .catch(error => console.error("Error:", error));
    });
  </script>


</body>

</html>