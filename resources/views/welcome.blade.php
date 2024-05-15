<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Multimin - Sistema</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <title>{{ config('app.name', 'Multimin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50 bg-dark" data-bs-theme="dark">
        
                   <header class="border-bottom border-white">
                   
                    {{-- Anterior header --}}
                    <nav class="container-md navbar navbar-expand-lg" data-bs-theme="dark">
                        <div class="container-fluid">
                          <a class="navbar-brand" href="#">Multimin</a>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                              <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="https://multimin.com.mx">Inicio</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="/admin">Iniciar Sesión</a>
                              </li>
                              {{-- <li class="nav-item">
                                <a class="nav-link" href="/register">Crear Cuenta</a>
                              </li> --}}
                            </ul>
                            <span class="navbar-text">
                              
                            </span>
                          </div>
                        </div>
                      </nav>
                   </header>

                   <main class="container-md py-5">
                      {{-- Aquí iniciamos con las cards para redirigir al usuario a los diferentes destinos --}}

                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                          <img src="/storage/images_site/multimin-logo.png" alt="Logo de multimin">
                        </div>
                      </div>
                    </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Registra tu Ticket</h5>
                              <p class="card-text">Para registrar un ticket tienes que crear una cuenta, si ya la tienes solo inicia sesión.</p>
                              <a href="/admin" class="btn btn-primary">Registrar Ticket</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Crear Cuenta</h5>
                              <p class="card-text">Para registrar un ticket primero debes crear una cuenta, solicitala por medio de correo con tu asesor de ventas multimin.</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Reestablecer la contraseña</h5>
                              <p class="card-text">Para reestablecer la contraseña lo realizaremos a través de tu correo electrónico, solicitalo aquí.</p>
                              <a href="/forgot-password" class="btn btn-primary">Reestablecer Contraseña</a>
                            </div>
                          </div>
                        </div>
                      </div>
                   </main>

                    <footer class="text-center p-20" data-bs-theme="dark">
                        Multimin - Sistema
                    </footer>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
