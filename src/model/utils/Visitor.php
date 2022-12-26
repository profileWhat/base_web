<?php

interface Visitor
{
    public function visitUser(User $user);

    public function visitUserOpinion(UserOpinion $userOpinion);
}