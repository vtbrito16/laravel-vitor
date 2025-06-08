@extends('admin.layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Editar Slide</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('Slider.index') }}">Slides</a></div>
      <div class="breadcrumb-item">Editar</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card shadow" style="border: none;">
          <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Editar Slide</h4>
            <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#helpModal">
              <i class="fas fa-question-circle"></i> Ajuda?
            </button>
          </div>
          <div class="card-body">
            <form action="{{ route('Slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="form-group">
                <label for="banner">Imagem (1300x500px)</label>
                <input type="file" name="banner" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                <div class="mt-3">
                  <img id="preview" src="{{ asset($slider->banner) }}" class="img-fluid rounded" style="max-height: 200px;">
                </div>
              </div>

              <div class="form-group">
                <label for="title_one">Título 1</label>
                <input type="text" name="title_one" class="form-control" placeholder="Digite o Título" value="{{ old('title_one', $slider->title_one) }}">
              </div>

              <div class="form-group">
                <label for="title_two">Título 2</label>
                <input type="text" name="title_two" class="form-control" placeholder="Digite o Subtítulo" value="{{ old('title_two', $slider->title_two) }}">
              </div>

              <div class="form-group">
                <label for="starting_price">Valor</label>
                <input type="text" name="starting_price" class="form-control" placeholder="Digite o Valor" value="{{ old('starting_price', $slider->starting_price) }}">
              </div>

              <div class="form-group">
                <label for="link">Link</label>
                <input type="url" name="link" class="form-control" placeholder="Digite o Link" value="{{ old('link', $slider->link) }}">
              </div>

              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                  <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Ativo</option>
                  <option value="0" {{ $slider->status == 0 ? 'selected' : '' }}>Inativo</option>
                </select>
              </div>

              <div class="form-group">
                <label for="serial">Ordem</label>
                <input type="number" name="serial" class="form-control" placeholder="Digite a Ordem de Exibição" value="{{ old('serial', $slider->serial) }}">
              </div>

              <div class="form-group d-flex justify-content-between">
                <a href="{{ route('Slider.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-save"></i> Atualizar
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
        <h5 class="modal-title" id="helpModalLabel">Ajuda para Edição de Slide</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="pl-3">
          <li>🔺 <strong>Imagem</strong>: Utilize uma imagem de 1300x500px.</li>
          <li>📝 <strong>Título</strong>: Ajuste os textos de destaque.</li>
          <li>💲 <strong>Valor</strong>: Campo opcional para preço promocional.</li>
          <li>🔗 <strong>Link</strong>: Endereço para onde o slide redireciona.</li>
          <li>📊 <strong>Status</strong>: Marque como ativo ou inativo.</li>
          <li>⬆ <strong>Ordem</strong>: Slides com ordem menor aparecem primeiro.</li>
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
