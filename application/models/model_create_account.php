<?php
include_once "application/models/guestbookMailer.php";

class Model_Create_Account extends Model
{
    private function sanitizeAndVerify($name, $email, $password): array
    {
        $listOfProblems = array(["Your name is not valid"], 
        ["Your email is not valid", "Email address already in use"], 
        ["Your password is not valid"]);
        $problemDescription = "";
        $isFormValid = true;

        $name = strip_tags($name);
        $name = htmlentities($name);
        if($name == "")
        {
            $isFormValid = false;
            $problemDescription .= $listOfProblems[0][0]."\n";
        }

        $emailRegex = '/^[a-z0-9](\.?[a-z0-9]){5,}@g(oogle)?mail\.com$/';
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!preg_match($emailRegex, $email) || !$email)
        {
            $isFormValid = false;
            $problemDescription .= $listOfProblems[1][0]."\n";
        }
        else
        {
            $guestbookusers = Model::getGuestbookUsersCollection();
            $findOneResult = $guestbookusers->findOne(['email' => $email]);
            if($findOneResult)
            {
                $isFormValid = false;
                $problemDescription .= $listOfProblems[1][1]."\n";
            }
        }

        $passwordRegex = '/^.{6,}$/';
        $password = strip_tags($password);
        $password = htmlentities($password);
        if(!preg_match($passwordRegex, $password) || $password == "")
        {
            $isFormValid = false;
            $problemDescription .= $listOfProblems[2][0]."\n";
        }
        
        if($isFormValid)
        {
            return array("name"=>$name,"email"=>$email,"password"=>$password,
            "isFormValid"=>$isFormValid, "problemDescription"=>$problemDescription);
        }
        else
        {
            return array("isFormValid"=>$isFormValid, "problemDescription"=>$problemDescription);
        }
    }

    public function get_data($options)
	{
        $data = [];
        $name = $options["name"];
        $email = $options["email"];
        $password = $options["password"];
        $listOfProblems = array(["Something wrong happened!\nPlease try again!"]);

        $data = $this->sanitizeAndVerify($name, $email, $password);
        if($data["isFormValid"])
        {
            $mailResult = GuestbookMailer::sendMail($data["email"], $data["name"]);
            if($mailResult["isMailSuccesfull"])
            {
                $temporaryguestbookusers = Model::getTemporaryGuestbookUsersCollection();
                $findOneResult = $temporaryguestbookusers->findOne(['email' => $data["email"]]);
                $hashedPassword = password_hash($data["password"], PASSWORD_BCRYPT);
                if(!$findOneResult)
                {
                    $temporaryguestbookusers->insertOne([
                        'name' => $data["name"],
                        'email' => $data["email"],
                        'password' => $hashedPassword,
                        'token' => $mailResult["token"],
                    ]);
                }
                else
                {
                    $temporaryguestbookusers->updateOne(
                        ['email' => $data["email"]],
                        ['$set' => ['name' => $data["name"], 'password' => $hashedPassword, 
                        'token' => $mailResult["token"],]]
                    );
                }
            }
            else
            {
                $data["isFormValid"] = false;
                $data["problemDescription"] .= $listOfProblems[0][0]."\n";
            }
        }
        return $data;
    }
}