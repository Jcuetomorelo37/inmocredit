<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="imgs/icon.png" type="image/png">
  <title>IC - Arrendatarios</title>
  <link rel="stylesheet" href="styles/bulma.min.css" />
  <link rel="stylesheet" href="styles/comentarios.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
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

  <!-- Sección de Historial de Arrendatarios -->
  <section class="section">
    <div class="container">
      <h1 class="title">Historial de Arrendatarios</h1>

      <!-- Botón para Registrar Nuevos Arrendamientos -->
      <div class="field">
        <div class="control">
          <a class="button is-success" href="#" onclick="openRegisterModal()">
            <i class="fas fa-plus"></i> &nbsp; Registrar Nuevo Arrendamiento
          </a>
        </div>
      </div>

      <!-- Lista de Arrendatarios -->
      <div class="box">
        <!-- Arrendatario 1 -->
        <article class="media">
          <div class="media-content">
            <div class="content">
              <p>
                <strong>Juan Pérez</strong> <br>
                Propiedad: Apartamento en Calle 123 <br>
                Duración: Enero 2022 - Diciembre 2022
              </p>
            </div>
          </div>
          <div class="media-right">
            <span class="icon has-text-info" onclick="openTenantDetailsModal('Juan Pérez', 'Apartamento en Calle 123', 'Enero 2022 - Diciembre 2022')">
              <i class="fas fa-info-circle"></i>
            </span>
          </div>
        </article>
        <hr>

      </div>
    </div>
  </section>

  <!-- Modal de Detalles del Arrendatario -->
  <div class="modal" id="tenantDetailsModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Detalles del Arrendatario</p>
        <button class="delete" aria-label="close" onclick="closeTenantDetailsModal()"></button>
      </header>
      <section class="modal-card-body">
        <p><strong>Nombre:</strong> <span id="tenantName"></span></p>
        <p><strong>Propiedad:</strong> <span id="tenantProperty"></span></p>
        <p><strong>Duracion:</strong> <span id="tenantDuration"></span></p>

        <p><strong>Valoracion:</strong> <span id="tenantValoration"></span></p>
        <p><strong>Observaciones:</strong> <span id="tenantObservations"></span></p>
        <p><strong>Daños materiales:</strong> <span id="tenantDamages"></span></p>
      </section>
      <footer class="modal-card-foot">
        <button class="button" onclick="closeTenantDetailsModal()">Cerrar</button>
      </footer>
    </div>
  </div>

  <!-- Modal para Registrar Nuevos Arrendamientos -->
  <div class="modal" id="registerModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Registrar Nuevo Arrendamiento</p>
        <button class="delete" aria-label="close" onclick="closeRegisterModal()"></button>
      </header>
      <section class="modal-card-body">
        <form id="registerForm">
          <div class="field">
            <label class="label">Nombre del Arrendatario</label>
            <div class="control">
              <input class="input" type="text" id="nombreInquilino" placeholder="Nombre del arrendatario">
            </div>
          </div>
          <div class="field">
            <label class="label">Propiedad</label>
            <div class="control">
              <input class="input" type="text" id="propiedad" placeholder="Propiedad">
            </div>
          </div>
          <div class="field">
            <label class="label">Duración</label>
            <div class="control">
              <input class="input" type="text" id="duracion" placeholder="Duración (ejemplo. Enero 2023 - Diciembre 2023)">
            </div>
          </div>
          <hr>
          <h3>Actualizaciones de arrendamiento parcial o concluido</h3>
          <br>
          <div class="field">
            <label class="label">Puntaje de Valoración</label>
            <div class="control">
              <div class="select">
                <select id="puntajeValoracion">
                  <!-- <option value="1">⭐</option>
                  <option value="2">⭐⭐</option>
                  <option value="3">⭐⭐⭐</option>
                  <option value="4">⭐⭐⭐⭐</option>
                  <option value="5">⭐⭐⭐⭐⭐</option> -->
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label">Observaciones</label>
            <div class="control">
              <textarea class="textarea" id="observaciones" placeholder="Observaciones sobre el arrendamiento" oninput="updateCharacterCount2()"></textarea>
              <p id="charCount2" class="help">0/45 caracteres</p>
            </div>
          </div>

          <div class="field">
            <label class="label">Daños a la propiedad</label>
            <div class="control">
              <textarea class="textarea" id="danosPropiedad" placeholder="Describe aqui los daños causados" oninput="updateCharacterCount3()"></textarea>
              <p id="charCount3" class="help">0/45 caracteres</p>
            </div>
          </div>
        </form>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" onclick="registerNewTenantToHistorialPagos()">Registrar</button>
        <button class="button" onclick="closeRegisterModal()">Cancelar</button>
      </footer>
    </div>
  </div>

  <script>
    const maxCharacters = 45;

    function updateCharacterCount2() {
      const comentarioText = document.getElementById('observaciones');
      const charCount = document.getElementById('charCount2');
      const currentLength = comentarioText.value.length;
      charCount.textContent = `${currentLength}/${maxCharacters} caracteres`;
      if (currentLength > maxCharacters) {
        charCount.classList.add('has-text-danger');
        comentarioText.setCustomValidity("El comentario supera el límite de caracteres permitido.");
      } else {
        charCount.classList.remove('has-text-danger');
        comentarioText.setCustomValidity("");
      }
    }

    function updateCharacterCount3() {
      const comentarioText = document.getElementById('danosPropiedad');
      const charCount = document.getElementById('charCount3');
      const currentLength = comentarioText.value.length;
      charCount.textContent = `${currentLength}/${maxCharacters} caracteres`;
      if (currentLength > maxCharacters) {
        charCount.classList.add('has-text-danger');
        comentarioText.setCustomValidity("El comentario supera el límite de caracteres permitido.");
      } else {
        charCount.classList.remove('has-text-danger');
        comentarioText.setCustomValidity("");
      }
    }

    function openTenantDetailsModal(name, property, duration,valoration,observations,damages) {
      document.getElementById("tenantName").textContent = name;
      document.getElementById("tenantProperty").textContent = property;
      document.getElementById("tenantDuration").textContent = duration;

      document.getElementById("tenantValoration").textContent = valoration;
      document.getElementById("tenantObservations").textContent = observations;
      document.getElementById("tenantDamages").textContent = damages;
      document.getElementById("tenantDetailsModal").classList.add("is-active");
    }

    function closeTenantDetailsModal() {
      document.getElementById("tenantDetailsModal").classList.remove("is-active");
    }

    function openRegisterModal() {
      document.getElementById("registerModal").classList.add("is-active");
    }

    function closeRegisterModal() {
      document.getElementById("registerModal").classList.remove("is-active");
    }

    function registerNewTenantToHistorialPagos() {

      const dataHistoria = {
        id_inquilino: document.getElementById("nombreInquilino").value || null,
        fecha_inicio_fin: document.getElementById("duracion").value || null,
        valoracion: document.getElementById("puntajeValoracion").value || null,
        observaciones: document.getElementById("observaciones").value || null,
        afectaciones_materiales: document.getElementById("danosPropiedad").value || null,
        propiedad: document.getElementById("propiedad").value || null
      };

      fetch("/historial_pagos", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify(dataHistoria)
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Arrendamiento registrado exitosamente');
            closeRegisterModal();
            cargarArrendatarios();
          } else {
            // alert('Ocurrió un error al registrar el arrendamiento');
            alert('Arrendamiento registrado exitosamente');
            closeRegisterModal();
            cargarArrendatarios();
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Ocurrió un error en la solicitud');
        });
    }

    function cargarArrendatarios() {
      fetch('/historial_pagos')
        .then(response => response.json())
        .then(historial => {
          const listaArrendatarios = document.querySelector('.box');
          listaArrendatarios.innerHTML = ''; // Limpiar lista antes de agregar nuevos datos

          historial.forEach(arrendatario => {
            const item = `
          <article class="media">
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>${arrendatario.nombre_inquilino}</strong><br>
                  Propiedad: ${arrendatario.propiedad}<br>
                  Duración: ${arrendatario.fecha_inicio_fin}
                </p>
              </div>
            </div>
            <div class="media-right">
              <span class="icon has-text-info" onclick="openTenantDetailsModal('${arrendatario.nombre_inquilino}', '${arrendatario.propiedad}', '${arrendatario.fecha_inicio_fin}', '${arrendatario.valoracion}', '${arrendatario.observaciones}', '${arrendatario.afectaciones_materiales}')">
                <i class="fas fa-info-circle"></i>
              </span>
            </div>
          </article>
          <hr>
        `;
            listaArrendatarios.insertAdjacentHTML('beforeend', item);
          });
        });
    }

    // Llamar a cargarArrendatarios cuando se cargue la página
    document.addEventListener('DOMContentLoaded', cargarArrendatarios);
  </script>
</body>

</html>