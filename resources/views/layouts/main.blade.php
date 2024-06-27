<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>E-LIBRARY</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    
    <!-- Page CSS -->
    
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="{{ asset('assets/js/config.js') }}"></script>
      {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" /> --}}
      <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
      <style>
        .dataTables_filter{
          margin-bottom: 15px !important;
        }
        .dt-input{
          margin-right: 15px !important;
        }
        .alert {
        position: fixed;
        top: 50px;
        right: 50%;
        transform: translateX(50%);
        width: max-content;
        z-index: 9999;
        padding: 1rem 1.5rem;
        border-radius: 0.375rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      }
      .alert .btn-close {
        margin-left: 20px; /* Tambahkan margin kiri */
      }
      </style>
  </head>

  <body>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" id="alert" role="alert">
      <h5 class="text-black">{{ $message }}</h5>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
                <!-- Menu -->
                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                  <div class="app-brand demo d-flex" style="height:100px">
                    <a href="/" class="app-brand-link m-auto">
                      <span class="app-brand-logo demo">
                            <img src="{{ asset('assets/img/logo.svg') }}" alt="" style="width: 100px">
                      </span>
                      {{-- <span class="demo menu-text fw-bolder ms-2" style="font-size: 15px">E-LIBRARY</span> --}}
                    </a>
        
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                      <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                  </div>
        
                  <div class="menu-inner-shadow"></div>
        
                  <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item">
                      <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-home"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                      </a>
                    </li>
                    <!-- Users -->
                    <li class="menu-item {{ Route::is('users*') ? 'active' : '' }}">
                      <a href="{{ route('users.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user"></i>
                        <div data-i18n="Analytics">Users</div>
                      </a>
                    </li>
                    <!-- Members -->
                    <li class="menu-item {{ Route::is('members*') ? 'active' : '' }}">
                      <a href="{{ route('members.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-group"></i>
                        <div data-i18n="Analytics">Daftar Anggota</div>
                      </a>
                    </li>
                    <!-- Books -->
                    <li class="menu-item {{ Route::is('books*') ? 'active' : '' }}">
                      <a href="{{ route('books.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-book"></i>
                        <div data-i18n="Analytics">Daftar Buku</div>
                      </a>
                    </li>
                    <!-- Loans -->
                    <li class="menu-item {{ Route::is('loans*') ? 'active' : '' }}">
                      <a href="{{ route('loans.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-bookmark"></i>
                        <div data-i18n="Analytics">Peminjaman</div>
                      </a>
                    </li>
                    <!-- Visitors -->
                    <li class="menu-item {{ Route::is('visitors*') ? 'active' : '' }}">
                      <a href="{{ route('visitors.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-user-check"></i>
                        <div data-i18n="Analytics">Daftar Kunjungan</div>
                      </a>
                    </li>
                    <!-- Book Shelves -->
                    <li class="menu-item {{ Route::is('book_shelves*') ? 'active' : '' }}">
                      <a href="{{ route('book_shelves.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-book-content"></i>
                        <div data-i18n="Analytics">Rak Buku</div>
                      </a>
                    </li>
                    </ul>
                </aside>
                <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center" style="background-color: #006316 !important"
          id="layout-navbar"
        >
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item mt-1 text-white">{{ Auth::user()->name }}</li>
              <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="dropdown-item text-white">
                    <span class="align-middle">Log Out</span>
                  </button>
              </form>
              </li>
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
           
            @yield('content')

           <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
            <p class="text-center">Copyright @ 2024 E-Library</p>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      $(document).ready(function () {
          $('#example').DataTable({
          });
      });
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
  </body>
</html>
