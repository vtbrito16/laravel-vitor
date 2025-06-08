@push('styles')
<style>
  /* NAVBAR ESTILO MODERNO */
  .navbar {
    background-color: #343a40 !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .navbar .nav-link {
    color: #ffffff !important;
    transition: 0.3s ease;
  }

  .navbar .nav-link:hover,
  .navbar .nav-link:focus {
    color: #00d1b2 !important;
  }

  /* ESTILO DO USUÁRIO */
  .nav-link-user img {
    border: 2px solid #00d1b2;
    box-shadow: 0 0 5px rgba(0, 209, 178, 0.5);
  }

  .nav-link-user div {
    color: #ffffff;
    font-weight: 500;
  }

  /* DROPDOWN BONITO */
  .dropdown-menu {
    border-radius: 0.5rem;
    border: none;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  }

  /* SIDEBAR UNIFICADA */
  .main-sidebar {
    background-color: #2d2f44 !important;
  }

  .sidebar-brand,
  .sidebar-brand-sm {
    background-color: #4e54c8;
    font-weight: bold;
    font-size: 1.5rem;
    padding: 1rem;
    text-align: center;
    letter-spacing: 1px;
  }

  .sidebar-brand a,
  .sidebar-brand-sm a {
    color: #ffffff !important;
    text-decoration: none;
  }

  /* MENUS */
  .sidebar-menu .menu-header {
    color: #aab2c9;
    padding: 10px 20px;
    font-size: 0.9rem;
    text-transform: uppercase;
  }

  .sidebar-menu li a {
    color: #cdd3e0;
    padding: 12px 20px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    transition: background-color 0.3s, color 0.3s;
  }

  .sidebar-menu li a:hover {
    background-color: #4e54c8;
    color: #ffffff;
  }

  .sidebar-menu li.active > a,
  .sidebar-menu li.active > a:hover {
    background-color: #4e54c8;
    color: #ffffff;
    font-weight: 600;
  }

  .sidebar-menu i {
    margin-right: 10px;
    min-width: 20px;
    text-align: center;
  }
</style>
@endpush
