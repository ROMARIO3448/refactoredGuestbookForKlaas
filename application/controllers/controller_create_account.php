<?php

class Controller_Create_Account extends Controller
{
	function __construct()
	{
		$this->model = new Model_Create_Account();
		$this->view = new View();
	}
	
	function action_index($params)
	{
        $listOfProblems = array(["Please enter your full name"], 
        ["Please provide an email address"], 
        ["Please create a password"]);
        $problemDescription = "";
        $successMessage = ["You have been registered!\nPlease verify your email!", 
        "\nYour name is: ", "\nYour email is: ", "\nYour password is: "];
        $successDescription = "";

        $options = [];
        $data = [];
        if(isset($_POST['submit']))
        {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if ($name == "" || $email == "" || $password == "")
            {
                if ($name == "")
                {
                    $problemDescription.=$listOfProblems[0][0]."\n";
                }
                if ($email == "")
                {
                    $problemDescription.=$listOfProblems[1][0]."\n";
                }
                if ($password == "")
                {
                    $problemDescription.=$listOfProblems[2][0]."\n";
                }
            }
            else
            {
                $options["name"] = $name;
                $options["email"] = $email;
                $options["password"] = $password;
                
                $data = $this->model->get_data($options);
                if($data["isFormValid"])
                {
                    $successDescription = $successMessage[0].
                    $successMessage[1].$data["name"].$successMessage[2].
                    $data["email"].$successMessage[3].$data["password"];
                }
                else
                {
                    $problemDescription .= $data["problemDescription"];
                }
            }
        }

        $this->view->generate('create_account_view.php', 
        array("problemDescription"=>$problemDescription, 
        "successDescription"=> $successDescription)); 
    }
}
                    
