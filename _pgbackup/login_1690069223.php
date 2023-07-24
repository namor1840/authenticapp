<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/theme.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Adlam&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Adlam+Unjoined&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Anatolian+Hieroglyphs&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Arabic&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+Armenian&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:600,400,500&display=swap">
</head>

<body>
    <div class="container">
        <img src="devchallenges.svg" style="width: 130.17px; height: 18px; display: flex;" />
       
        <form class="login-form" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
        <p class="socialmedia">or continue with these social profile</P>
        <div class="socialmlogos">
            <img src="./Google.svg">
            <img src="./Facebook.svg">
            <img src="./Twitter.svg">
            <img src="./Gihub.svg">
        </div>
        <p>Don’t have an account yet? <a href="index.php">Register</a></p>
    </div>
    
</body>

</html>