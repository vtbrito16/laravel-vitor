
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Esqueceu a Senha</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{asset('backend/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap-social/bootstrap-social.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{asset('backend/assets/css/components.css') }}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body style="background:#410454;">
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{asset('backend/assets/img/logovtbrito.png') }}" alt="vtbrito - marketplace" width="100" class="shadow-light" style="width: 100%; height: auto; box-shadow:none; border:none;">
            </div>

            <div class="card card-primary"  style="border:none; background:#270432; color: #fff;" >
            <div class="card-header"><h4>Recuperar Senha</h4></div>
             <br>
               @if (session('status'))
               <p class="alert alert-warning">
                 uma mensagem de recuperação de senha foi enviada para o e-mail informado.
               </p>
               @endif

              <div class="card-body">
                <form  action="{{ route('password.email') }}" class="needs-validation"  method="post" novalidate="">
                @csrf
                <div class="form-group">

                    <input id="email" type="email" class="form-control" name="email" placeholder="E-mail de Acesso" tabindex="1" value="{{old('email') }}" required autofocus>
                    @if($errors->has('email'))
                    @error('email')
                      <code>{{ $message }}</code>
                    @enderror
                    @endif

                </div>
                     
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="font-size: 20px; background: #f3d300; color: #000;" tabindex="4">
                      Recuperar
                    </button>
                  </div>
                    <p style="text-align:center;">
                    <a href="{{ route('admin.login') }}" title="voltar para login" style="color:#fff">Voltar para Login</a>
                    </p>
                </form>

              </div>
            </div>
            <div class="mt-5 text-muted text-center" style="color: #fff;">
             Criado por <a href="https://vtbrito.com.br/" style="color: #fff;">Vitor Daniel</a>
            </div>
            <div class="simple-footer" style="color: #fff;">
              Todos os Direitos Reservados &copy; <?= date('d/m/y')?> vtbrito.com.br
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('backend/assets/modules/jquery.min.js') }}"></script>
  <script src="{{asset('backend/assets/modules/popper.js') }}"></script>
  <script src="{{asset('backend/assets/modules/tooltip.js') }}"></script>
  <script src="{{asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{asset('backend/assets/modules/moment.min.js') }}"></script>
  <script src="{{asset('backend/assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{asset('backend/assets/js/scripts.js') }}"></script>
  <script src="{{asset('backend/assets/js/custom.js') }}"></script>
</body>
</html>
