<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | YourWebsite</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
        }

        input[type="email"], input[type="password"], button {
            width: calc(100% - 20px); 
            padding: 10px;
            margin-bottom: 10px; 
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-image: linear-gradient(to right, #fa1560, #ffb157);
            width: 100.5%;
            padding: 10px;
            color: #fff;
            border: none;
            cursor: pointer;
    </style>
    <script src="./login.js"></script>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form id="loginForm" onsubmit="login(event)">
            <input type="email" id="email" placeholder="Email" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div>Need an account? <a href="register.php">Sign up</a></div>
    </div>
    
   
</body>
</html>
