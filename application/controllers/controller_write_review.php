<?php

class Controller_Write_Review extends Controller
{
    public $model;
    public $view;
    private $userName;
    private $_id;

	function __construct()
	{
		$this->model = new Model_Write_Review();
		$this->view = new View();
	}

    private function redirect() {
        header('Location: sign_in');
        exit();
    }

    function action_handle_review()
    {
        $this->initializeUserData();

        if (!Controller::isAjaxRequest()) {
            Controller::sendForbiddenResponse();
        }

        $dataForResponse = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dataFromClient = $_POST;
        
            if (empty($dataFromClient)) {
                $json = file_get_contents("php://input");
                $dataFromClient = json_decode($json, true);
            }

            $options = [];
            $data = [];
            $successMessage = "Thank you for your review ";
            if (empty($dataFromClient["review"])) {
                $dataForResponse = [
                    "problemDescription" => "Please enter your review",
                ];
                header("Content-Type: application/json");
                echo json_encode($dataForResponse);
                exit();
            }
            else
            {
                $options["_id"] = $this->_id;
                $options["review"] = $dataFromClient["review"];
                $data = $this->model->get_data($options);
                
                if($data["problemDescription"])
                {
                    $dataForResponse = [
                        "problemDescription" => $data["problemDescription"],
                    ];
                }
                else
                {
                    $dataForResponse = [
                        "successDescription" => $successMessage.$this->userName,
                    ];
                }

                header('Content-Type: application/json');
                echo json_encode($dataForResponse);
                exit();
            }
        }
        else
        {
            //actions if $_SERVER['REQUEST_METHOD'] !== 'POST'
        }
    }

    private function initializeUserData()
    {
        $this->userName = "";
        $this->_id = "";
        session_start();
        if (isset($_SESSION["_id"])&&!empty($_SESSION["_id"]))
        {
            $this->_id = $_SESSION["_id"];
            session_write_close();
        }
        else
        {
            session_write_close();
            $this->redirect();
        }

        $this->userName = $this->model->getNameById($this->_id);
        if (empty($this->userName)) {
            $this->redirect();
        }
    }
	
	function action_index($params)
	{
        $this->initializeUserData();

		$this->view->generate('write_review_view.php'); 
	}
}
