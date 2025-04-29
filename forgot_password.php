<?php
// forgot_password.php
// This is a simple password reset form. Backend logic to be added as needed.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Woolify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-green-100 via-white to-green-200 relative">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80')] bg-cover bg-center opacity-10 z-0"></div>
    <div class="max-w-md w-full space-y-8 bg-white/80 rounded-3xl shadow-2xl p-10 border border-green-200 backdrop-blur-md relative z-10 transition-transform duration-300 hover:scale-105 animate-fade-in">
        <div class="text-center">
            <div class="flex justify-center mb-2">
                <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 shadow-lg">
                    <i class="fas fa-key text-3xl text-green-600"></i>
                </span>
            </div>
            <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400 drop-shadow mb-2">Reset your password</h2>
            <p class="text-base text-green-700 mb-4">Enter your email and new password</p>
        </div>
        <form class="space-y-6" method="POST" action="">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" required
                    class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 focus:z-10 sm:text-base transition-all duration-200 shadow-sm hover:border-green-400 bg-white/70"
                    placeholder="Enter your email">
            </div>
            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input id="new_password" name="new_password" type="password" required
                    class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 focus:z-10 sm:text-base transition-all duration-200 shadow-sm hover:border-green-400 bg-white/70"
                    placeholder="Enter new password">
            </div>
            <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="confirm_password" name="confirm_password" type="password" required
                    class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 focus:z-10 sm:text-base transition-all duration-200 shadow-sm hover:border-green-400 bg-white/70"
                    placeholder="Confirm new password">
            </div>
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 shadow-lg transition-all duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-key text-green-200 group-hover:text-green-100"></i>
                    </span>
                    Reset Password
                </button>
            </div>
        </form>
        <div class="text-center mt-4">
            <a href="login.php" class="font-semibold text-green-700 hover:text-green-900 underline transition-all">
                <i class="fas fa-arrow-left"></i> Back to Login
            </a>
        </div>
    </div>
    <style>
    @keyframes fade-in {
      from { opacity: 0; transform: translateY(30px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .animate-fade-in {
      animation: fade-in 0.8s cubic-bezier(.4,0,.2,1) both;
    }
    </style>
</body>
</html>