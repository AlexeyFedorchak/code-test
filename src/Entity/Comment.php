<?php

namespace Task\GetOnBoard\Entity;

class Comment
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $text;

    public function __construct()
    {
        $this->id = uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
