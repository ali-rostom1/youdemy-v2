<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Pending Approval</title>
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/output.css">
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full mx-4">
        <div class="text-center">
            <div class="text-6xl mb-4">⏳</div>
            <h1 class="text-2xl font-bold text-blue-600 mb-4">Pending Approval</h1>
            <p class="text-gray-600 mb-4">
                Your account is currently under review. This process typically takes 24-48 hours.
            </p>
            <div class="flex items-center justify-center space-x-2 mb-6">
                <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                <div class="w-2 h-2 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
            </div>
            <p class="text-gray-600 mb-8">
                We'll notify you via email once your account has been approved.
            </p>
            <a href="/logout" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                Log out
            </a>
        </div>
    </div>
</body>
</html>