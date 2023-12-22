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
        <link rel="stylesheet" href="./css/write-review-style.css" />
        <script defer src="./scripts/jquery-3.7.1.min.js"></script>
        <script defer type="module" src="./scripts/ProblemSuccessDisplayManager.js"></script>
        <script defer type="module" src="./scripts/write-review.js"></script>
        <script defer src="./scripts/redirect.js"></script>
        <title>Write review</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="write-review">
                <div class="write-review__container _container">
                    <div class="write-review__success success">
                        <pre class="success__description"><?= $successDescription ?></pre>
                    </div>
                    <div class="write-review__problem problem">
                        <div class="problem__title">There was a problem</div>
                        <pre class="problem__description"><?= $problemDescription ?></pre>
                    </div>
                    <form class="write-review__input-form input-form" action="write_review" method="post">
                        <div class="input-form__title">Write your review</div>
                        <input class="input-form__text-input" type="text" 
                        name="review" placeholder="Your review...">
                        <input class="input-form__submit" type="submit" name="submit" 
                        value="Submit your review">
                    </form>
                    <div class="_redirect">
                        Go to Home Page
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>