<?php

namespace Task\GetOnBoard\Factories\Posts;

use Task\GetOnBoard\Constants\PostTypes;
use Task\GetOnBoard\Entity\Posts\IPost;

/**
 * Simple factory for auto-generating instance of Posts Entities
 */
class PostFactory implements IPostFactory
{
    /**
     * @param string $type
     * @return IPost
     * @throws \Exception
     */
    public function make(string $type): IPost
    {
        if (!in_array($type, PostTypes::types())) {
            throw new \Exception('Incorrect type is passed');
        }

        $type = ucfirst(strtolower(trim($type)));

        $postClassName = '\Task\GetOnBoard\Entity\Posts\\' . $type . '.php';
        return new $postClassName;
    }
}
