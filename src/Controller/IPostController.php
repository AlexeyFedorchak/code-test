<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Entity\Comment;
use Task\GetOnBoard\Entity\Community;
use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Entity\User;

interface IPostController
{
    public function listAction(Community $community): array;
    public function createAction(User $user, Community $community, string $title, string $text): ?Post;
    public function updateAction(User $user, Community $community, Post $post, string $title, string $text): ?Post;
    public function deleteAction(User $user, Community $community, Post $post): void;
    public function commentAction(User $user, Community $community, Post $post, string $text): ?Comment;
    public function disableCommentsAction(Community $community, Post $post): void;
}
