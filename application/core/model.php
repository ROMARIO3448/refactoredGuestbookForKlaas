<?php
class Model
{
    protected static $client;

    protected static function getClient()
    {
        if (self::$client === null) {
            self::$client = new MongoDB\Client;
        }
        return self::$client;
    }

    protected static function findOneGuestbookUserById($_id)
    {
        return self::getClient()->guestbook->guestbookusers->findOne(['_id' => new MongoDB\BSON\ObjectID($_id)]);
    }

    protected static function getGuestbookUsersCollection()
    {
        return self::getClient()->guestbook->guestbookusers;
    }

    protected static function getTemporaryGuestbookUsersCollection()
    {
        return self::getClient()->guestbook->temporaryguestbookusers;
    }

    protected static function updateOneGuestbookUserReview($userId, $userReview)
    {
        return self::getClient()->guestbook->guestbookusers->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($userId)],
            ['$set' => ['review' => $userReview]]
        );
    }

    public function get_data($options)
    {
    }
}
