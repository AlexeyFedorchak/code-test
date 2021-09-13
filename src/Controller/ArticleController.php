<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Entity\Comment;
use Task\GetOnBoard\Entity\Community;
use Task\GetOnBoard\Entity\User;
use Task\GetOnBoard\Repository\CommunityRepository;
use \Task\GetOnBoard\Entity\Post;

class ArticleController
{
    /**
     * @param Community $community
     * @return array
     */
    public function listAction(Community $community): array
    {
        return $community->getPosts();
    }

    /**
     * @param User $user
     * @param Community $community
     * @param string $title
     * @param string $text
     * @return Post|null
     */
    public function createAction(User $user, Community $community, string $title, string $text): Post
    {
        $post = $community->addPost($title, $text, 'article');
        $user->addPost($post);

        return $post;
    }

    /**
     * @param User $user
     * @param Community $community
     * @param Post $post
     * @param string $title
     * @param string $text
     * @return mixed|null
     */
    public function updateAction(User $user, Community $community, Post $post, string $title, string $text): ?Post
    {
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->getId() == $post->getId()) {
                return $community->updatePost($post, $title, $text);
            }
        }

        return null;
    }

    /**
     * I've removed return null, since no need to return it, it's better to return just void.
     * function by default anyway will have returned value "null"
     *
     * @param User $user
     * @param Community $community
     * @param Post $post
     */
    public function deleteAction(User $user, Community $community, Post $post): void
    {
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->getId() == $post->getId()) {
                $community->deletePost($post);
            }
        }
    }

    /**
     * @param User $user
     * @param Community $community
     * @param Post $post
     * @param string $text
     * @return Comment|null
     */
    public function commentAction(User $user, Community $community, Post $post, string $text): ?Comment
    {
        $comment = $community->addComment($post, $text);
        $user->addComment($comment);

        return $comment;
    }

    /**
     * @param Community $community
     * @param Post $post
     */
    public function disableCommentsAction(Community $community, Post $post): void
    {
        $community->disableCommentsForArticle($post);
    }
}
