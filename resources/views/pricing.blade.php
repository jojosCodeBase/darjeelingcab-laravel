@extends('layouts.main')
@section('title', 'AI Based Fare Calculator - Coming Soon | Darjeeling Cab')
@section('meta-tags')
    <meta name="description"
        content="Revolutionary AI-powered cab fare calculator coming soon. Get real-time dynamic pricing based on traffic, weather, and demand for Darjeeling, NJP, Bagdogra routes." />
    <meta name="keywords"
        content="AI fare calculator, dynamic pricing, smart cab booking, Darjeeling AI taxi, intelligent fare system, coming soon" />
@endsection

@push('styles')
    <style>
        :root {
            --brand-color: #2c5aa0;
            --brand-light: #e8f2ff;
            --brand-dark: #1a3d73;
            --gradient-start: #667eea;
            --gradient-end: #764ba2;
            --ai-blue: #4a90e2;
            --ai-purple: #7b68ee;
        }

        .coming-soon-container {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            border-radius: 25px;
            padding: 3rem 2rem;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
            color: white;
            text-align: center;
        }

        .coming-soon-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(-50px, -50px) rotate(360deg);
            }
        }

        .ai-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--ai-blue), var(--ai-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1rem 0;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .progress-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            height: 8px;
            margin: 1rem 0;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(90deg, #ffd89b 0%, #19547b 100%);
            height: 100%;
            width: 75%;
            border-radius: 50px;
            animation: progressPulse 2s infinite;
        }

        @keyframes progressPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        .notify-form {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            color: #333;
        }

        .notify-form .form-control {
            border-radius: 50px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1.5rem;
        }

        .notify-form .form-control:focus {
            border-color: var(--brand-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
        }

        .btn-ai {
            background: linear-gradient(45deg, var(--ai-blue), var(--ai-purple));
            border: none;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-ai:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .current-calculator {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }

        .comparison-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .comparison-table th {
            background: var(--brand-color);
            color: white;
            font-weight: 600;
            padding: 1rem;
        }

        .comparison-table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .check-icon {
            color: #28a745;
        }

        .times-icon {
            color: #dc3545;
        }

        .countdown-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .countdown-item {
            text-align: center;
            margin: 0 1rem;
        }

        .countdown-number {
            font-size: 2.5rem;
            font-weight: bold;
            display: block;
        }

        .countdown-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .coming-soon-container {
                padding: 2rem 1rem;
            }

            .ai-icon {
                font-size: 3rem;
            }

            .countdown-number {
                font-size: 2rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container blogs-container">
        <!-- Coming Soon Hero Section -->
        <div class="coming-soon-container">
            <div class="position-relative">
                <div class="ai-icon">
                    <i class="fas fa-robot"></i>
                </div>
                <h1 class="display-4 fw-bold mb-3">AI Based Fare Calculator</h1>
                <h2 class="h4 mb-4 opacity-90">Coming Soon</h2>
                <p class="lead mb-4">
                    Revolutionary artificial intelligence meets cab booking. Get ready for the most accurate,
                    dynamic pricing system that adapts in real-time to give you the fairest fare every time.
                </p>

                <!-- Progress Bar -->
                <div class="progress-container">
                    <div class="progress-bar"></div>
                </div>
                <p class="small opacity-75 mb-4">Development Progress: 75% Complete</p>
            </div>
        </div>

        <!-- AI Features Preview -->
        <div class="row my-5">
            <div class="col-12 text-center mb-4">
                <h2 class="text-brand fw-bold">What Makes Our AI Calculator Special?</h2>
                <p class="text-muted">Powered by advanced machine learning algorithms</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <i class="fas fa-cloud-sun fa-3x mb-3" style="color: #ffd89b;"></i>
                        <h5 class="fw-bold text-white">Real-time Weather Integration</h5>
                        <p class="small opacity-90">
                            Prices adjust automatically based on weather conditions, road safety, and seasonal demand
                            patterns.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <i class="fas fa-traffic-light fa-3x mb-3" style="color: #ff6b6b;"></i>
                        <h5 class="fw-bold text-white">Smart Traffic Analysis</h5>
                        <p class="small opacity-90">
                            Live traffic monitoring adjusts routes and pricing to ensure optimal journey time and cost.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <i class="fas fa-chart-line fa-3x mb-3" style="color: #4ecdc4;"></i>
                        <h5 class="fw-bold text-white">Dynamic Demand Pricing</h5>
                        <p class="small opacity-90">
                            AI predicts demand patterns and adjusts prices fairly while ensuring driver availability.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <i class="fas fa-route fa-3x mb-3" style="color: #a8e6cf;"></i>
                        <h5 class="fw-bold text-white">Intelligent Route Optimization</h5>
                        <p class="small opacity-90">
                            Multiple route options with AI-recommended best paths for time, cost, and scenic value.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <i class="fas fa-user-check fa-3x mb-3" style="color: #dda0dd;"></i>
                        <h5 class="fw-bold text-white">Personalized Pricing</h5>
                        <p class="small opacity-90">
                            Loyalty rewards and personalized offers based on your travel history and preferences.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card text-center h-100">
                        <i class="fas fa-shield-alt fa-3x mb-3" style="color: #87ceeb;"></i>
                        <h5 class="fw-bold text-white">Transparent AI Decisions</h5>
                        <p class="small opacity-90">
                            Every pricing decision explained clearly - no hidden algorithms, complete transparency.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Signup -->
        <div class="row my-5 border p-5 rounded">
            <div class="col-lg-8 mx-auto">
                <div class="notify-form text-center">
                    <h3 class="text-brand fw-bold mb-3">Be The First to Experience AI Pricing</h3>
                    <p class="text-muted mb-4">
                        Join our exclusive waitlist and get early access to the AI calculator plus a special launch
                        discount!
                    </p>

                    <form id="notifyForm" class="row g-3 justify-content-center">
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Enter your email address" required>
                        </div>
                        <div class="col-md-4">
                            <input type="tel" class="form-control" placeholder="Phone number (optional)">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-brand">
                                <i class="fas fa-bell me-2"></i>Notify Me When Ready
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-gift me-2"></i>Early birds get 20% off their first AI-calculated ride!
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Calculator CTA -->
        <div class="current-calculator text-center">
            <h3 class="text-brand fw-bold mb-3">Need Pricing Now?</h3>
            <p class="text-muted mb-4">
                While you wait for our AI calculator, contact us to get instant quotes for your
                journey.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ url('/book-now') }}" class="btn btn-outline-primary">
                    <i class="fas fa-phone me-2"></i>Call for Instant Booking
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('notifyForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const email = form.querySelector('input[type="email"]').value;
            const phone = form.querySelector('input[type="tel"]').value;

            const button = form.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;

            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
            button.disabled = true;

            fetch("{{ route('notify-me') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        email,
                        phone
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.innerHTML = '<i class="fas fa-check me-2"></i>You\'re on the list!';
                        button.classList.replace('btn-ai', 'btn-success');
                    } else if(data.success == false){
                        button.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>' + data.message;
                        button.classList.replace('btn-ai', 'btn-danger');
                    } else {
                        button.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Try Again';
                        button.classList.replace('btn-ai', 'btn-danger');
                    }

                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.classList.remove('btn-success', 'btn-danger');
                        button.classList.add('btn-ai');
                        button.disabled = false;
                        form.reset();
                    }, 3000);
                })
                .catch(() => {
                    button.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Error';
                    button.classList.replace('btn-ai', 'btn-danger');

                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.classList.remove('btn-danger');
                        button.classList.add('btn-ai');
                        button.disabled = false;
                    }, 3000);
                });
        });
    </script>
@endsection
