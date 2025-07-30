<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-box {
            max-width: 400px;
            margin: auto;
            margin-top: 10vh;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            margin-bottom: 25px;
            font-weight: 600;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="login-box">
            <h2 class="login-title">Login</h2>
            <form action="/login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        required />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        required />
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="/forgot-password">Forgot password?</a><br />
                <span>Don't have an account?</span>
                <a href="/register">Register</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for components like alerts or modals) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>