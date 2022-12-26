<?php

class CheckboxSerializer
{
    private array $checkbox;

    public function __construct(array $checkbox)
    {
        $this->checkbox = $checkbox;
    }

    public function serialize(): string
    {
        $result = '';
        if (in_array('Excellent', $this->checkbox)) $result .= '1';
        else $result .= '0';
        if (in_array('Good', $this->checkbox)) $result .= '1';
        else $result .= '0';
        if (in_array('Beautiful', $this->checkbox)) $result .= '1';
        else $result .= '0';
        return $result;
    }
}