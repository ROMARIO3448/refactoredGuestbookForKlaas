<?php
class Model_Confirm_Email extends Model
{
	public function get_data($options): array
	{
        $data = [];
        $email = $options["email"];
        $token = $options["token"];
        $data["isVerificationPassed"] = false;
        $temporaryguestbookusers = Model::getTemporaryGuestbookUsersCollection();
        $guestbookusers = Model::getGuestbookUsersCollection();

        $findOneResult = $guestbookusers->findOne(['email' => $email]);
        if($findOneResult)
        {
            return $data;
        }

        $findOneResult = $temporaryguestbookusers->findOne(['email' => $email]);
        if(!$findOneResult)
        {
            return $data;
        }
        else
        {
            $guestbookuserwithouttoken = [];
            $data["idForSession"] = "";
            foreach ($findOneResult as $key => $value) {
                if($key=="_id")
                {
                    $data["idForSession"] = $value;
                }
                if($key=="token")
                {
                    if($value==$token)
                    {
                        $data["isVerificationPassed"] = true;
                    }
                }
                else
                {
                    $guestbookuserwithouttoken[$key]=$value;
                }
            }
            if($data["isVerificationPassed"] == false)
            {
                return $data;
            }
            else
            {
                $guestbookusers->insertOne($guestbookuserwithouttoken);
                $temporaryguestbookusers->deleteOne(['email' => $email]);
                return $data;
            }
        }
    }
}
