<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;
use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Entity\Comment;

class ConversationController
{
    /**
     * @param int $communityId
     * @return array
     */
    public function listAction(int $communityId): array
    {
        $community = CommunityRepository::getCommunity($communityId);

        return $community->getPosts();
    }

    /**
     * @param int $userId
     * @param int $communityId
     * @param string $title
     * @param string $text
     * @return Post|null
     */
    public function createAction(int $userId, int $communityId, string $title, string $text): Post
    {
        $community = CommunityRepository::getCommunity($communityId);
        $post = $community->addPost($title, $text, 'conversation');

        $user = CommunityRepository::getUser($userId);
        $user->addPost($post);

        return $post;
    }

    /**
     * @param int $userId
     * @param int $communityId
     * @param int $conversationId
     * @param string $title
     * @param string $text
     * @return Post|null
     */
    public function updateAction(int $userId, int $communityId, int $conversationId, string $title, string $text): ?Post
    {
        $user = CommunityRepository::getUser($userId);

        //default value for post
        $post = null;

        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $conversationId) {
                $community = CommunityRepository::getCommunity($communityId);
                $post = $community->updatePost($conversationId, $title, $text);
            }
        }

        return $post;
    }

    /**
     * the function by default anyway returns "null", so no need to specify it in return statement
     *
     * @param int $userId
     * @param int $communityId
     * @param int $conversationId
     */
    public function deleteAction(int $userId, int $communityId, int $conversationId): void
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $conversationId) {
                $community = CommunityRepository::getCommunity($communityId);
                $community->deletePost($conversationId);
            }
        }
    }

    /**
     * @param int $userId
     * @param int $communityId
     * @param int $conversationId
     * @param string $text
     * @return Comment|null
     */
    public function commentAction(int $userId, int $communityId, int $conversationId, string $text): ?Comment
    {
        $community = CommunityRepository::getCommunity($communityId);
        $comment = $community->addComment($conversationId, $text);

        $user = CommunityRepository::getUser($userId);
        $user->addComment($comment);

        return $comment;
    }
}
