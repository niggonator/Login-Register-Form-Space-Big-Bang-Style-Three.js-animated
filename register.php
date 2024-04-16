<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | YourWebsite</title>
    <style>
        /* CSS */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #background { position: fixed; top: 0; left: 0; width: 100%; height: 100%; }
        
        .box {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            width: 20%;
            min-height: 8%;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        #emailInput {
            display: none;
            width: 70%
        }
        
        #passwordInput {
            display: none;
            width: 70%
        }
        
        #usernameInput {
            display: none;
            width: 70%
        }
        
        #submitEmail {
            display: none; 
            margin-left: 10px;
            width: 30%
            border: 1px;
            border-radius: 5px;
            background-image: linear-gradient(to right, #fa1560, #ffb157);;
            color: white;
            cursor: pointer;
        }
        
        #submitPassword {
            display: none; 
            margin-left: 10px;
            width: 30%
            border: 2px;
            border-radius: 5px;
            background-image: linear-gradient(to right, #fa1560, #ffb157);;
            color: white;
            cursor: pointer;
        }
        
        #submitUsername {
            display: none; 
            margin-left: 10px;
            width: 30%
            border: 2px;
            border-radius: 5px;
            background-image: linear-gradient(to right, #fa1560, #ffb157);;
            color: white;
            cursor: pointer;
        }
        
        .input-container {
            display: flex;
            align-items: center;
        }
        
        
    </style>
</head>
<body>
<div id="background"></div>

    <div class="box">
        <p id="text"></p>
        <form id="registerForm" action="registerscript.php" method="post">
        <div class="input-container">
            <input type="email" id="emailInput" name="email" placeholder="" required>
            <button type="button" id="submitEmail">Continue</button>
        </div>
        <p id="passwordText" style="display: none;">Create a password</p>
        <div class="input-container">
            <input type="password" id="passwordInput" name="password" placeholder="" required>
            <button type="button" id="submitPassword">Continue</button>
        </div>
        <p id="usernameText" style="display: none;">Enter username</p>
        <div class="input-container">
            <input id="usernameInput" name="username" placeholder="" required">
            <button type="submit" id="submitUsername">Register</button>
        </div>
    </form>
    </div>
    
    <script src="https://unpkg.com/three@0.135.0/build/three.min.js"></script>
    <script src="./registeranimation.js"></script>

</body>
</html>
