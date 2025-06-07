@extends('admin.layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Meus dados</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
      <div class="breadcrumb-item">Perfil</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row mt-sm-4 justify-content-center">

      {{-- BLOCO: Atualizar Perfil --}}
      <div class="col-12 col-md-10 col-lg-6 mb-4">
        <div class="card shadow-sm">
          <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
              <h4><i class="bi bi-person-circle me-1"></i> Atualizar Perfil</h4>
            </div>
            <div class="card-body">

              <div class="form-group text-center">
                <img id="previewImage" src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('backend/assets/img/avatar/avatar-1.png') }}"
     class="rounded-circle border" alt="Foto de Perfil"
     style="width: 160px; height: 160px; object-fit: cover;">
                <div class="mt-2">
                  <label class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-upload me-1"></i> Escolher nova imagem
                    <input type="file" name="image" class="d-none" id="imageInput">
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Digite seu nome completo" required>
              </div>

              <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="exemplo@email.com" required>
              </div>

            </div>
            <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Salvar
              </button>
            </div>
          </form>
        </div>
      </div>

      {{-- BLOCO: Alterar Senha --}}
      <div class="col-12 col-md-10 col-lg-6">
        <div class="card shadow-sm">
          <form action="{{ route('admin.profile.password') }}" method="POST">
            @csrf
            <div class="card-header">
              <h4><i class="bi bi-shield-lock me-1"></i> Redefinir Senha</h4>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label>Senha Atual</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Digite sua senha atual" required>
                  <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('current_password')">
                    <i class="bi bi-eye" id="icon-current_password"></i>
                  </button>
                </div>
              </div>

              <div class="form-group mt-3">
                <label>Nova Senha</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Nova senha (mínimo 8 caracteres)" required oninput="checkPasswordStrength()">
                  <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">
                    <i class="bi bi-eye" id="icon-password"></i>
                  </button>
                </div>
                <small id="password-strength-text" class="form-text mt-1"></small>
                <div class="progress mt-1" style="height: 5px;">
                  <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                </div>
              </div>

              <div class="form-group mt-3">
                <label>Confirmar Nova Senha</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirme a nova senha" required>
                  <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">
                    <i class="bi bi-eye" id="icon-password_confirmation"></i>
                  </button>
                </div>
              </div>

            </div>
            <div class="card-footer text-end">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-lock me-1"></i> Atualizar Senha
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  // Preview da imagem de perfil
  document.getElementById('imageInput')?.addEventListener('change', function (e) {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById('previewImage').src = e.target.result;
    };
    reader.readAsDataURL(e.target.files[0]);
  });

  // Alternar visualização de senha
  function togglePassword(fieldId) {
    const input = document.getElementById(fieldId);
    const icon = document.getElementById('icon-' + fieldId);
    const isPassword = input.type === 'password';

    input.type = isPassword ? 'text' : 'password';
    icon.classList.toggle('bi-eye', !isPassword);
    icon.classList.toggle('bi-eye-slash', isPassword);
  }

  // Verificar força da senha
  function checkPasswordStrength() {
    const password = document.getElementById("password").value;
    const strengthBar = document.getElementById("password-strength-bar");
    const strengthText = document.getElementById("password-strength-text");

    let strength = 0;

    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[\W]/.test(password)) strength++;

    let width = strength * 20;
    strengthBar.style.width = width + "%";

    if (strength <= 2) {
      strengthBar.className = "progress-bar bg-danger";
      strengthText.textContent = "Senha fraca";
      strengthText.style.color = "#dc3545";
    } else if (strength === 3 || strength === 4) {
      strengthBar.className = "progress-bar bg-warning";
      strengthText.textContent = "Senha média";
      strengthText.style.color = "#ffc107";
    } else {
      strengthBar.className = "progress-bar bg-success";
      strengthText.textContent = "Senha forte";
      strengthText.style.color = "#28a745";
    }
  }
</script>
@endpush
