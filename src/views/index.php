<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MyApp | Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('https://source.unsplash.com/1600x900/?startup,tech') center/cover no-repeat;
            color: white;
            padding: 120px 0;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">MyApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light ms-3" href="login">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-2" href="#">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Empower Your Workflow</h1>
            <p class="lead mb-4">Organize, collaborate, and grow with MyApp. All in one place.</p>
            <a href="#" class="btn btn-primary btn-lg me-2">Get Started</a>
            <a href="login" class="btn btn-outline-light btn-lg">Login</a>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-lock-fill fs-2 text-primary"></i>
                            <h5 class="card-title mt-3">Secure</h5>
                            <p class="card-text">Your data is encrypted and stored safely with our security-first approach.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-lightning-charge-fill fs-2 text-warning"></i>
                            <h5 class="card-title mt-3">Fast & Reliable</h5>
                            <p class="card-text">Lightning-fast performance and guaranteed 99.9% uptime for your team.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-ui-checks fs-2 text-success"></i>
                            <h5 class="card-title mt-3">Easy to Use</h5>
                            <p class="card-text">A clean and intuitive UI makes task management effortless for everyone.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About / How it Works -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://source.unsplash.com/600x400/?workspace,team" class="img-fluid rounded" alt="About us" />
                </div>
                <div class="col-md-6">
                    <h3>How It Works</h3>
                    <p>Sign up, create your workspace, and invite your team. With MyApp, you'll track progress, communicate effortlessly, and reach goals faster.</p>
                    <ul>
                        <li>✔ Real-time collaboration</li>
                        <li>✔ Easy onboarding</li>
                        <li>✔ Detailed analytics & reports</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">What Users Say</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 shadow-sm rounded bg-white">
                        <p>"MyApp boosted our team's productivity. Love it!"</p>
                        <h6 class="mb-0">- Sarah M.</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 shadow-sm rounded bg-white">
                        <p>"A must-have for startups and freelancers!"</p>
                        <h6 class="mb-0">- Ahmed R.</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 shadow-sm rounded bg-white">
                        <p>"The UI is so smooth and user-friendly!"</p>
                        <h6 class="mb-0">- Maria L.</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">FAQs</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#q1">Is MyApp free?</button></h2>
                    <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">Yes! You can get started for free with our basic plan.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q2">Can I cancel anytime?</button></h2>
                    <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">Absolutely. There are no long-term commitments.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-2">&copy; 2025 MyApp. All rights reserved.</p>
            <div>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>