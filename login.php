<?php
require_once 'includes/auth.php';

// Check if already logged in
if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($auth->login($email, $password)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Invalid email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Woolify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 via-green-200 to-green-400">
    <div class="w-full min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 sm:p-10 border border-green-100 flex flex-col items-center">
            <div class="flex flex-col items-center mb-6">
                <div class="w-16 h-16 rounded-full bg-green-200 flex items-center justify-center mb-2 shadow-lg">
                    <i class="fas fa-lock text-green-600 text-3xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-green-800 mb-1">Welcome Back</h2>
                <p class="text-base text-green-700">Sign in to your account</p>
            </div>

            <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded w-full mb-2 text-center" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
            <?php endif; ?>

            <form class="w-full space-y-5" method="POST">
                <div>
                    <input id="email" name="email" type="email" required placeholder="Email address"
                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                </div>
                <div>
                    <input id="password" name="password" type="password" required placeholder="Password"
                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded transition-all">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="forgot_password.php" class="font-medium text-green-700 hover:text-green-900 transition-all">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <button type="submit"
                    class="w-full flex justify-center items-center py-3 px-4 rounded-xl text-white font-semibold bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 shadow-lg hover:scale-105 transition-all focus:outline-none focus:ring-2 focus:ring-green-400">
                    <i class="fas fa-sign-in-alt mr-2"></i> Sign in
                </button>
            </form>

            <div class="w-full flex flex-col items-center mt-6">
                <div class="w-full border-t border-green-200 my-4"></div>
                <p class="text-base text-gray-700">
                    Don't have an account?
                    <a href="register.php" class="font-semibold text-green-700 hover:text-green-900 underline transition-all">Register here</a>
                </p>
                <p class="text-base text-green-700 mt-2">
                    <a href="index.php" class="font-semibold hover:text-green-900 underline transition-all">
                        <i class="fas fa-home"></i> Go to Home Page
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>