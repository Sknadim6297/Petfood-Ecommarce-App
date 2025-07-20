<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - PetNet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anybody:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #fe5716;
            --primary-dark: #e54e14;
            --primary-light: #ff7a3d;
            --secondary-color: #6c757d;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --text-dark: #1e293b;
            --bg-light: #fff8e5;
            
            /* Pet-themed gradients */
            --gradient-primary: linear-gradient(135deg, #fe5716 0%, #ff7a3d 100%);
            --gradient-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-overlay: linear-gradient(45deg, rgba(254, 87, 22, 0.1) 0%, rgba(255, 122, 61, 0.1) 100%);
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Anybody', sans-serif;
            background: var(--bg-light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(254, 87, 22, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 122, 61, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(254, 87, 22, 0.05) 0%, transparent 50%);
            animation: backgroundFloat 8s ease-in-out infinite;
        }

        @keyframes backgroundFloat {
            0%, 100% { 
                transform: scale(1) rotate(0deg);
                opacity: 0.7;
            }
            50% { 
                transform: scale(1.1) rotate(180deg);
                opacity: 1;
            }
        }

        /* Floating Pet Elements */
        .floating-pets {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 1;
        }

        .pet-icon {
            position: absolute;
            color: rgba(254, 87, 22, 0.1);
            font-size: 24px;
            animation: floatPet 12s ease-in-out infinite;
        }

        .pet-icon:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
            font-size: 32px;
        }

        .pet-icon:nth-child(2) {
            top: 20%;
            right: 15%;
            animation-delay: 2s;
            font-size: 28px;
        }

        .pet-icon:nth-child(3) {
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
            font-size: 36px;
        }

        .pet-icon:nth-child(4) {
            bottom: 20%;
            right: 10%;
            animation-delay: 6s;
            font-size: 24px;
        }

        .pet-icon:nth-child(5) {
            top: 50%;
            left: 5%;
            animation-delay: 8s;
            font-size: 30px;
        }

        @keyframes floatPet {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg) scale(1);
                opacity: 0.3;
            }
            25% { 
                transform: translateY(-20px) rotate(90deg) scale(1.1);
                opacity: 0.6;
            }
            50% { 
                transform: translateY(-10px) rotate(180deg) scale(0.9);
                opacity: 0.8;
            }
            75% { 
                transform: translateY(-30px) rotate(270deg) scale(1.2);
                opacity: 0.4;
            }
        }

        /* Main Login Container */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: var(--shadow-2xl);
            overflow: hidden;
            position: relative;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        /* Header Section */
        .login-header {
            background: linear-gradient(135deg, #fe5716 0%, #ff7a3d 50%, #fe5716 100%);
            color: white;
            text-align: center;
            padding: 40px 30px 30px;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: headerShine 4s ease-in-out infinite;
        }

        @keyframes headerShine {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .login-header * {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            animation: logoPulse 3s ease-in-out infinite;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes logoPulse {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
            }
            50% { 
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            }
        }

        .login-title {
            font-family: 'DynaPuff', cursive;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-subtitle {
            font-size: 16px;
            opacity: 0.95;
            font-weight: 500;
            margin-bottom: 0;
        }

        /* Form Section */
        .login-body {
            padding: 40px 30px;
            background: white;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
            font-family: 'DynaPuff', cursive;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-family: 'Anybody', sans-serif;
            font-weight: 500;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 4px rgba(254, 87, 22, 0.1);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .form-control:focus + .form-icon {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.1);
        }

        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 18px 20px;
            background: var(--gradient-primary);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
            font-family: 'DynaPuff', cursive;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(254, 87, 22, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        /* Alert Styles */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: none;
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border-left: 4px solid #dc2626;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert i {
            font-size: 16px;
            flex-shrink: 0;
        }

        /* Back Link */
        .back-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }

        .back-link a {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
        }

        .back-link a:hover {
            color: var(--primary-color);
            background: rgba(254, 87, 22, 0.05);
            transform: translateX(-3px);
        }

        /* Loading State */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .login-wrapper {
                padding: 15px;
            }
            
            .login-header {
                padding: 30px 20px 25px;
            }
            
            .login-body {
                padding: 30px 20px;
            }

            .brand-logo {
                width: 70px;
                height: 70px;
                font-size: 28px;
            }

            .login-title {
                font-size: 24px;
            }

            .login-subtitle {
                font-size: 14px;
            }

            .form-control {
                padding: 14px 16px 14px 45px;
                font-size: 16px;
            }

            .form-icon {
                left: 15px;
                font-size: 16px;
            }

            .btn-login {
                padding: 16px 20px;
                font-size: 14px;
            }
        }

        /* Success Animation */
        .success-animation {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow-2xl);
            text-align: center;
            opacity: 0;
            animation: successAppear 0.5s ease-out forwards;
        }

        @keyframes successAppear {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8);
            }
            100% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 32px;
            animation: successBounce 0.6s ease-out 0.2s both;
        }

        @keyframes successBounce {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <!-- Floating Pet Icons -->
    <div class="floating-pets">
        <div class="pet-icon"><i class="fas fa-paw"></i></div>
        <div class="pet-icon"><i class="fas fa-dog"></i></div>
        <div class="pet-icon"><i class="fas fa-cat"></i></div>
        <div class="pet-icon"><i class="fas fa-bone"></i></div>
        <div class="pet-icon"><i class="fas fa-heart"></i></div>
    </div>

    <div class="login-wrapper">
        <div class="login-container">
            <!-- Header -->
            <div class="login-header">
                <div class="brand-logo">
                    <i class="fas fa-paw"></i>
                </div>
                <h1 class="login-title">PetNet Admin</h1>
                <p class="login-subtitle">Welcome back! Please sign in to manage your pet store</p>
            </div>
            
            <!-- Form -->
            <div class="login-body">
                @if ($errors->any())
                    <div class="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}" id="loginForm">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="position-relative">
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="Enter your email address" value="{{ old('email') }}" required>
                            <i class="fas fa-envelope form-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Enter your password" required>
                            <i class="fas fa-lock form-icon"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        <span class="btn-text">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Sign In to Dashboard
                        </span>
                    </button>
                </form>

                <div class="back-link">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i>
                        Back to PetNet Website
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhanced login form interactions
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const btnText = loginBtn.querySelector('.btn-text');

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                loginBtn.classList.add('loading');
                btnText.style.opacity = '0';
                
                // Add some delay to show the loading animation
                setTimeout(() => {
                    // The form will actually submit
                }, 100);
            });

            // Enhanced input focus effects
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });

                // Floating label effect
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.style.backgroundColor = 'white';
                    } else {
                        this.style.backgroundColor = '#f8fafc';
                    }
                });
            });

            // Add enter key support
            inputs.forEach((input, index) => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        } else {
                            form.submit();
                        }
                    }
                });
            });

            // Smooth page entrance animation
            document.querySelector('.login-container').style.transform = 'translateY(50px)';
            document.querySelector('.login-container').style.opacity = '0';
            
            setTimeout(() => {
                document.querySelector('.login-container').style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                document.querySelector('.login-container').style.transform = 'translateY(0)';
                document.querySelector('.login-container').style.opacity = '1';
            }, 100);
        });

        // Show success animation on successful login
        @if(session('success'))
        setTimeout(() => {
            document.body.insertAdjacentHTML('beforeend', `
                <div class="success-animation">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h3 style="color: #2c3e50; margin-bottom: 10px; font-family: 'DynaPuff', cursive;">Login Successful!</h3>
                    <p style="color: #6c757d; margin: 0;">Redirecting to dashboard...</p>
                </div>
            `);
        }, 100);
        @endif
    </script>
</body>
</html>
