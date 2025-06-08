@extends('admin.layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Criar Slide</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('Slider.index') }}">Slides</a></div>
      <div class="breadcrumb-item">Criar</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card shadow" style="border: none;">
          <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Novo Slide</h4>
            <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#helpModal">
              <i class="fas fa-question-circle"></i> Ajuda?
            </button>
          </div>
          <div class="card-body">
            <form action="{{ route('Slider.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="banner">Imagem (1300x500px)</label>
                <input type="file" name="banner" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                <div class="mt-3">
                  <img id="preview" src="{{ asset('backend/assets/img/placeholder.png') }}" class="img-fluid rounded" style="max-height: 200px;">
                </div>
              </div>

              <div class="form-group">
                <label for="title_one">Título 1</label>
                <input type="text" name="title_one" class="form-control" placeholder="Digite o Título" value="{{ old('title_one') }}">
              </div>

              <div class="form-group">
                <label for="title_two">Título 2</label>
                <input type="text" name="title_two" class="form-control" placeholder="Digite o Subtítulo" value="{{ old('title_two') }}">
              </div>

              <div class="form-group">
                <label for="starting_price">Valor</label>
                <input type="text" name="starting_price" class="form-control" placeholder="Digite o Valor" value="{{ old('starting_price') }}">
              </div>

              <div class="form-group">
                <label for="link">Link</label>
                <input type="url" name="link" class="form-control" placeholder="Digite o Link" value="{{ old('link') }}">
              </div>

              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                  <option value="1">Ativo</option>
                  <option value="0">Inativo</option>
                </select>
              </div>

              <div class="form-group">
                <label for="serial">Ordem</label>
                <input type="number" name="serial" class="form-control" placeholder="Digite a Ordem de Exibição" value="{{ old('serial') }}">
              </div>

              <div class="form-group d-flex justify-content-between">
                <a href="{{ route('Slider.index') }}" class="btn btn-secondary">
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
        <h5 class="modal-title" id="helpModalLabel">Ajuda para Cadastro de Slide</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="pl-3">
          <li>🔺 <strong>Imagem</strong>: Utilize uma imagem de 1300x500px para melhor visualização.</li>
          <li>📝 <strong>Título</strong>: Preencha com frases atrativas.</li>
          <li>💲 <strong>Valor</strong>: Pode ser um preço promocional.</li>
          <li>🔗 <strong>Link</strong>: Redirecione para o produto ou página desejada.</li>
          <li>📊 <strong>Status</strong>: Defina se o slide aparecerá no site.</li>
          <li>⬆ <strong>Ordem</strong>: Menores valores aparecem primeiro.</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Entendi</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function previewImage(event) {
    const output = document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = () => URL.revokeObjectURL(output.src);
  }
</script>
@endpush
