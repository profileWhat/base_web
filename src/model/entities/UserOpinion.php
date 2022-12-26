<?php

use JetBrains\PhpStorm\Pure;

class UserOpinion implements DBEntity
{
    private int $id;
    private int $userId;
    private string $text;
    private string $areaText;
    private int $ddList;
    private int $radio;
    private string $checkbox;


    public function __construct(int $userId, string $text, string $areaText, int $ddList, int $radio, string $checkbox)
    {
        $this->userId = $userId;
        $this->text = $text;
        $this->areaText = $areaText;
        $this->ddList = $ddList;
        $this->radio = $radio;
        $this->checkbox = $checkbox;
    }

    public function accept(Visitor $visitor)
    {
        return $visitor->visitUserOpinion($this);
    }

    /**
     * @return UserOpinion
     */
    #[Pure] public static function withEmpty(): UserOpinion
    {
        return new self(0, '', '', 0, 0, 0);
    }

    public function getTableName(): string
    {
        return 'user_opinion';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAreaText(): string
    {
        return $this->areaText;
    }

    /**
     * @return string
     */
    public function getCheckbox(): string
    {
        return $this->checkbox;
    }

    /**
     * @return int
     */
    public function getDdList(): int
    {
        return $this->ddList;
    }

    /**
     * @return int
     */
    public function getRadio(): int
    {
        return $this->radio;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $areaText
     */
    public function setAreaText(string $areaText): void
    {
        $this->areaText = $areaText;
    }

    /**
     * @param int $checkbox
     */
    public function setCheckbox(int $checkbox): void
    {
        $this->checkbox = $checkbox;
    }

    /**
     * @param int $ddList
     */
    public function setDdList(int $ddList): void
    {
        $this->ddList = $ddList;
    }

    /**
     * @param int $radio
     */
    public function setRadio(int $radio): void
    {
        $this->radio = $radio;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

}