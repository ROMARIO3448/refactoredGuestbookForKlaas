<?php

class Controller_Sign_In extends Controller
{
	function __construct()
	{
		$this->model = new Model_Sign_In();
		$this->view = new View();
	}

    private function redirect() {
        header('Location: write_review');
        exit();
    }
	
	function action_index($params)
	{
        $listOfProblems = array("Please provide an email address", 
        "Please enter your password",);
        $problemMessage = "Please check your inputs more attentively!";
        $problemDescription = "";

        $options = [];
        $data = [];
        if(isset($_POST['submit']))
        {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if ($email == "" || $password == "")
            {
                if ($email == "")
                {
                    $problemDescription.=$listOfProblems[0]."\n";
                }
                if ($password == "")
                {
                    $problemDescription.=$listOfProblems[1]."\n";
                }
            } 
            else
            {
                $options["email"] = $email;
                $options["password"] = $password;
                $data = $this->model->get_data($options);

                if($data["isSignInPassed"]&&$data["idForCookie"])
                {
                    setcookie("_id", $data["idForCookie"], time() + 3600);
                    $this->redirect();
                }
                else
                {
                    $problemDescription = $problemMessage."\n";
                }
            }
        }
		$this->view->generate('sign_in_view.php', array("problemDescription"=>$problemDescription));
    }
}
	