<?php

namespace Task\GetOnBoard\Entity;

class Post
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $type;

    /**
     * @var Post
     */
    public $parent;

    /**
     * @var array
     */
    public $comments;

    /**
     * @var bool
     */
    public $deleted;

    /**
     * @var bool
     */
    public $commentsAllowed = true;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->id =  uniqid();
        $this->comments = [];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Post
     */
    public function getParent(): Post
    {
        return $this->parent;
    }

    /**
     * @param Post $parent
     */
    public function setParent(Post $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @param string $text
     * @return Comment
     */
    public function addComment(string $text): Comment
    {
        $comment = new Comment();
        $comment->setText($text);

        $this->comments[] = $comment;

        return $comment;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @return bool
     */
    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return bool
     */
    public function isCommentsAllowed(): bool
    {
        return $this->commentsAllowed;
    }

    /**
     * @param bool $commentsAllowed
     */
    public function setCommentsAllowed(bool $commentsAllowed)
    {
        if (!$commentsAllowed) {
            $this->comments = [];
        }

        $this->commentsAllowed = $commentsAllowed;
    }
}
