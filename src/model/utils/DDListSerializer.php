<?php

class DDListSerializer implements Serializer
{
    private string $ddList;

    public function __construct(string $ddList)
    {
        $this->ddList = $ddList;
    }

    public function serialize(): int
    {
        if ($this->ddList == 'Unforgettable') return 1;
        if ($this->ddList == 'Amazing') return 2;
        if ($this->ddList == 'Unbelievably') return 3;
        return 0;
    }
}