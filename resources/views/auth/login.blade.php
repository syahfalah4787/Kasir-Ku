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
            background-color: #f3f4f6;
            font-family: 'Instrument Sans', sans-serif;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.5rem;
        }
        .btn-primary {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        .btn-primary:hover {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
        }
        .sub-text {
            color: #6b7280;
        }
        .top-bar {
            background-color: white;
            padding: 10px 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
        }
        .top-logo {
            color: #0ea5e9; /* Sky blue */
            font-weight: bold;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-logo">
            <i class="bi bi-shop"></i> 
            <span style="color: #000;">Kasir Ku</span> <span style="font-weight: normal; color: #666; margin-left: 5px;">| Login</span>
        </div>
    </div>

    <div class="min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <!-- Logo Section -->
        <div class="text-center mb-4">
            <div class="d-flex align-items-center justify-content-center gap-2 mb-1">
                <div class="bg-info rounded p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-shop" viewBox="0 0 16 16">
                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h-1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5H1.5a.5.5 0 0 1-.5-.5v-6zM4 10h8v4H4v-4z"/>
                    </svg>
                </div>
                <h1 class="h3 mb-0 fw-bold">Kasir Ku</h1>
            </div>
            <p class="sub-text">Sistem Kasir Online</p>
        </div>

        <!-- Login Card -->
        <div class="card login-card p-4 bg-white">
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label text-muted small fw-bold">Username</label>
                    <input type="text" class="form-control bg-light" id="username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-muted small fw-bold">Password</label>
                    <input type="password" class="form-control bg-light" id="password" placeholder="Password">
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary py-2">Sign In</button>
                </div>
                <div class="mt-3">
                    <a href="#" class="text-muted text-decoration-none small">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
