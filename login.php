<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem E-Hassina</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96 mx-4">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Sistem Login</h2>
        
        <form method="POST" action="proses_login.php">
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2 text-gray-700">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded border-gray-300 text-black focus:outline-blue-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2 text-gray-700">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded border-gray-300 text-black focus:outline-blue-500" required>
            </div>
            <button type="submit" name="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700 font-semibold shadow">Masuk</button>
        </form>
    </div>

</body>
</html>