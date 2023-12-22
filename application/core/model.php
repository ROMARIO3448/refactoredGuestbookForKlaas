<?php
class Model
{
	static protected function findOneGuestbookUserById($_id)
	{
        $client = new MongoDB\Client;
		return $client->guestbook->guestbookusers->findOne(['_id' => new MongoDB\BSON\ObjectID($_id)]);
	}
	static protected function getGuestbookUsersCollection()
	{
        $client = new MongoDB\Client;
        return $client->guestbook->guestbookusers;
	}
	static protected function getTemporaryGuestbookUsersCollection()
	{
    	$client = new MongoDB\Client;
    	return $client->guestbook->temporaryguestbookusers;
	}
	static protected function updateOneGuestbookUserReview($userId, $userReviev)
	{
        $client = new MongoDB\Client;
        return $client->guestbook->guestbookusers->updateOne(
			['_id' => new MongoDB\BSON\ObjectID($userId)],
			['$set' => ['review' => $userReviev,]]
		);
	}
	public function get_data($options)
	{
	}
}