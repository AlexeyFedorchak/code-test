<?php

namespace Task\GetOnBoard\Entity\Posts;

/**
 * The interface for keeping general methods of Posts Entities.
 * @TODO Add here all another specific to Posts Entities methods.
 */
interface IPost
{
    /**
     * method which keeps specific logic of creating new Post Entities
     *
     * @param string|null $title
     * @param string $text
     * @param string $type
     * @param Post|null $parent
     * @return Post
     */
    public function create(?string $title, string $text, string $type, ?Post $parent = null): Post;
}
