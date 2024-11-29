<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="imgs/icon.png" type="image/png">
    <title>IC - Iniciar Sesión</title>
    <link rel="stylesheet" href="styles/bulma.min.css" />
    <link rel="stylesheet" href="styles/comentarios.css" />
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
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
        <a style="display: none;" id="props" class="navbar-item" href="{{ route('1propiedades') }}">Propiedades</a>
        <a style="display: none;" id="arrnd" class="navbar-item" href="{{ route('2arrendatarios') }}">Arrendatarios</a>
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

    <div class="login-container">
      <div class="login-box">
        <div class="left">
          <h2 class="title is-4">Iniciar sesión</h2>

          <div class="field">
            <div class="control">
            <input class="input" id="usuario" type="text" placeholder="Correo" />
            </div>
          </div>

          <div class="field">
            <div class="control">
            <input class="input" id="contraseña" type="password" placeholder="Contraseña" />
            </div>
          </div>

          <div class="field">
            <div class="control">
              <button class="button is-dark" id="loginbt">Ingresar</button>
            </div>
          </div>

          <p class="register-link">
            No tienes cuenta? <a href="{{ route('6registro') }}">Regístrate</a>
          </p>
        </div>

        <div class="right">
          <h1 class="title is-3">BIENVENIDO!</h1>
          <p>
            Bienvenido a INMOCREDIT, centro de calificaciones y opiniones sobre
            arrendatarios. Para publicar tus opiniones te invitamos a ingresar
            con tu usuario y contraseña, si no estás registrado, ¡puedes hacerlo
            cuando gustes!
          </p>
        </div>
      </div>
    </div>

    <script>
  document.getElementById("loginbt").addEventListener("click", function (event) {
    event.preventDefault(); // Evitar que el formulario se envíe de manera tradicional

    // Obtener los valores de los campos de entrada
    const correo = document.getElementById("usuario").value;
    const contraseña = document.getElementById("contraseña").value;

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Enviar los datos mediante AJAX
    fetch("/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": token
      },
      body: JSON.stringify({
        correo: correo,
        contraseña: contraseña
      })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error("Credenciales incorrectas");
      
      }
      return response.json();
    })
    .then(data => {
      alert("Inicio de sesión exitoso");
       window.location.href = "{{ route('welcome') }}";
       
    })
    .catch(error => {
      alert("Error al iniciar sesión: " + error.message);
    });
  });
</script>


  </body>
</html>
