<?php

use JetBrains\PhpStorm\Pure;

class UserOpinionCrudRepository extends CrudRepository
{
    #[Pure] public function __construct(PDOCommunicator $PDOCommunicator)
    {
        parent::__construct($PDOCommunicator, UserOpinion::withEmpty());
    }

    public function save(UserOpinion $userOpinion): bool
    {
        $connection = $this->PDOCommunicator->getConnection();
        $userId = $userOpinion->getUserId();
        $text = $userOpinion->getText();
        $areaText = $userOpinion->getAreaText();
        $ddList = $userOpinion->getDdList();
        $radio = $userOpinion->getRadio();
        $checkbox = $userOpinion->getCheckbox();
        $query = $connection->prepare("INSERT INTO user_opinions(id_user, text, area_text, dd_list, radio, checkbox) VALUES (:userId, :text, :areaText, :ddList, :radio, :checkbox)");
        $query->bindParam("userId", $userId);
        $query->bindParam("text", $text);
        $query->bindParam("areaText", $areaText);
        $query->bindParam("ddList", $ddList);
        $query->bindParam("radio", $radio);
        $query->bindParam("checkbox", $checkbox);
        return $query->execute();
    }

}