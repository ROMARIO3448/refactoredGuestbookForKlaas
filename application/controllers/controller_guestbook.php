<?php

class Controller_Guestbook extends Controller
{
	function __construct()
	{
		$this->model = new Model_Guestbook();
		$this->view = new View();
	}
	
	function action_index($params)
	{
        $options = [];
        $options["limit"] = 10;
        $data = [];
        if(isset($_COOKIE["_id"]))
        {
            $options["_id"] = $_COOKIE["_id"];
            $data = $this->model->get_data($options);
            if($data["isSuchUserExists"])
            {
                $data["isLoggedIn"] = "You are logged in";
                unset($data["isSuchUserExists"]);
            }
        }
        else
        {
            $data = $this->model->get_data($options);
        }

		$this->view->generate('guestbook_view.php', $data);
	}
}
