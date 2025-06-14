@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header animate__animated animate__fadeInDown">
        <h1><i class="fas fa-images text-primary"></i> Todos os Slides</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Painel</a></div>
            <div class="breadcrumb-item">Slide</div>
        </div>
    </div>

    <div class="section-body animate__animated animate__fadeIn">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4 bg-white">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white rounded-top-4">
                        <h4 class="mb-0"><i class="fas fa-star text-warning me-2"></i> Slides em Destaque</h4>
                        <a href="{{ route('Slider.create') }}" class="btn btn-warning shadow-sm transition-all hover-shadow-sm">
                            <i class="fas fa-plus-circle me-1"></i> Novo Slide
                        </a>
                    </div>

                    <div class="card-body">
                        {{ $dataTable->table(['class' => 'table table-hover table-bordered w-100 shadow-sm rounded'], true) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .card {
        transition: all 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-4px);
    }
    .btn:hover {
        opacity: 0.9;
    }
    .table th {
        background-color: #f8f9fa;
    }
</style>
@endpush
