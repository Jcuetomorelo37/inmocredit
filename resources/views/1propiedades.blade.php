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
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

  <!-- Sección de Propiedades -->
  <section class="section">
    <div class="container">
      <h1 class="title">Propiedades</h1>
      <!-- Botón para Agregar Nueva Propiedad -->
      <button class="button is-primary" id="btn_prim" onclick="openRegisterModal()">Registrar Nueva Propiedad</button>

      <!-- Lista de Propiedades -->
      <div class="box"></div>
    </div>
  </section>

  <!-- Modal para Registrar Nueva Propiedad -->
  <div class="modal" id="registerModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Registrar Nueva Propiedad</p>
        <button class="delete" aria-label="close" onclick="closeRegisterModal()"></button>
      </header>
      <section class="modal-card-body">
        <div class="field">
          <label class="label">Dirección</label>
          <div class="control">
            <input class="input" id="direccion" type="text" placeholder="Ejemplo: Apartamento en Calle 123" required />
          </div>
        </div>
        <div class="field">
          <label class="label">Ciudad</label>
          <div class="control">
            <input class="input" id="ciudad" type="text" placeholder="Ciudad o Dirección" required />
          </div>
        </div>
        <div class="field">
          <label class="label">Estado</label>
          <div class="control">
            <div class="select">
              <select id="estado">
                <option value="Disponible">Disponible</option>
                <option value="Ocupado">Ocupado</option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="No Disponible">No Disponible</option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label">ID del Propietario</label>
          <div class="control">
            <input class="input" id="id_propietario" type="number" placeholder="ID del propietario" />
          </div>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" onclick="saveProperty()">Guardar</button>
        <button class="button" onclick="closeRegisterModal()">Cancelar</button>
      </footer>
    </div>
  </div>

  <!-- Modal de Edición -->
  <div class="modal" id="editModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Editar Propiedad</p>
        <button class="delete" aria-label="close" onclick="closeEditModal()"></button>
      </header>
      <section class="modal-card-body">
        <input type="hidden" id="edit_id">
        <div class="field">
          <label class="label">Dirección</label>
          <div class="control">
            <input class="input" id="edit_direccion" type="text" required />
          </div>
        </div>
        <div class="field">
          <label class="label">Ciudad</label>
          <div class="control">
            <input class="input" id="edit_ciudad" type="text" required />
          </div>
        </div>
        <div class="field">
          <label class="label">Estado</label>
          <div class="control">
            <div class="select">
              <select id="edit_estado">
                <option value="Disponible">Disponible</option>
                <option value="Ocupado">Ocupado</option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="No Disponible">No Disponible</option>
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label">ID del Propietario</label>
          <div class="control">
            <input class="input" id="edit_id_propietario" type="text" />
          </div>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" onclick="updateProperty()">Confirmar</button>
        <button class="button" onclick="closeEditModal()">Cancelar</button>
      </footer>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      cargarPropiedades();
    });

    function cargarPropiedades() {
      fetch("/propiedades")
        .then(response => response.json())
        .then(data => {
          const propiedadContainer = document.querySelector(".box");
          propiedadContainer.innerHTML = "";
          data.forEach(propiedad => {
            const propiedadHtml = `
            <article class="media">
              <div class="media-content">
                <div class="content">
                  <p>
                    <strong>${propiedad.direccion}</strong> <br />
                    Ubicación: ${propiedad.ciudad} <br />
                    Estado: ${propiedad.estado}
                  </p>
                </div>
              </div>
              <div class="media-right">
                <span class="icon has-text-info" onclick="openEditModal(${propiedad.id_propiedad}, '${propiedad.direccion}', '${propiedad.ciudad}', '${propiedad.estado}', '${propiedad.id_propietario}')">
                  <i class="fas fa-edit"></i>
                </span>
                <span class="icon has-text-danger" onclick="confirmDelete(${propiedad.id_propiedad})">
                  <i class="fas fa-trash-alt"></i>
                </span>
              </div>
            </article>
            <hr />`;
            propiedadContainer.insertAdjacentHTML("beforeend", propiedadHtml);
          });
        })
        .catch(error => console.error("Error al cargar propiedades:", error));
    }

    function openRegisterModal() {
      document.getElementById("registerModal").classList.add("is-active");
    }

    function closeRegisterModal() {
      document.getElementById("registerModal").classList.remove("is-active");
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    function saveProperty() {
      const data = {
        direccion: document.getElementById('direccion').value,
        ciudad: document.getElementById('ciudad').value,
        estado: document.getElementById('estado').value,
        id_propietario: document.getElementById('id_propietario').value || null
      };

      fetch('/propiedades', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
          alert("Propiedad registrada exitosamente.");
          closeRegisterModal();
          cargarPropiedades();
        })
        .catch(error => console.error('Error:', error));
    }

    function openEditModal(id, direccion, ciudad, estado, id_propietario) {
      document.getElementById('edit_id').value = id;
      document.getElementById('edit_direccion').value = direccion;
      document.getElementById('edit_ciudad').value = ciudad;
      document.getElementById('edit_estado').value = estado;
      document.getElementById('edit_id_propietario').value = id_propietario || '';

      document.getElementById("editModal").classList.add("is-active");
    }

    function updateProperty() {
       
      const id = document.getElementById('edit_id').value;
      const data = {
        direccion: document.getElementById('edit_direccion').value,
        ciudad: document.getElementById('edit_ciudad').value,
        estado: document.getElementById('edit_estado').value,
        id_propietario: document.getElementById('edit_id_propietario').value || null
      };

      fetch(`/propiedades/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
          alert("Propiedad actualizada exitosamente.");
          closeEditModal();
          cargarPropiedades();
        })
        .catch(error => console.error('Error:', error));
    }

    function closeEditModal() {
      document.getElementById("editModal").classList.remove("is-active");
    }

    function confirmDelete(id) {
      if (confirm("¿Estás seguro de que deseas eliminar esta propiedad?")) {
        fetch(`/propiedades/${id}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': csrfToken
            }
          })
          .then(response => response.json())
          .then(data => {
            alert("Propiedad eliminada exitosamente.");
            cargarPropiedades();
          })
          .catch(error => console.error('Error:', error));
      }
    }
  </script>
</body>

</html>