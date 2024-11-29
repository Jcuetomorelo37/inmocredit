<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>InmoCredit</title>
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

  <!-- Hero Section -->
  <section class="hero is-fullheight-with-navbar">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-vcentered">
          <div class="column content-box">
            <h1 class="title" id="pIntro">Descubre el Poder de la Satisfaccion de Arrendamiento</h1>
            <p class="subtitle">
              Desbloquea la clave para el éxito de las relaciones entre
              propietarios e inquilinos: Explora nuestra plataforma integral
              de satisfacción del inquilino.
            </p>
            <a href="{{ route('4acerca_de') }}" class="button is-success is-medium">Explorar ya!</a>
          </div>
          <div class="column image-box has-text-centered">
            <figure class="image is-500x500">
              <img
                src="imgs/logo_inicio.png"
                alt="Placeholder Image" id="img_logo_inicio" />
            </figure>
            <a href="{{ route('3comentarios') }}">
              <div class="speech-bubble">Sitio del arrendador</div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- New Section -->
  <section class="section">
    <div class="container">
      <div class="section-title">
        <h2 class="title">
          Bienvenido a la valoracion de satisfacción de nuestros inquilinos
        </h2>
        <p class="subtitle">
          Revolucione su proceso de alquiler con perfiles y calificaciones de
          inquilinos verificados
        </p>
      </div>
      <div class="columns is-vcentered">
        <div class="column">
          <div class="card">
            <div class="card-content">
              <figure class="image is-120x120 card-image">
                <img src="imgs/hotel.jpg" alt="Illustration" />
              </figure>
              <div>
                <h3 class="title is-4">
                  Desbloquee los secretos para un inquilino exitoso
                </h3>
                <p>
                  Eleve su negocio de alquiler con nuestra plataforma de
                  satisfacción de inquilinos de vanguardia. Obtenga
                  información sin precedentes sobre los posibles inquilinos.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="card">
            <div class="card-content">
              <figure class="image is-120x120 card-image">
                <img src="imgs/calificaciones.jpg" alt="Illustration" />
              </figure>
              <div>
                <h3 class="title is-4">
                  Descubra el poder de las calificaciones de inquilinos
                  verificadas
                </h3>
                <p>
                  Desbloquee la clave para relaciones exitosas entre
                  propietarios e inquilinos con nuestra plataforma integral de
                  satisfacción del inquilino
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <footer class="footer-section">
    <div class="container">
      <h2 style="color:#454545f0;" class="title">Streamline Your Rental Process</h2>
      <p class="subtitle">
        Tome buenas decisiones, comparta sus expericencias y apoye a otros
        arrendadores
      </p>
      <p>Potencie su negocio de alquiler</p>
      <div class="columns is-centered">
        <div class="column is-one-third">
          <p
            class="footer-input has-text-centered"
            style="
                background-color: #202523;
                color: #f5f5f5;
                text-decoration: chocolate;
                border-radius: 5px;
                height: 35px;
                padding-top: 5px;
                box-shadow: 7px 6px 4px rgb(99 88 88);
              ">
            Mejore su experiencia de alquiler
          </p>
        </div>
        <div class="column is-one-third">
          <p
            class="footer-input has-text-centered"
            style="
                background-color: #202523;
                color: #f5f5f5;
                text-decoration: chocolate;
                border-radius: 5px;
                height: 35px;
                padding-top: 5px;
                box-shadow: 7px 6px 4px rgb(99 88 88);
              ">
            Infórmese sobre sus inqulinos
          </p>
        </div>
      </div>
      <div class="columns is-centered">
        <div class="column is-half">
          <p
            class="footer-input has-text-centered"
            style="
                background-color: #202523;
                color: #f5f5f5;
                text-decoration: chocolate;
                border-radius: 5px;
                height: 35px;
                padding-top: 5px;
                box-shadow: 7px 6px 4px rgb(99 88 88);
              ">
            Descubra nuevas posibilidades
          </p>
        </div>
      </div>
      <a href="{{ route('1propiedades') }}"><button class="button is-success">Comenzar</button></a>
    </div>
  </footer>
</body>

</html>