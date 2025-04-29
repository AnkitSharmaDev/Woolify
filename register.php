<?php
require_once 'includes/auth.php';

// Check if already logged in
if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? '';
    $farmName = $_POST['farm_name'] ?? '';
    $storeName = $_POST['store_name'] ?? '';
    $address = $_POST['address'] ?? '';

    // Validate input
    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $error = 'All fields are required';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $error = 'Name should only contain letters and spaces';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
        $error = 'Email must be a valid Gmail address';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long';
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password)) {
        $error = 'Password must contain at least 1 letter, 1 number, and 1 special character';
    } elseif (preg_match('/^[@$!%*#?&]/', $password)) {
        $error = 'Password cannot start with a special character';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match';
    } elseif ($role === 'FARMER' && empty($farmName)) {
        $error = 'Farm name is required for farmers';
    } elseif ($role === 'RETAILER' && empty($storeName)) {
        $error = 'Store name is required for retailers';
    } else {
        try {
            $db = Database::getInstance();
            $db->beginTransaction();

            // Check if email already exists
            $stmt = $db->query("SELECT id FROM users WHERE email = ?", [$email]);
            if ($stmt->fetch()) {
                throw new Exception('Email already registered');
            }

            // Create user
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->query(
                "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)",
                [$name, $email, $hashedPassword, $role]
            );
            $userId = $db->lastInsertId();

            // Create role-specific record
            if ($role === 'FARMER') {
                $db->query(
                    "INSERT INTO farmers (user_id, farm_name, farm_address) VALUES (?, ?, ?)",
                    [$userId, $farmName, $address]
                );
            } elseif ($role === 'RETAILER') {
                $db->query(
                    "INSERT INTO retailers (user_id, store_name, store_address) VALUES (?, ?, ?)",
                    [$userId, $storeName, $address]
                );
            }

            $db->commit();
            $success = 'Registration successful! You can now login.';
            
            // Redirect to login page after successful registration
            header('Location: login.php?registered=1');
            exit();
        } catch (Exception $e) {
            $db->rollBack();
            $error = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Woolify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 via-green-200 to-green-400">
    <div class="w-full min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-8 sm:p-10 border border-green-100 flex flex-col items-center">
            <div class="flex flex-col items-center mb-6">
                <div class="w-16 h-16 rounded-full bg-green-200 flex items-center justify-center mb-2 shadow-lg">
                    <i class="fas fa-seedling text-green-600 text-3xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-green-800 mb-1">Create your account</h2>
                <p class="text-base text-green-700">Join the Woolify community</p>
            </div>
            <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded w-full mb-2 text-center" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
            <?php endif; ?>
            <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded w-full mb-2 text-center" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($success); ?></span>
            </div>
            <?php endif; ?>
            <form class="w-full space-y-5" method="POST">
                <div>
                    <input id="name" name="name" type="text" required placeholder="Full Name"
                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                </div>
                <div>
                    <input id="email" name="email" type="email" required placeholder="Email address"
                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                </div>
                <div class="flex gap-3">
                    <input id="password" name="password" type="password" required placeholder="Password"
                        class="block w-1/2 px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                    <input id="confirm_password" name="confirm_password" type="password" required placeholder="Confirm Password"
                        class="block w-1/2 px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                </div>
                <div>
                    <select id="role" name="role" required
                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all">
                        <option value="">Select Role</option>
                        <option value="FARMER">Farmer</option>
                        <option value="RETAILER">Retailer</option>
                    </select>
                </div>
                <div id="farmer-fields" class="hidden">
                    <input id="farm_name" name="farm_name" type="text" placeholder="Farm Name"
                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                </div>
                <div id="retailer-fields" class="hidden">
                    <input id="store_name" name="store_name" type="text" placeholder="Store Name"
                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                </div>
                <div>
                    <input id="address" name="address" type="text" required placeholder="Address"
                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-500 shadow-sm transition-all" />
                </div>
                <button type="submit"
                    class="w-full flex justify-center items-center py-3 px-4 rounded-xl text-white font-semibold bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 shadow-lg hover:scale-105 transition-all focus:outline-none focus:ring-2 focus:ring-green-400">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </button>
            </form>
            <div class="w-full flex flex-col items-center mt-6">
                <div class="w-full border-t border-green-200 my-4"></div>
                <p class="text-base text-gray-700">
                    Already have an account?
                    <a href="login.php" class="font-semibold text-green-700 hover:text-green-900 underline transition-all">Sign in</a>
                </p>
                <p class="text-base text-green-700 mt-2">
                    <a href="index.php" class="font-semibold hover:text-green-900 underline transition-all">
                        <i class="fas fa-home"></i> Go to Home Page
                    </a>
                </p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('role').addEventListener('change', function() {
            const farmerFields = document.getElementById('farmer-fields');
            const retailerFields = document.getElementById('retailer-fields');
            if (this.value === 'FARMER') {
                farmerFields.classList.remove('hidden');
                retailerFields.classList.add('hidden');
            } else if (this.value === 'RETAILER') {
                farmerFields.classList.add('hidden');
                retailerFields.classList.remove('hidden');
            } else {
                farmerFields.classList.add('hidden');
                retailerFields.classList.add('hidden');
            }
        });
    </script>
</body>
</html> 