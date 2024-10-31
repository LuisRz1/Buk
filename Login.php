<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-4C2PxmMj1ZI8Y+9H54uN5IsZ6pJuhtO5YOb7WnHk/KR4J6XGz9znTyy7RzyffsVH" crossorigin="anonymous"/>
  <link rel="stylesheet" href="public/css/Login.css"/>
  <title>New Login</title>
</head>
<body>
  <div class="container">

    <a class="Empresa" href="Index.html">
      BUK
    </a>

    <form action="Clases/Usuario.php" method="post" class="login" onsubmit="return validateForm(event)">
      <h2>Iniciar Sesión</h2>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" id="email" placeholder="email" required autofocus>
        <label for="email"><i class="fas fa-envelope"></i> Email</label>
      </div>

      <div class="form-floating mb-3">
        <input type="password" class="form-control" name="password" id="password" placeholder="password" required/>
        <label for="password"><i class="fas fa-solid fa-lock"></i> Password</label>
        <div id="passwordError" class="error-message"></div>
      </div>

      <button class="btn-1 btn btn-dark" type="submit">Iniciar Sesión</button>

      <p>
        ¿No estás registrado?
        <a class="phrase" href="Registro.php">
          Regístrate Ahora
        </a>
      </p>
    </form>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/761684499b.js" crossorigin="anonymous"></script>
  <script>
    function validateForm(event) {
      event.preventDefault(); // Evita el envío del formulario

      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      var passwordError = document.getElementById('passwordError');
      passwordError.innerHTML = ''; // Limpiar mensajes de error previos

      // Validación del frontend
      if (password.length < 8) {
        passwordError.innerHTML = 'La contraseña debe tener al menos 8 caracteres.';
        passwordError.style.color = 'red';
        return false;
      }

      // Crear el FormData para enviar los datos
      var formData = new FormData();
      formData.append('email', email);
      formData.append('password', password);

      // Enviar la solicitud al backend usando fetch
      fetch('Clases/Usuario.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Redirigir según el rol
          if (data.rol === 'trabajador') {
            window.location.href = 'homeJefe.html';
          } else if (data.rol === 'postulante') {
            window.location.href = 'homePostulante.html';
          }
        } else {
          // Mostrar el mensaje de error en el campo de contraseña
          passwordError.innerHTML = data.message;
          passwordError.style.color = 'red';
        }
      })
      .catch(error => console.error('Error:', error));

      return false; // Para evitar el envío normal del formulario
    }
  </script>
</body>
</html>
