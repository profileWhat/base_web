<?php

class RadioSerializer implements Serializer
{
    private string $radio;

    public function __construct(string $radio)
    {
        $this->radio = $radio;
    }

    public function serialize(): int
    {
        if ($this->radio == 'Excellent') return 1;
        if ($this->radio == 'Good') return 2;
        if ($this->radio == 'Beautiful') return 3;
        return 0;
    }
}