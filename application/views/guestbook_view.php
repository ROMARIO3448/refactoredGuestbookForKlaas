<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./css/reset.css" />
        <link rel="stylesheet" href="./css/common.css" />
        <link rel="stylesheet" href="./css/guestbook-style.css" />
        <script defer src="./scripts/jquery-3.7.1.min.js"></script>
        <script defer type="module" src="./scripts/ProperFocusinFocusoutBehaviour.js"></script>
        <script defer type="module" src="./scripts/guestbook.js"></script>
        <title>Guestbook</title>
    </head>
    <body>
        <?php 
        $isLoggedIn = "";
        if(isset($data["isLoggedIn"]))
        {
            $isLoggedIn = $data["isLoggedIn"];
        }
        ?>
        <div class="wrapper">
            <div class="guestbook">
                <div class="guestbook__container _container">
                    <div class="guestbook__is-logged-in">
                        <div class='_log-in-status' style='display:none;'>
                            <?=$isLoggedIn?>
                        </div>
                    </div>
                    <div class="guestbook__search search">
                        <div class="search__title">
                            <label >Looking for specific info?</label>
                        </div>
                        <div class="search__input">
                            <img src="./assets/search.png" alt="">
                            <input  type="text" name="" placeholder="Search in reviews...">
                        </div>
                        <div class="search__no-matches">
                            Hmm, no matches. To get an answer, try different keywords.
                        </div>
                    </div>
                    <div class="guestbook__reviews reviews">
                        <div class="reviews__title">Customer reviews</div>
                        <div class="reviews__list">
                            <?php
                                if(isset($data["reviews"]))
                                {
                                    foreach($data["reviews"] as $name => $review)
                                    {
                                        if(strlen($review)>256)
                                        {
                                            $review = substr_replace($review, "", 256, -1);
                                            echo "<div class='reviews__name'>".$name."</div>";
                                            echo "<div class='reviews__review'>$review
                                            <span class='reviews__see-more'>See more</span></div>";
                                        }
                                        else
                                        {
                                            echo "<div class='reviews__name'>".$name."</div>";
                                            echo "<div class='reviews__review'>$review</div>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="guestbook__more-reviews more-reviews">
                        <div class="more-reviews__title">See more reviews</div>
                        <div class="_arrov-placeholder">></div>
                    </div>
                    <div class="guestbook__write-review write-review">
                        <div class="write-review__title">Write a review</div>
                        <div class="_arrov-placeholder">></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
