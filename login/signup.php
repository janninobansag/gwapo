<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4 text-center">Sign Up</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'] ?? '';
                    $email = $_POST['email'] ?? '';
                    $password = $_POST['password'] ?? '';
                    $confirm_password = $_POST['confirm_password'] ?? '';

                    // Simple validation
                    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                        echo '<div class="alert alert-danger">All fields are required.</div>';
                    } elseif ($password !== $confirm_password) {
                        echo '<div class="alert alert-danger">Passwords do not match.</div>';
                    } else {
                        // Save user data to a file (for demo purposes)
                        $user_data = [
                            'username' => $username,
                            'email' => $email,
                            'password' => password_hash($password, PASSWORD_DEFAULT)
                        ];
                        file_put_contents('user.json', json_encode($user_data));
                        echo '<div class="alert alert-success">Registration successful! Redirecting to login...</div>';
                        header("refresh:2;url=login.php");
                        exit;
                    }
                }
                ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                </form>
                <div class="mt-3 text-center">
                    <span>Already have an account? </span>
                    <a href="login.php">Log In</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS CDN (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>