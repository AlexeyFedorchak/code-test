<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Constants\PostTypes;

class ConversationController extends PostController implements IPostController
{
    /**
     * @var string
     */
    protected $type = PostTypes::CONVERSATION;
}
