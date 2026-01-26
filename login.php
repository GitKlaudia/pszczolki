<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/login.css">
    <title>B-Movie-Logowanie</title>
</head>
<body class="loginPageBody"> 
<form action="loginscript.php" method="POST" id="loginWrapper">
    <div id="appLogo"></div>
    <input name="username" id="loginInput" type="text" placeholder="Login" required>
    <input name="password" id="passwordInput" type="password" placeholder="Hasło" required>
    
    <div class="loginButtonsRow">
        <button id="loginBtn" type="submit">Zaloguj</button>
        <button id="backBtn" type="button" onclick="window.location.href='index.php'">Powrót</button>
    </div>
</form>
</body>
</html>