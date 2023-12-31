<?php

class Controller_Confirm_Email extends Controller
{
	function __construct()
	{
		$this->model = new Model_Confirm_Email();
		$this->view = new View();
	}

    private function redirect() {
        header('Location: guestbook');
        exit();
    }

	function action_index($params)
	{
        if (!isset($params['email']) || !isset($params['token'])) {
            $this->redirect();
        }
        else
        {
            $data = [];
            $email = $params['email'];
            $token = $params['token'];
            $options = [];
            $options["email"] = $email;
            $options["token"] = $token;
            $data = $this->model->get_data($options);
            if($data["isVerificationPassed"])
            {
                setcookie("_id", $data["idForCookie"], time() + 3600);
                $this->redirect();
            }
            else
            {
                $this->redirect();
            }
            $this->view->generate('confirm_email_view.php');
        }
    }
}