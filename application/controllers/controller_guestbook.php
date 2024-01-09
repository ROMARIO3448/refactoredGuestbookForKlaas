<?php

class Controller_Guestbook extends Controller
{
    public $model;
    public $view;

	function __construct()
	{
		$this->model = new Model_Guestbook();
		$this->view = new View();
	}

    function action_echo_reviews()
    {
        if (!Controller::isAjaxRequest()) {
            Controller::sendForbiddenResponse();
        }

        $reviews = $this->model->getLatestReviewsWithLimit();

        foreach($reviews as $name => $review)
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
	
	function action_index($params)
	{
        $options = [];
        $data = [];

        session_start();
        if (isset($_SESSION["_id"])) {
            $options["_id"] = $_SESSION["_id"];
            $data = $this->model->get_data($options);
            if($data["isSuchUserExists"])
            {
                $data["isLoggedIn"] = "You are logged in";
                unset($data["isSuchUserExists"]);
            }
        }
        session_write_close();

		$this->view->generate('guestbook_view.php', $data);
	}
}
