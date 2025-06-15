<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Painel Administrativo &mdash; Vtbrito.com.br</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">

<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">

<!-- DataTables -->
<link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">

<!--ICONES -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-iconpicker.min.css') }}">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){ dataLayer.push(arguments); }
gtag('js', new Date());
gtag('config', 'UA-94034622-3');
</script>
</head>
<body>
<div id="app">
<div class="main-wrapper main-wrapper-1">
<div class="navbar-bg"></div>

@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')

<div class="main-content">
@yield('content')
</div>

<footer class="main-footer">
<div class="footer-left">
Todos os Direitos Reservados &copy; {{ date('d/m/y') }}
<div class="bullet"></div> Desenvolvedor <a href="https://vtbrito.com.br/">vtbrito.com.br</a> Versão 1.0
</div>
<div class="footer-right"></div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
<script src="{{ asset('backend/assets/modules/tooltip.js') }}"></script>
<script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/stisla.js') }}"></script>

<!-- JS Libraries -->
<script src="{{ asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/chart.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- DataTables -->
<script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- ICONES -->bootstrap-iconpicker.bundle.min
<script src="{{ asset('backend/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom.js') }}"></script>

<!-- Flash Messages -->
<script>
@if(session('success'))
Swal.fire({
icon: 'success',
title: 'Sucesso!',
text: "{{ session('success') }}",
timer: 3000,
showConfirmButton: false
});
@endif

@if(session('error'))
Swal.fire({
icon: 'error',
title: 'Erro!',
text: "{{ session('error') }}",
timer: 4000,
showConfirmButton: false
});
@endif

@if ($errors->any())
let errorMessages = '';
@foreach ($errors->all() as $error)
errorMessages += "• {{ $error }}\n";
@endforeach
Swal.fire({
icon: 'error',
title: 'Erros de Validação',
text: errorMessages,
customClass: { popup: 'text-start' }
});
@endif
</script>

<!-- Exclusão com confirmação -->
<script>
$(document).ready(function() {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$('body').on('click', '.delete-item', function(e) {
e.preventDefault();

let url = $(this).data('url');

Swal.fire({
title: 'Tem certeza?',
text: "Você não poderá reverter isso!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Sim, excluir!',
cancelButtonText: 'Cancelar'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
type: 'DELETE',
url: url,
success: function(response) {
if (response.status === 'success') {
Swal.fire('Excluído!', response.message, 'success');
$('.dataTable').DataTable().ajax.reload(null, false);
}
},
error: function(xhr) {
console.error(xhr.responseText);
Swal.fire('Erro!', 'Algo deu errado.', 'error');
}
});
}
});
});
});
</script>

@stack('scripts')
@stack('styles')

<style>
.profile-pic-preview {
width: 120px;
height: 120px;
object-fit: cover;
border-radius: 50%;
border: 2px solid #dee2e6;
}
<style>
    /* Estilização da tabela de categorias */
    table#categoria-table td,
    table#categoria-table th {
        vertical-align: middle !important;
        padding: 12px 16px !important;
    }

    table#categoria-table i {
        font-size: 20px;
    }

    table#categoria-table .btn {
        font-size: 11px;
        padding: 8px 11px;
    }

    table#categoria-table .btn + .btn {
        margin-left: 5px;
    }

    table#categoria-table .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        vertical-align: middle;
        color: #343a40; /* Texto mais escuro */
        font-size: 25px; /* Texto maior */
        font-weight: 500; /* Um pouco mais grosso */
    }
</style>
</style>
</style>
</style>
</body>
</html>
