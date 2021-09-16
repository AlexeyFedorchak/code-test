<?php

namespace Task\GetOnBoard\Entity\Posts;

class Question extends Post implements IPost
{
    /**
     * @param string|null $title
     * @param string $text
     * @param string $type
     * @param Post|null $parent
     * @return Post
     */
    public function create(?string $title, string $text, string $type, ?Post $parent = null): Post
    {
        $this->setTitle($title);
        $this->setText($text);
        $this->setType($type);

        if ($parent) {
            $this->setParent($parent);
        }

        return $this;
    }
}