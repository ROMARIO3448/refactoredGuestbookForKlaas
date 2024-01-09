<?php
class Model_Write_Review extends Model
{
    public function getNameById($_id): string
    {
        $user = Model::findOneGuestbookUserById($_id);

        return $user['name'] ?? '';
    }

	public function get_data($options)
	{
        $data = [];
        $data["problemDescription"] = "";
        $listOfProblems = array("Your review is not valid", "Review update failed");
        $_id = $options["_id"];

        $userReview = $options["review"];
        $userReview = strip_tags($userReview);
        $userReview = htmlentities($userReview);

        if(empty($userReview))
        {
            $data["problemDescription"] = $listOfProblems[0];
        }
        else
        {
            $updateOneResult = Model::updateOneGuestbookUserReview($_id, $userReview);
            if(!$updateOneResult)
            {
                $data["problemDescription"] = $listOfProblems[1];
            }
        }
        return $data;
    }
}