<?php
class Model_Write_Review extends Model
{
    public function isIdValid($_id): string
    {
        $findOneById = Model::findOneGuestbookUserById($_id);
        if($findOneById)
        {
            foreach ($findOneById as $key => $value) {
                if($key=="name")
                {
                    //если имя найдено, то вернёт имя. Если нет, то всё равно вернёт пустую строку
                    //вопрос. считать ли валидным айди если документ по айди найден, но в доке нет имени
                    return $value;
                }
            }
        }
        //будет возвращать юсер нэйм если есть, а если его нет пустую строку
        return "";
    }
	public function get_data($options)
	{
        $data = [];
        $data["problemDescription"] = "";
        $listOfProblems = array("Your review is not valid", "Review update failed");
        $_id = $options["_id"];

        //Рик говорил, что и strip_tags и htmlentities стоит оставить. 
        //Вроде бы. Стоит переслушать сообщение
        $userReview = $options["review"];
        $userReview = strip_tags($userReview);
        $userReview = htmlentities($userReview);

        if($userReview == "")
        {
            //если после санитарных процедур Пользовательский Обзор остался пустым
            //значит пользователь пытался в обзор повставлять одни нелегальные символы
            $data["problemDescription"] = $listOfProblems[0];
        }
        else
        {
            $updateOneResult = Model::updateOneGuestbookUserReview($_id, $userReview);
            if(!$updateOneResult)
            {
                //если обновление провалилось, значит в описание проблемы добавляем эту информацию
                $data["problemDescription"] = $listOfProblems[1];
            }
        }
        return $data;
    }
}