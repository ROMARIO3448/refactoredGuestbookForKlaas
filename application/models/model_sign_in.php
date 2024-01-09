<?php

class Model_Sign_In extends Model
{
    private function sanitizeAndVerify($email, $password): array
    {
        $isSignInPassed = true;
        $idForSession = "";
        $guestbookusers = Model::getGuestbookUsersCollection();

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!$email)
        {
            $isSignInPassed = false;
        }
        else
        {
            $findOneResult = $guestbookusers->findOne(['email' => $email]);
            if(!$findOneResult)
            {
                $isSignInPassed = false;
            }
        }
        
        $passwordRegex = '/^.{6,}$/';
        $password = strip_tags($password);
        $password = htmlentities($password);
        if(!preg_match($passwordRegex, $password) || $password == "")
        {
            $isSignInPassed = false;
        }
        else
        {
            if($isSignInPassed)
            {
                $passwordFromDb = "";
                foreach ($findOneResult as $key => $value) {
                    if($key=="_id")
                    {
                        $idForSession = $value;
                    }
                    if($key=="password")
                    {
                        $passwordFromDb = $value;
                    }
                }
                if($passwordFromDb == "" || $idForSession == "")
                {
                    $isSignInPassed = false;
                }
                else
                {
                    if(!password_verify($password, $passwordFromDb))
                    {
                        $isSignInPassed = false;
                    }
                }
            }
        }
        return array("idForSession" => $idForSession, "isSignInPassed" => $isSignInPassed);
    }
    public function get_data($options)
	{
        $data = [];
        $email = $options["email"];
        $password = $options["password"];

        $data = $this->sanitizeAndVerify($email, $password);
        return $data;
    }
}
