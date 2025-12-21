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
                    <div class="carousel-title d-flex justify-content-center">
                        <span>
                            Caring for Your Eyes,
                            Every Step of the Way
                        </span>
                    </div>
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

                        <div class="about-card shadow-sm rounded p-3 mt-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/logo/shield_check_mark_gradient_icon.jpg') }}" style="height:85px; padding: 5px 15px 5px 5px;" class="rounded-pill" alt="">
                                <div>
                                    <h5 class="mb-1" style="font-size: 1.1rem;">Trusted by Thousands</h5>
                                    <p class="mb-0 text-muted" style="font-size: 0.9rem;">Our team delivers expert care with proven results and patient satisfaction.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stats rounded mt-4 shadow-lg">
                            <div class="row p-4">
                                <div class="col-4">
                                    <div class="stat-item p-1">
                                        <h4 class="stat-number text-center fw-bold">15+</h4>
                                        <h6 class="stat-text text-center">Years Experience</h6>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item p-1">
                                        <h4 class="stat-number text-center fw-bold">5000+</h4>
                                        <h6 class="stat-text text-center">Patients Treated</h6>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item p-1">
                                        <h4 class="stat-number text-center fw-bold">87%</h4>
                                        <h6 class="stat-text text-center">Success Rate</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mt-4 mt-lg-5">
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
            <h2 class="text-center service-title pt-3">Our Specialized Services</h2>
            <p class="text-center text-muted services-details">
                Providing comprehensive eye care with advanced technology and personalized treatment plans for optimal vision health.
            </p>
            <div class="cards mt-3">
                @if($appointmentTypes->isNotEmpty())
                    @foreach($appointmentTypes as $appointmentType)
                        <div class="card">
                            <div class="card-body p-0 text-center">
                                <div class="card-icon">
                                    <i class="{{ $appointmentType->icon }}"></i>
                                </div>
                                <h5 class="card-title"> 
                                    {{ $appointmentType->appt_type_name }} 
                                </h5>
                                <div class="card-details d-flex flex-column justify-content-between">
                                    <p> {{ $appointmentType->description }} </p>
                                    <button class="btn btn-warning btn-sm m-1">More Details</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="card">
                    <div class="card-body p-0 text-center">
                        <div class="card-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h5 class="card-title">No Service Available</h5>
                        <div class="card-details d-flex flex-column justify-content-between">
                            <p>We apologize, but the requested service is currently unavailable. Please contact us for more information or assistance.</p>
                            <a href="#contact" class="btn btn-warning btn-sm m-1">Contact</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- appointment section -->
    <section id="make-appointment" class="make-appointment section-padding">
        <div class="container">
            <h2 class="appointment-create-title">Make An Appointment</h2>

            <form action="" method="" id="appointment-create-form">
                @csrf

                <!-- name -->
                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="firstName" class="form-label text-light">First Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                                <input type="text" name="firstName" id="firstName" class="form-control" value="" placeholder="Enter your first name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="lastName" class="form-label text-light">Last Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                                <input type="text" name="lastName" id="lastName" class="form-control" value="" placeholder="Enter your last name">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- email & phone -->
                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="email" class="form-label text-light">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control" value="" placeholder="Enter your email address">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="phone" class="form-label text-light">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                <input type="tel" name="phone" id="phone" class="form-control" value="" placeholder="Enter your phone number">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- age & gender -->
                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="age" class="form-label text-light">Age</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
                                <input type="number" name="age" id="age" class="form-control" value="" placeholder="Enter your age">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label for="gender" class="form-label text-light">Gender</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" id="male" checked>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" id="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="others">
                                    <label class="form-check-label" for="others">Others</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- appointment type , appointment date -->
                
                <!-- password -->
                <!-- remarks -->

                <button type="submit" class="btn btn-success create-appointment-btn">Make Appointment</button>
            </form>
        </div>
    </section>

    <!-- check appointment section -->
    <section id="check-appointment" class="check-appointment section-padding">
        <div class="container">
            <h2 class="text-center text-white">Check Your Appointment Progress</h2>
            <form action="#" method="POST" id="check-appointment-form">
                @csrf

                <div class="d-flex flex-column flex-lg-row justify-content-lg-center gap-2 form-content">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-id-card"></i>
                            </span>
                            <input type="text" name="name" id="name" class="form-control" value="" placeholder="Enter you appointment ID" aria-label="Appointment ID">
                        </div>
                    </div>
                    <button class="btn check-appointment-btn">Check Appointment</button>
                </div>
            </form>
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
    <footer id="contact" class="contact contact-section-padding">
        <div class="container mt-lg-3">
            <div class="row">
                <div class="col-12 col-lg-4 contact-left pe-lg-3">
                    <div class="doctor">
                        <h3 class="doctor-name">Dr. Usman Khawaja</h3>

                        <p class="doctor-position">
                            <strong>Consultant Ophthalmologist</strong> <br>
                            Department of Ophthalmology <br>
                            Rajshahi Medical College & Hospital, Bangladesh
                        </p>

                        <p class="doctor-degree">
                            MBBS (Sher-e-Bangla Medical College, Barisal) <br>
                            MPH (Masters of Public Health, The Johns Hopkins University, USA) <br>
                            Diploma in Ophthalmology (National Institute of Ophthalmology) <br>
                            Clinical Retina Vitreous Fellow (University of British Columbia, Canada)
                        </p>
                    </div>

                    <div class="social-link">
                        <h5 class="social-link-title">Stay Connected for More</h5>
                        <div class="links d-flex flex-row">
                            <a href="#" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" title="Instragram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" title="Linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#" title="Youtube"><i class="fa-brands fa-youtube"></i></a>
                            <a href="#" title="Telegram"><i class="fa-brands fa-telegram"></i></a>
                        </div>
                    </div>

                    <div class="newsletter">
                        <h5 class="mb-0">Health Newsletter</h5>
                        <p>Subscribe for health tips and practice updates.</p>
                        <form action="" method="" id="">
                            <div class="d-flex flex-lg-row gap-2">
                                <input type="email" class="form-control" placeholder="Your Email Address">
                                <button type="submit" class="btn btn-sm btn-newsletter">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-lg-4 contact-middle ps-lg-4 pe-lg-4">
                    <div class="locations">
                        <h5 class="clinic-name-heading">Clinic Location</h5>

                        <ul class="contact-info">
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <div>
                                    <h6>Rajshahi Chamber</h6>
                                    <p>
                                        Eye 10 Tower, Airport Road, Aam Chattar <br>
                                        Rajshahi-6203
                                    </p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <div>
                                    <h6>Chapai Nawabganj Chamber</h6>
                                    <p>
                                        Station Road, Near Old Bus Stand <br>
                                        Chapai Nawabganj-6300
                                    </p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <div>
                                    <h6>Appointments</h6>
                                    <p>
                                        Rajshahi (Hospital): <a href="tel:+8809613123123" class="text-decoration-none text-light">+88 09613 123 123</a> <br>
                                        Chapai Nawabganj (Chamber): <a href="tel:+8801755660041" class="text-decoration-none text-light">+88 01755 660 041</a> <br>
                                        Emergency/Hotline: <a href="tel:+8801916629999" class="text-decoration-none text-danger bg-light rounded fw-bold ps-1 pe-1">+88 01916 629 999</a>
                                    </p>
                                </div>
                            </li>

                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <div>
                                    <h6>Email</h6>
                                    <p>
                                        Rajshahi: <a href="mailto:rajshahi@bdeyehospital.com" class="text-decoration-none text-light">rajshahi@bdeyehospital.com</a><br>
                                        Chapai Nawabganj: <a href="mailto:cnawabganj@clinicname.com" class="text-decoration-none text-light">cnawabganj@clinicname.com</a>
                                    </p>
                                </div>
                            </li>
                        </ul>

                        <div class="emergency-info">
                            <h4><i class="fa-solid fa-ambulance me-1 text-danger"></i><span class="emergency-text">Emergency Contact</span></h4>
                            <p>For medical emergencies after hours, please call:</p>
                            <div class="emergency-phone text-danger fw-bold">+88 01916 629 999</div>
                            <p>Or go to the nearest emergency room.</p>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-lg-4 contact-right ps-lg-4">
                    <div class="hours">
                        <h5>Clinic Hours</h5>

                        <table class="appointment-table">
                            <tbody>
                                <tr>
                                    <td>Saturday</td>
                                    <td>6:00 AM - 9:00 PM</td>
                                    <td>Rajshahi</td>
                                </tr>
                                <tr>
                                    <td>Sunday</td>
                                    <td>6:00 AM - 9:00 PM</td>
                                    <td>Rajshahi</td>
                                </tr>
                                <tr>
                                    <td>Monday</td>
                                    <td>7:30 AM - 9:30 PM</td>
                                    <td>C. Nawabgang</td>
                                </tr>
                                <tr>
                                    <td>Tuesday</td>
                                    <td>6:00 AM - 9:00 PM</td>
                                    <td>Rajshahi</td>
                                </tr>
                                <tr>
                                    <td>Wednesday</td>
                                    <td>6:00 AM - 9:00 PM</td>
                                    <td>Rajshahi</td>
                                </tr>
                                <tr>
                                    <td>Thursday</td>
                                    <td>7:30 AM - 9:30 PM</td>
                                    <td>C. Nawabgang</td>
                                </tr>
                                <tr>
                                    <td>Friday</td>
                                    <td colspan="2">Closed</td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="holiday-hours">
                            Please call ahead during holiday seasons as hours may vary.We're closed on major holidays.
                        </p>

                        <div class="free-camp-info">
                            <h6 class="text-center">Free Health Camp</h6>
                            <p>
                                A free health camp provides no-cost medical services like check-ups and screenings for underserved communities. Check our website for updates on upcoming camps. <br>
                                
                            </p>
                            <h6 class="text-center mb-0" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-phone"></i> +88 09613 123 123
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border border-1 border-light mt-4 mb-2">
            <div class="d-flex justify-content-center">
                <p class="footer-bottom">&copy; 2023 Dr. Usman khawaja. All Rights Reserved. | 
                    <a href="#" class="text-decoration-none text-light">Privacy Policy</a> | 
                    <a href="#" class="text-decoration-none text-light">Terms of Service</a>
                </p>
            </div>
        </div>   
    </footer>
    

    <!-- JQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
        $('#appointment-create-form').on('submit', function(e) {
            e.preventDefault();

            let firstName = $('#appointment-create-form #firstName').val();
            let lastName  = $('#appointment-create-form #lastName').val();

            console.log(firstName);
            console.log(lastName);
        })
    </script>
</body>
</html>