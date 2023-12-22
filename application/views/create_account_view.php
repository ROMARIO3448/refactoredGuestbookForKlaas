<?php
$successDescription = $data["successDescription"];
$problemDescription = $data["problemDescription"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./css/reset.css" />
        <link rel="stylesheet" href="./css/common.css" />
        <link rel="stylesheet" href="./css/create-account-style.css" />
        <script defer src="./scripts/jquery-3.7.1.min.js"></script>
        <script defer type="module" src="./scripts/ProperFocusinFocusoutBehaviour.js"></script>
        <script defer type="module" src="./scripts/PasswordVisibilityToggler.js"></script>
        <script defer type="module" src="./scripts/ProblemSuccessDisplayManager.js"></script>
        <script defer type="module" src="./scripts/create-account.js"></script>
        <script defer src="./scripts/redirect.js"></script>
        <title>Create account</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="create-account">
                <div class="create-account__container _container">
                    <div class="create-account__success success">
                        <pre class="success__description"><?= $successDescription ?></pre>
                    </div>
                    <div class="create-account__problem problem">
                        <div class="problem__title">There was a problem</div>
                        <pre class="problem__description"><?= $problemDescription ?></pre>
                    </div>
                    <form class="create-account__input-form input-form" action="create_account" method="post">
                        <div class="input-form__title">Create account</div>
                        <input class="input-form__text-input" type="text" 
                        name="name" placeholder="First and last name">
                        <input class="input-form__text-input" type="text" 
                        name="email" placeholder="Your email address">
                        <div class="input-form__password-input">
                            <input type="password" name="password" placeholder="Create a password">
                            <img src="./assets/show.png" alt="">
                        </div>
                        <input class="input-form__submit" type="submit" name="submit" 
                        value="Create your Guestbook account">
                    </form>
                    <div class="_redirect">
                        Sign in now
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
