<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: url('/images/novaimage.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(6px);
            z-index: -1;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-transparent">
    <div class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-50">
        <div class="flex space-x-8">
            <div class="p-8 bg-white rounded-lg shadow-lg w-80">
                <h2 class="mb-6 text-2xl font-bold text-center">Welcome to Novanieuws</h2>
                <p class="mb-6 text-center">Please login or register to continue.</p>
            </div>
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-lg shadow-lg w-80">
                <a href="{{ route('login') }}" class="w-full px-4 py-2 mb-4 text-center text-white bg-yellow-500 rounded">Login</a>
                <a href="{{ route('register') }}" class="w-full px-4 py-2 text-center text-white bg-blue-500 rounded">Register</a>
            </div>
        </div>
    </div>
</body>

</html>
