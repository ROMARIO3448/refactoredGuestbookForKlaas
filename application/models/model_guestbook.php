<?php
class Model_Guestbook extends Model
{
    private function getLatestReviewsWithLimit($limit=5)
    {
        $reviews = [];
        $filter  = [];
        $options = ['sort' => ['timestamp' => -1], 'limit' => $limit];
        $guestbookusers = Model::getGuestbookUsersCollection();
        $findResults = $guestbookusers->find($filter, $options);
        
        foreach ($findResults as $innerDocument) 
        {
            $name = "";
            $review = "";
            foreach ($innerDocument as $key => $value) 
            {
                if($key=="name")
                {
                    $name = $value;
                }
                if($key=="review")
                {
                    $review = $value;
                }
            }
            if($name&&$review)
            {
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
        $limit = $options["limit"];
        if($_id)
        {
            $findOneById = Model::findOneGuestbookUserById($_id);
            if($findOneById)
            {
                $data["isSuchUserExists"] = true;
            }
            $data["reviews"] = $this->getLatestReviewsWithLimit($limit);
        }
        else
        {
            $data["reviews"] = $this->getLatestReviewsWithLimit($limit);
        }
        
        return $data;
    }
}