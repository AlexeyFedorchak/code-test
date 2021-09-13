<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Entity\Community;
use Task\GetOnBoard\Entity\User;
use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Entity\Comment;

class ConversationController
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
        $post = $community->addPost($title, $text, 'conversation');
        $user->addPost($post);

        return $post;
    }

    /**
     * @param User $user
     * @param Community $community
     * @param Post $post
     * @param string $title
     * @param string $text
     * @return Post|null
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
     * @param User $user
     * @param Community $community
     * @param Post $post
     */
    public function deleteAction(User $user, Community $community, Post $post): void
    {
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->getId() == $post->getId()) {
                $community->deletePost($post);
                break;
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
}
