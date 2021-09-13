<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Constants\PostTypes;

class ArticleController extends PostController implements IPostController
{
    /**
     * @var string
     */
    protected $type = PostTypes::ARTICLE;
}
