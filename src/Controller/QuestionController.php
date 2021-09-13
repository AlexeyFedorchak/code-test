<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Constants\PostTypes;

class QuestionController extends PostController implements IPostController
{
    /**
     * @var string
     */
    protected $type = PostTypes::QUESTION;
}
