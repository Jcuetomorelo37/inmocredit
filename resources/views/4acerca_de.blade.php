<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="imgs/icon.png" type="image/png">
  <title>IC - Propiedades</title>
  <link rel="stylesheet" href="styles/bulma.min.css" />
  <link rel="stylesheet" href="styles/comentarios.css" />
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
  <nav
    class="navbar is-primary"
    role="navigation"
    aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" id="InmoCredit">
        <strong>InmoCredit</strong>
      </a>
      <a
        role="button"
        class="navbar-burger"
        aria-label="menu"
        aria-expanded="false"
        data-target="navbarBasic">
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

  <section class="section about-section">
    <div class="container">
      <!-- Encabezado -->
      <div class="content has-text-centered">
        <span class="icon is-large header-icon">
          <i class="fas fa-info-circle fa-3x"></i>
        </span>
        <h1 class="title">Acerca de InmoCredit</h1>
        <p>Una plataforma de información para evaluar la conducta de arrendatarios y facilitar la selección de inquilinos confiables en el sector inmobiliario.</p>
      </div>

      <!-- Autores -->
      <div class="content">
        <h2 class="subtitle">Desarrollado por</h2>
        <ul class="author-list">
          <li><strong>Yuliana Díaz Medina</strong> - Facultad de Ingeniería, Departamento de Ingeniería de Sistemas</li>
          <li><strong>Elías Ballestero Sierra</strong> - Facultad de Ingeniería, Departamento de Ingeniería de Sistemas</li>
          <li><strong>Juan Luis Cueto Morelo</strong> - Facultad de Ingeniería, Departamento de Ingeniería de Sistemas</li>
        </ul>
      </div>

      <!-- Información Institucional -->
      <div class="content">
        <p><strong>Universidad de Córdoba</strong></p>
        <p>Montería, Córdoba - 2024</p>
      </div>

      <!-- Objetivos -->
      <div class="content">
        <h2 class="subtitle">Objetivos de la Plataforma</h2>
        <p>Crear una plataforma para propietarios y administradores que permita la consulta de información verificada sobre el comportamiento de los arrendatarios, mejorando la seguridad y confianza en los procesos de arrendamiento.</p>
      </div>

      <!-- Botón de regreso -->
      <div class="content has-text-centered back-button">
        <a href="{{ route('welcome') }}" class="button is-link">
          <span class="icon">
            <i class="fas fa-arrow-left"></i>
          </span>
          <span>Regresar al Inicio</span>
        </a>
      </div>
    </div>
  </section>

</body>

</html>