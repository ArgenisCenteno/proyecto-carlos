@extends('layouts.app')

@section('content')
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">

        <form method="POST" action="{{ route('login') }}">
          <h5 class="text-center">Iniciar sesión</h5>
          @csrf

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="email"> <strong>Email</strong> </label>

            <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus />
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="password"><strong>Contraseña</strong> </label>

            <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required />
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              
              <input class="form-check-input" type="checkbox" name="remember" id="remember" />
            </div>
            <a href="{{ route('register') }}">¿No estas registrado?</a>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block">Ingresar</button>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted"></p>
          </div>

         

        </form>
      </div>
    </div>
  </div>
</section>

@endsection
