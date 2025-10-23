<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ config('app.name') }} </title>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
</head>
<body>
    <!-- navigation section -->
    <nav class="navbar navbar-expand-lg bg-body-transparent fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#carouselExampleIndicators">Dr. Usman Khawaja</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#carouselExampleIndicators">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Appointment
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#make-appointment">Make appointment</a></li>
                            <li><a class="dropdown-item" href="#check-appointment">Check appointment</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#">Emergency</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#staffs">Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <div class="d-flex flex-row justify-content-center align-items-center gap-2 gap-lg-3 nav-right">
                    <a class="nav-link text-muted phone-number" href="tel:+8801735791960">(+880) 1735 791960</a>
                    <a class="nav-link text-muted" href="{{ route('login') }}">Login/Register</a>
                    <a class="btn btn-sm appointment-btn-1" href="#">Appointment</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- carousel section -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('assets/image/hero-img-1.jpg') }}" alt="First slide">
                <div class="carousel-caption">
                    <h5>
                        <span class="p-3 rounded">Caring for Your Eyes, Every Step of the Way</span>
                    </h5>
                    <h4>Dr.Usman Khawaja</h4>
                    <p>
                        MBBS (DMC), FCPS (BCPS), MCPS (BCPS) <br>
                        D.O. (Bangladesh Inst. of Ophthalmology) <br>
                        FACS (ACS) – Specialist in Ophthalmology at RMC
                    </p>
                    <p>
                        <a href="#" class="btn btn-success btn-lg mt-4">Make An Appointment</a>
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('assets/image/hero-img-2.jpg') }}" alt="First slide">
                <div class="carousel-caption">
                    <h5>
                        <span class="p-3 rounded">Caring for Your Eyes, Every Step of the Way</span>
                    </h5>
                    <h4>Dr.Usman Khawaja</h4>
                    <p>
                        MBBS (DMC), FCPS (BCPS), MCPS (BCPS) <br>
                        D.O. (Bangladesh Inst. of Ophthalmology) <br>
                        FACS (ACS) – Specialist in Ophthalmology at RMC
                    </p>
                    <p>
                        <a href="#" class="btn btn-success btn-lg mt-4">Make An Appointment</a>
                    </p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('assets/image/hero-img-3.jpg') }}" alt="First slide">
                <div class="carousel-caption">
                    <h5>
                        <span class="p-3 rounded">Caring for Your Eyes, Every Step of the Way</span>
                    </h5>
                    <h4>Dr.Usman Khawaja</h4>
                    <p>
                        MBBS (DMC), FCPS (BCPS), MCPS (BCPS) <br>
                        D.O. (Bangladesh Inst. of Ophthalmology) <br>
                        FACS (ACS) – Specialist in Ophthalmology at RMC
                    </p>
                    <p>
                        <a href="#" class="btn btn-success btn-lg mt-4">Make An Appointment</a>
                    </p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- about section -->
    <section id="about" class="about section-padding">
        <div class="container">
            <div class="row mt-lg-5">
                <div class="col-12 col-lg-6">
                    <div class="about-img">
                        <img src="{{ asset('assets/image/about-img.jpg') }}" alt="" class="img-fluid rounded">
                    </div>
                </div>
                <div class="col-12 col-lg-6 ps-lg-5 mt-5 mt-lg-0">
                    <div class="about-text">
                        <h2 class="about-text-title">Expert Eye Care You Can Trust</h2>
                        <p class="text-muted about-text-details">At our practice, we are dedicated to providing exceptional ophthalmology care tailored to each patient's unique needs. With a focus on advanced treatments, compassionate service, and personalized care, we ensure that your vision health is in expert hands.</p>

                        <div class="about-card shadow-sm rounded p-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-shield-check fs-2 me-3"></i>
                                <div>
                                    <h5 class="mb-1">Trusted by Thousands</h5>
                                    <p class="mb-0 text-muted">Our team delivers expert care with proven results and patient satisfaction.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stats p-3 rounded mb-4">
                            <div class="row">
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h5 class="stat-number text-center">15+</h5>
                                        <h6 class="stat-text text-center">Years Experience</h6>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h5 class="stat-number text-center">5000+</h5>
                                        <h6 class="stat-text text-center">Patients Treated</h6>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h5 class="stat-number text-center">87%</h5>
                                        <h6 class="stat-text text-center">Success Rate</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mt-3 mt-lg-4">
                    <a href="#services" class="btn btn-success btn-lg">
                        <i class="fas fa-arrow-right me-2"></i> Explore Our Services
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- services section -->
    <section id="services" class="services section-padding">
        <div class="container">
            <h2 class="text-center">Our Eye Care Services</h2>
            <p class="text-center text-muted services-details">
                We care for your eyes with a gentle touch and the latest technology, ensuring every visit is comfortable and reassuring. <br>
                From check-ups to advanced treatments, your vision is always our top priority.
            </p>
            <div class="cards">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-2x"></i>
                        <h5 class="text-center">Comprehensive Eye Examination</h5>
                        <p>Complete eye check-up including refraction, slit-lamp examination, eye pressure measurement, and retina screening to detect eye diseases early.</p>
                        <button class="btn btn-success btn-sm">More Details</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-procedures fa-2x"></i>
                        <h5 class="text-center">Cataract Surgery</h5>
                        <p>Advanced phacoemulsification with premium intraocular lens (IOL) implantation for clear vision, minimal discomfort, and rapid recovery. Safe, precise, and effective treatment to restore sight.</p>
                        <button class="btn btn-success btn-sm">More Details</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-stethoscope fa-2x"></i>
                        <h5 class="text-center">Glaucoma Treatment</h5>
                        <p>Comprehensive glaucoma management including eye pressure monitoring, visual field testing, optic nerve evaluation, and personalized medical, laser, or surgical treatment to preserve vision.</p>
                        <button class="btn btn-success btn-sm">More Details</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-lightbulb fa-2x"></i>
                        <h5 class="text-center">LASIK & Refractive Surgery</h5>
                        <p>Safe and advanced laser vision correction to reduce or eliminate the need for glasses or contact lenses, offering clear and lasting vision.</p>
                        <button class="btn btn-success btn-sm">More Details</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-2x"></i>
                        <h5 class="text-center">Comprehensive Eye Examination</h5>
                        <p>Complete eye check-up including refraction, slit-lamp examination, eye pressure measurement, and retina screening to detect eye diseases early.</p>
                        <button class="btn btn-success btn-sm">More Details</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-2x"></i>
                        <h5 class="text-center">Comprehensive Eye Examination</h5>
                        <p>Complete eye check-up including refraction, slit-lamp examination, eye pressure measurement, and retina screening to detect eye diseases early.</p>
                        <button class="btn btn-success btn-sm">More Details</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-2x"></i>
                        <h5 class="text-center">Comprehensive Eye Examination</h5>
                        <p>Complete eye check-up including refraction, slit-lamp examination, eye pressure measurement, and retina screening to detect eye diseases early.</p>
                        <button class="btn btn-success btn-sm">More Details</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-2x"></i>
                        <h5 class="text-center">Comprehensive Eye Examination</h5>
                        <p>Complete eye check-up including refraction, slit-lamp examination, eye pressure measurement, and retina screening to detect eye diseases early.</p>
                        <button class="btn btn-success btn-sm">More Details</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- staffs section -->
    <section id="staffs" class="staffs section-padding">
        <div class="container">
            <h2 class="text-center">Our Expert Team</h2>
            <p class="text-center text-muted">Meet our dedicated professionals committed to providing you with world-class eye care.</p>

            <div class="cards">
                <div class="card">
                    <img src="{{ asset('assets/image/staffs/doctor-assistant.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Ali Raza</h5>
                        <p class="card-text">
                            Medical Assistant<br>
                            Patient care & support
                        </p>
                    </div>
                    <hr>
                    <div class="socials d-flex justify-content-center gap-3 mb-3">
                        <a href="#" class="text-decoration-none"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-solid fa-phone"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ asset('assets/image/staffs/female-nurse.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Ayesha Ali Khan</h5>
                        <p class="card-text">
                            Head Nurse
                        </p>
                    </div>
                    <hr>
                    <div class="socials d-flex justify-content-center gap-3 mb-3">
                        <a href="#" class="text-decoration-none"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-solid fa-phone"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ asset('assets/image/staffs/male-nurse.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Osman Gazi</h5>
                        <p class="card-text">
                            Nurse
                        </p>
                    </div>
                    <hr>
                    <div class="socials d-flex justify-content-center gap-3 mb-3">
                        <a href="#" class="text-decoration-none"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-solid fa-phone"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ asset('assets/image/staffs/receptionist.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Maria Ahmed</h5>
                        <p class="card-text">
                            Receptionist<br>
                            Organizing Appointments & Patient Care
                        </p>
                    </div>
                    <hr>
                    <div class="socials d-flex justify-content-center gap-3 mb-3">
                        <a href="#" class="text-decoration-none"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-solid fa-phone"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer/contact section -->
    <footer id="contact" class="contact section-padding"></footer>
    

    <!-- JQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>