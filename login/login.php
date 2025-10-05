<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4 text-center">Login</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'] ?? '';
                    $password = $_POST['password'] ?? '';

                    // Simple validation
                    if (empty($username) || empty($password)) {
                        echo '<div class="alert alert-danger">Both fields are required.</div>';
                    } else {
                        // Here you would check credentials against your database
                        // Example: if ($username == "admin" && $password == "password")
                        // Load user data from file
                        if (file_exists('user.json')) {
                            $user_data = json_decode(file_get_contents('user.json'), true);
                            if (
                                $username === $user_data['username'] &&
                                password_verify($password, $user_data['password'])
                            ) {
                                header("Location: vincent.php");
                                exit;
                            } else {
                                echo '<div class="alert alert-danger">Invalid username or password.</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">No account found. Please sign up first.</div>';
                        }
                    }
                }
                ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="mt-3 text-center">
                    <span>You don't have an account? </span>
                    <a href="signup.php">Sign In</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS CDN (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>