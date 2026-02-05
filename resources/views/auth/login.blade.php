<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Ku | Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #e8e9ed;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }
        .top-bar {
            background-color: white;
            padding: 12px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
        }
        .top-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1rem;
        }
        .top-logo i {
            color: #0ea5e9;
            font-size: 1.3rem;
        }
        .top-logo .brand-name {
            color: #000;
            font-weight: 600;
        }
        .top-logo .page-name {
            font-weight: 400;
            color: #666;
            margin-left: 3px;
        }
        .login-container {
            min-height: calc(100vh - 60px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-title-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }
        .logo-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }
        .logo-icon {
            width: 60px;
            height: 60px;
            background-color: #0ea5e9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-icon i {
            color: white;
            font-size: 32px;
        }
        .logo-subtitle {
            font-size: 1rem;
            color: #9ca3af;
            margin: 0;
        }
        .login-card {
            background: white;
            border-radius: 12px;
            padding: 35px 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 480px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.95rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background-color: #f9fafb;
            transition: all 0.2s;
            box-sizing: border-box;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .form-control::placeholder {
            color: #9ca3af;
        }
        .btn-signin {
            width: 100%;
            padding: 13px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }
        .btn-signin:hover {
            background-color: #2563eb;
        }
        .forgot-password {
            display: block;
            margin-top: 16px;
            font-size: 0.875rem;
            color: #6b7280;
            text-decoration: none;
            transition: color 0.2s;
        }
        .forgot-password:hover {
            color: #374151;
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-logo">
            <i class="bi bi-shop"></i>
            <span class="brand-name">Kasir Ku</span>
            <span class="page-name">| Login</span>
        </div>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <!-- Logo Section -->
        <div class="logo-section">
            <div class="logo-title-wrapper">
                <h1 class="logo-title">Kasir Ku</h1>
                <div class="logo-icon">
                    <i class="bi bi-shop"></i>
                </div>
            </div>
            <p class="logo-subtitle">Sistem Kasir Online</p>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <form>
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn-signin">Sign In</button>
                <a href="#" class="forgot-password">Forgot password?</a>
            </form>
        </div>
    </div>
</body>
</html>

