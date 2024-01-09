<?php
class Model_Guestbook extends Model
{
    public function getLatestReviewsWithLimit($limit = 10)
    {
        $reviews = [];
        $filter = ['review' => ['$exists' => true]];
        $options = ['sort' => ['timestamp' => -1], 'limit' => $limit];
        $guestbookusers = Model::getGuestbookUsersCollection();
        $findResults = $guestbookusers->find($filter, $options);

        foreach ($findResults as $innerDocument) {
            $name = $innerDocument['name'] ?? '';
            $review = $innerDocument['review'] ?? '';

            if ($name && $review) {
                $reviews[$name] = $review;
            }
        }
        return $reviews;
    }

	public function get_data($options)
	{
        $data = [];
        $data["isSuchUserExists"]=false;
        $_id = "";
        if(isset($options["_id"]))
        {
            $_id = $options["_id"];
        }
        if($_id)
        {
            $findOneById = Model::findOneGuestbookUserById($_id);
            if($findOneById)
            {
                $data["isSuchUserExists"] = true;
            }
        }
        
        return $data;
    }
}