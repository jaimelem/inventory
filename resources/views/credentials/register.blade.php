@extends('base_credentials')
@section('content')
<section class="bg-light py-3 py-md-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            @if($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
          <div class="card border border-light-subtle rounded-3 shadow-sm">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Ingrese su información para registrarse</h2>
              <form  action="{{ url('action-register') }}" method="POST">
                @csrf
                <div class="row gy-2 overflow-hidden">
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" required>
                      <label for="firstName" class="form-label">Nombre(s)</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
                      <label for="lastName" class="form-label">Apellidos(s)</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                      <label for="email" class="form-label">Correo</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                      <label for="password" class="form-label">Contraseña</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="d-grid my-3">
                      <button class="btn btn-primary btn-lg" type="submit">Registrarse</button>
                    </div>
                  </div>
                  <div class="col-12">
                    <p class="m-0 text-secondary text-center">Ya tienes una cuenta? <a href="{{ url('/login') }}" class="link-primary text-decoration-none">Iniciar Sesión</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
