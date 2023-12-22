<?php

class Controller_Write_Review extends Controller
{
	function __construct()
	{
		$this->model = new Model_Write_Review();
		$this->view = new View();
	}

    private function redirect() {
        header('Location: sign_in');
        exit();
    }
	
	function action_index($params)
	{
        $options = [];
        $data = [];
        $userName = "";
        $listOfProblems = array("Please enter your review");
        $problemDescription = "";
        $successMessage = "Thank you for your review ";
        $successDescription = "";
        if(isset($_COOKIE["_id"]))
        {
            //если айди есть и он валидный, то устанавливаем его в опции
            //+заодно записываем $userName
            $userName = $this->model->isIdValid($_COOKIE["_id"]);
            if($userName)
            {
                $options["_id"] = $_COOKIE["_id"];
            }
            else
            {
                //это занчит, что айди установлено, но либо такого айди нет в базе данных
                //либо есть, но имени у него нет
                $this->redirect();
            }
        }
        else
        {
            //если айди не установлен, то дальнейший код бессмысленен. 
            //Перенаправляем на страничку sign_in
            $this->redirect();
        }
        //если нас не перенаправило, то это значит, что айди есть в куки и в БД и имя юзера тоже есть

        //теперь если айди есть и оно валидно пришло время проверить нажал ли уже пользователь на
        //кнопку submit, то есть попытался ли он уже оставить своё ревью
        if(isset($_POST["submit"]))
        {
            if(!$_POST["review"])
            {
                //если ревью пустое, то добавляем описание проблемы
                $problemDescription = $listOfProblems[0];
            }
            else
            {
                //в противном случае передаёт дальнейшую обработку на Модель
                //если нас ещё не заредиректило, то $options["_id"] уже должно было быть
                //установлено, поэтому в опции передаём только ревью
                $options["review"] = $_POST["review"];
                $data = $this->model->get_data($options);
                
                if($data["problemDescription"])
                {
                    $problemDescription = $data["problemDescription"];
                }
                //если при обновлении ревью в модели не возникло никаких проблем, то можно
                //генерить ОписаниеУспеха. Просто ранее я не учёл, что пользователь мог только 
                //попасть на страничку и ещё не нажать Submit и как итог какждый раз вроде бы и ошибок 
                //не было, а вроде бы и ревью никакого не оставлял
                else
                {
                    $successDescription = $successMessage.$userName;
                }
            }
        }
        //по итогу передаю как и описание проблемы так и описание успеха
		$this->view->generate('write_review_view.php', 
        array("problemDescription"=>$problemDescription, 
        "successDescription"=> $successDescription)); 
	}
}
