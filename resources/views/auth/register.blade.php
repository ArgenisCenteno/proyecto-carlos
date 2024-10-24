@extends('layouts.app')

@section('content')
<!-- Section: Design Block -->
<section class="text-center bg-light" style="margin-top: 100px; ">
  <div class="mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
        margin-top: -100px;
        backdrop-filter: blur(30px);
        ">
    <div class="py-5 px-md-5 pr-md-5">

      <div class="row d-flex justify-content-center pt-5 pb-5"  style="border-radius: 12px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Registro</h2>

          <!-- Formulario de registro -->
          <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf <!-- Token CSRF para Laravel -->

            <!-- Nombre y Correo Electrónico -->
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-outline">
                  <label class="form-label" for="name"><strong>Nombre</strong></label>
                  <input type="text" id="name" name="name" placeholder="Ingrese nombre" class="form-control" required />
                  @error('name')
            <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
          @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-outline">
                  <label class="form-label" for="email"><strong>Email</strong></label>
                  <input type="email" id="email" name="email" placeholder="Ingrese Email" class="form-control"
                    required />
                  @error('email')
            <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
          @enderror
                </div>
              </div>
            </div>

            <!-- Cédula de Identidad y Teléfono -->
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-outline">
                  <label class="form-label" for="cedula"><strong>Cédula </strong></label>
                  <input type="text" id="cedula" name="cedula" placeholder="Ingrese cédula" class="form-control"
                    required />
                  <p class="text-danger" id="cedulaError" style="display: none;">Cédula inválida.</p>
                  @error('dni')
            <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
          @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-outline">
                  <label class="form-label" for="phone"><strong>Teléfono</strong></label>
                  <input type="text" id="phone" name="phone" class="form-control" placeholder="Ingrese Teléfono"
                    required />
                </div>
              </div>
            </div>

            <!-- Sector, Calle, Casa y Referencia -->
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-outline">
                  <label class="form-label" for="sector"><strong>Sector</strong></label>
                  <input type="text" id="sector" placeholder="Ingrese sector" name="sector" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-outline">
                  <label class="form-label" for="calle"><strong>Calle</strong></label>
                  <input type="text" id="calle" name="calle" placeholder="Ingrese calle" class="form-control" />
                </div>
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-outline">
                  <label class="form-label" for="casa"><strong>Casa</strong></label>
                  <input type="text" id="casa" name="casa" placeholder="Ingrese Casa" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-outline">
                  <label class="form-label" for="referencia"><strong>Referencia</strong></label>
                  <input type="text" id="referencia" name="referencia" placeholder="Ingrese referencia de la casa"
                    class="form-control" />
                </div>
              </div>
            </div>

            <!-- Contraseña -->
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-outline position-relative">
                  <label class="form-label" for="password"><strong>Contraseña</strong></label>
                  <input type="password" id="password" placeholder="Ingrese contraseña" name="password" class="form-control" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-outline position-relative">
                  <label class="form-label" for="gender"><strong>Género</strong></label>
                  <select id="gender" name="genero" class="form-control" required>
                    <option value="" disabled selected>Seleccione su género</option>
                    <option value="male">Masculino</option>
                    <option value="female">Femenino</option>
                    <option value="other">Otro</option>
                  </select>
                </div>
              </div>

            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-dark btn-lg mb-4">
              Registrarse
            </button>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->

<!-- Scripts para validar cédula y contraseñas -->
<script>
  document.getElementById('registerForm').addEventListener('submit', function (event) {
    // Obtener valores
    const cedula = document.getElementById('cedula').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    let valid = true;

    // Validar cédula (7 u 8 dígitos, sin letras, y no puede empezar con cero)
    const cedulaPattern = /^[1-9][0-9]{6,7}$/;
    if (!cedulaPattern.test(cedula)) {
      valid = false;
      document.getElementById('cedulaError').style.display = 'block';
    } else {
      document.getElementById('cedulaError').style.display = 'none';
    }

  });


</script>
@endsection