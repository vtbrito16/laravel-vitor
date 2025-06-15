@extends('admin.layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Criar Categoria</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('categoria.index') }}">Categorias</a></div>
      <div class="breadcrumb-item">Criar</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-folder-plus mr-2"></i> Nova Categoria</h4>
            <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#helpModal">
              <i class="fas fa-question-circle"></i> Ajuda
            </button>
          </div>

          <div class="card-body">
            <form action="{{ route('categoria.store') }}" method="POST">
              @csrf

              {{-- Ícone --}}
              <div class="form-group">
                <label class="font-weight-bold d-block mb-2">Ícone</label>
                <button
                  type="button"
                  class="btn btn-primary iconpicker-control"
                  data-icon="{{ old('icone', 'fas fa-award') }}"
                  role="iconpicker"
                ></button>
                <input type="hidden" name="icone" id="icone" value="{{ old('icone', 'fas fa-award') }}">
                @error('icone')
                  <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>

              {{-- Nome --}}
              <div class="form-group">
                <label for="nome" class="font-weight-bold">Nome da Categoria</label>
                <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Digite o nome da categoria" value="{{ old('nome') }}" required>
                @error('nome')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Status --}}
              <div class="form-group">
                <label for="status" class="font-weight-bold">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                  <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Ativo</option>
                  <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inativo</option>
                </select>
                @error('status')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Ações --}}
              <div class="form-group d-flex justify-content-between">
                <a href="{{ route('categoria.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-save"></i> Salvar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal de Ajuda -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="helpModalLabel">Ajuda para Cadastro de Categoria</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="pl-3">
          <li>🎨 <strong>Ícone</strong>: Escolha um ícone que represente visualmente a categoria.</li>
          <li>📝 <strong>Nome</strong>: Use um nome claro e objetivo. Ex: “Tecnologia”, “Beleza”, etc.</li>
          <li>👁 <strong>Status</strong>: Ativo aparece no site, Inativo fica oculto.</li>
          <li>🧩 <strong>Organização</strong>: As categorias ajudam a organizar os produtos ou conteúdos do sistema.</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Entendi</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}">
<style>
  .iconpicker-control {
    width: 60px;
    height: 40px;
    font-size: 1.25rem !important;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .iconpicker .iconpicker-item > i {
    font-size: 1.3rem !important;
    width: 2rem;
    height: 2rem;
  }

  .iconpicker-popover.popover {
    z-index: 2050 !important;
  }

  .iconpicker .iconpicker-item {
    margin: 5px !important;
  }
</style>
@endpush

@push('scripts')
<script src="{{ asset('backend/assets/modules/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script>
  $(function () {
    $('.iconpicker-control').iconpicker().on('change', function(e) {
      $('#icone').val(e.icon); // Salva no campo oculto
    });
  });
</script>

<!-- Toastr -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  @if (Session::has('toastr'))
    toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: 'toast-top-right'
    };
    toastr["{{ Session::get('toastr.type', 'success') }}"]("{{ Session::get('toastr.message') }}");
  @endif
</script>
@endpush
