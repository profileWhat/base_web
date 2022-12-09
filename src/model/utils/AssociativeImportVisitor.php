<?php

use JetBrains\PhpStorm\ArrayShape;

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
}