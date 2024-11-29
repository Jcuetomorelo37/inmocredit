<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="imgs/icon.png" type="image/png">
  <title>IC - Comentarios</title>
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

        <div class="navbar-item">
          <div class="field has-addons">
            <div class="control is-expanded">
              <input class="input" type="text" placeholder="Buscar...">
            </div>
            <div class="control">
              <button class="button is-info">
                Buscar
              </button>
            </div>
          </div>
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

  <section class="section">
    <div class="container">
      <h1 class="title">Comentarios sobre Arrendatarios</h1>

      <!-- Contenedor de comentarios cargados dinámicamente -->
      <div class="box" id="comentariosContainer"></div>

      <div class="box">
        <h1 class="title">Hola arrendador!</h1>
        <h2 class="subtitle">En esta sección puedes publicar tus opiniones sobre los arrendatarios que has tenido!</h2>
        <form onsubmit="event.preventDefault(); publishComentario();">
          <div class="field">
            <label class="label">Nombre de tu Arrendatario</label>
            <div class="control">
              <input class="input" type="text" id="nombreArrendatario" placeholder="Nombre del arrendatario" required>
            </div>
          </div>

          <div class="field">
            <label class="label">Comentario</label>
            <div class="control">
              <textarea class="textarea" id="comentarioText" placeholder="Escribe tu comentario sobre el arrendatario" required oninput="updateCharacterCount()"></textarea>
              <p id="charCount" class="help">0/45 caracteres</p>
            </div>
          </div>

          <div class="field">
            <label class="label">Tu Nombre</label>
            <div class="control">
              <input class="input" type="text" id="publicante" placeholder="Tu nombre" required>
            </div>
          </div>

          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link">Publicar</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </section>

  <!-- Modal de Edición -->
  <div class="modal" id="editModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Editar Comentario</p>
        <button class="delete" aria-label="close" onclick="closeEditModal()"></button>
      </header>
      <section class="modal-card-body">
        <div class="field">
          <label class="label">Comentario</label>
          <div class="control">
            <textarea class="textarea" id="editComentarioText">Texto del comentario a editar...</textarea>
          </div>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" onclick="confirmEdit()">Confirmar</button>
        <button class="button" onclick="closeEditModal()">Cancelar</button>
      </footer>
    </div>
  </div>

  <script>
    let comentarioIdToEdit = null;
    const maxCharacters = 45;

    function updateCharacterCount() {
    const comentarioText = document.getElementById('comentarioText');
    const charCount = document.getElementById('charCount');
    
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


    // function loadComentarios() {
    //     fetch('/comentarios')
    //         .then(response => response.json())
    //         .then(data => {
    //             const container = document.getElementById('comentariosContainer');
    //             container.innerHTML = '';
    //             data.forEach(comment => {
    //                 // Convierte el nombre a minúsculas y quita los espacios
    //                 const nombreFormateado = comment.publicante.toLowerCase().replace(/\s+/g, '');

    //                 container.innerHTML += `
    //                   <article class="media">
    //                     <figure class="media-left">
    //                       <p class="image is-64x64">
    //                         <img src="imgs/MdiCommentAccountOutline.png">
    //                       </p>
    //                     </figure>
    //                     <div class="media-content">
    //                       <div class="content">
    //                         <p>
    //                           <div id="nomformatstrong" ><strong>${comment.publicante}</strong> &nbsp &nbsp <h4 class="is-light">@${nombreFormateado}</h4></div>
    //                           <br>Arrendatario: <strong>${comment.nombre_arrendatario}</strong>
    //                           <br>${comment.comentario}
    //                         </p>
    //                       </div>
    //                     </div>
    //                     <div class="media-right">
    //                       <span class="icon has-text-info" onclick="openEditModal(${comment.id_comentarios})">
    //                         <i class="fas fa-edit"></i>
    //                       </span>
    //                       <span class="icon has-text-danger" onclick="deleteComentario(${comment.id_comentarios})">
    //                         <i class="fas fa-trash-alt"></i>
    //                       </span>
    //                     </div>
    //                   </article><hr>`;
    //             });
    //         });
    // }

    let comentarios = []; 

    function loadComentarios() {
      fetch('/comentarios')
        .then(response => response.json())
        .then(data => {
          comentarios = data; 
          renderComentarios(data); 
        });
    }

    function renderComentarios(data) {
      const container = document.getElementById('comentariosContainer');
      container.innerHTML = '';
      data.forEach(comment => {
        const nombreFormateado = comment.publicante.toLowerCase().replace(/\s+/g, '');
        container.innerHTML += `
          <article class="media">
            <figure class="media-left">
              <p class="image is-64x64">
                <img src="imgs/MdiCommentAccountOutline.png">
              </p>
            </figure>
            <div class="media-content">
              <div class="content">
                <p>
                  <div id="nomformatstrong" ><strong>${comment.publicante}</strong> &nbsp &nbsp <h4 class="is-light">@${nombreFormateado}</h4></div>
                  <br>Arrendatario: <strong>${comment.nombre_arrendatario}</strong>
                  <br>${comment.comentario}
                </p>
              </div>
            </div>
            <div class="media-right">
              <span class="icon has-text-info" onclick="openEditModal(${comment.id_comentarios})">
                <i class="fas fa-edit"></i>
              </span>
              <span class="icon has-text-danger" onclick="deleteComentario(${comment.id_comentarios})">
                <i class="fas fa-trash-alt"></i>
              </span>
            </div>
          </article><hr>`;
      });
    }

    function searchComentarios() {
      const searchQuery = document.querySelector('.input').value.toLowerCase();
      const filteredComentarios = comentarios.filter(comment =>
        comment.nombre_arrendatario.toLowerCase().includes(searchQuery) ||
        comment.comentario.toLowerCase().includes(searchQuery) ||
        comment.publicante.toLowerCase().includes(searchQuery)
      );
      renderComentarios(filteredComentarios);
    }

    document.querySelector('.button.is-info').addEventListener('click', searchComentarios);
    document.querySelector('.input').addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        searchComentarios();
      }
    });


    function publishComentario() {
      const nombreArrendatario = document.getElementById('nombreArrendatario').value;
      const comentario = document.getElementById('comentarioText').value;
      const publicante = document.getElementById('publicante').value;
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 

      fetch('/comentarios', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            nombre_arrendatario: nombreArrendatario,
            comentario,
            publicante
          })
        })
        .then(response => {
          if (!response.ok) throw new Error("Error al publicar el comentario.");
          return response.json();
        })
        .then(() => {
          loadComentarios(); // Recarga los comentarios después de publicar uno nuevo
          alert('Comentario publicado');
        })
        .catch(error => console.error('Error al publicar comentario:', error));
    }


    function openEditModal(id) {
      comentarioIdToEdit = id;
      fetch(`/comentarios/${id}`)
        .then(response => {
          if (!response.ok) {
            throw new Error("No se pudo obtener el comentario.");
          }
          return response.json();
        })
        .then(data => {
          document.getElementById('editComentarioText').value = data.comentario;
          document.getElementById('editModal').classList.add('is-active');
        })
        .catch(error => alert("Error: " + error.message));
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.remove('is-active');
    }

    function confirmEdit() {
      const comentario = document.getElementById('editComentarioText').value;
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      fetch(`/comentarios/${comentarioIdToEdit}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            comentario
          })
        })
        .then(response => {
          if (!response.ok) throw new Error("Error al actualizar el comentario.");
          return response.json();
        })
        .then(() => {
          closeEditModal();
          loadComentarios();
          alert('Comentario actualizado');
        })
        .catch(error => console.error('Error al actualizar comentario:', error));
    }


    function deleteComentario(id) {
      if (confirm('¿Estás seguro de que deseas eliminar este comentario?')) {
        fetch(`/comentarios/${id}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Content-Type': 'application/json',
            }
          })
          .then(response => response.json())
          .then(() => {
            loadComentarios();
            alert('Comentario eliminado');
          })
          .catch(error => alert("Error: " + error.message));
      }
    }


    document.addEventListener('DOMContentLoaded', loadComentarios);
  </script>

</body>

</html>