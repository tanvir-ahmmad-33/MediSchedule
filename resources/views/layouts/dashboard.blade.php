<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <!-- Importing font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Navbar section -->

    <div class="wrapper">

        @yield('sidebar')

        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control border-0 rounded-9 pe-0" placeholder="Search..." aria-label="Search">
                        <button class="btn border-0 rounded-0" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                @yield('avatar')
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded-0 border-0 shadow mt-3">
                                <a href="#" class="dropdown-item">
                                    <i class="bx bx-data"></i>
                                    <span>Analytics</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="bx bx-cog"></i>
                                    <span>Setting</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="bx bx-help-circle"></i>
                                    <span>Help Center</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content px-3 pt-3 pb-0">
                <div class="container-fluid">
                    @yield('body-content')
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start">
                            <a href="#" class="text-body-secondary">
                                <strong>{{ config('app.name') }}</strong>
                            </a>
                        </div>
                        <div class="col-6 text-end text-body-secondary d-none d-md-block">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="#" class="text-body-secondary">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-body-secondary">About</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-body-secondary">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        $(".toggle-btn").on("click", function() {
            $("#sidebar").toggleClass("expand");
            $("#icon").toggleClass("fa-solid fa-chevron-right");
            $("#icon").toggleClass("fa-solid fa-chevron-left");
            
        });

        $("#logout-link").on('click', function(e) {
            e.preventDefault();

            $("#logout-form").submit();
        })

    </script>
    @stack('scripts')

</body>
</html>