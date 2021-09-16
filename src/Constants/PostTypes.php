<?php

namespace Task\GetOnBoard\Constants;

/**
 * this class is keeping hard coded post types in one place to avoid typo mistakes or duplicating it in code
 */
class PostTypes
{
    const ARTICLE = 'article';
    const CONVERSATION = 'conversation';
    const QUESTION = 'question';

    /**
     * list supported post types
     *
     * @return array
     */
    public static function types(): array
    {
        return (new \ReflectionClass(__CLASS__))
            ->getConstants();
    }
}
