<?php


class AssociativeImportVisitor implements Visitor
{
    private array $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function visitUser(User $user)
    {
        $user->setId($this->array['id']);
        $user->setEmail($this->array['email']);
        $user->setPassword($this->array['password']);
    }

    public function visitUserOpinion(UserOpinion $userOpinion)
    {
        $userOpinion->setId($this->array['id']);
        $userOpinion->setUserId($this->array['id_user']);
        $userOpinion->setText($this->array['text']);
        $userOpinion->setAreaText($this->array['area_text']);
        $userOpinion->setDdList($this->array['dd_list']);
        $userOpinion->setRadio($this->array['radio']);
        $userOpinion->setCheckbox($this->array['checkbox']);
    }
}