<?php
    $problemDescription = $data["problemDescription"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./css/reset.css" />
        <link rel="stylesheet" href="./css/common.css" />
        <link rel="stylesheet" href="./css/sign-in-style.css" />
        <script defer src="./scripts/jquery-3.7.1.min.js"></script>
        <script defer type="module" src="./scripts/ProperFocusinFocusoutBehaviour.js"></script>
        <script defer type="module" src="./scripts/PasswordVisibilityToggler.js"></script>
        <script defer type="module" src="./scripts/ProblemSuccessDisplayManager.js"></script>
        <script defer type="module" src="./scripts/sign-in.js"></script>
        <script defer src="./scripts/redirect.js"></script>
        <title>Sign in</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="sign-in">
                <div class="sign-in__container _container">
                    <div class="sign-in__problem problem">
                        <div class="problem__title">There was a problem</div>
                        <pre class="problem__description"><?=$problemDescription?></pre>
                    </div>
                    <form class="sign-in__input-form input-form" action="sign_in" method="post">
                        <div class="input-form__title">Sign in</div>
                        <input class="input-form__text-input" type="text" 
                        name="email" placeholder="Your email address">
                        <div class="input-form__password-input">
                            <input type="password" name="password" placeholder="Enter your password...">
                            <img src="./assets/show.png" alt="">
                        </div>
                        <input class="input-form__submit" type="submit" name="submit" 
                        value="Sign in">
                    </form>
                    <div class="_redirect">
                        Create a new Guestbook account
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

