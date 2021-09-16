<?php

namespace Task\GetOnBoard\Factories\Posts;

use Task\GetOnBoard\Entity\Posts\IPost;

/**
 * General interface for Post Entities factories
 */
interface IPostFactory
{
    public function make(string $type): IPost;
}
