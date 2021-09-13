<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;
use Task\GetOnBoard\Entity\Post;
use Task\GetOnBoard\Entity\Comment;

class QuestionController
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
     * @param int $title
     * @param string $text
     * @return Post|null
     */
    public function createAction(int $userId, int $communityId, string $title, string $text): Post
    {
        $community = CommunityRepository::getCommunity($communityId);
        $post = $community->addPost($title, $text, 'question');

        $user = CommunityRepository::getUser($userId);
        $user->addPost($post);

        return $post;
    }

    /**
     * @param int $userId
     * @param int $communityId
     * @param int $questionId
     * @param string $title
     * @param string $text
     * @return Post|null
     */
    public function updateAction(int $userId, int $communityId, int $questionId, string $title, string $text): ?Post
    {
        $user = CommunityRepository::getUser($userId);

        //set default value for $post variable
        $post = null;

        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $questionId) {
                $community = CommunityRepository::getCommunity($communityId);
                $post = $community->updatePost($questionId, $title, $text);
            }
        }

        return $post;
    }

    /**
     * @param int $userId
     * @param int $communityId
     * @param int $questionId
     */
    public function deleteAction(int $userId, int $communityId, int $questionId): void
    {
        $user = CommunityRepository::getUser($userId);
        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $questionId) {
                $community = CommunityRepository::getCommunity($communityId);
                $community->deletePost($questionId);
            }
        }
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $questionId
     * @param $text
     * @return Comment|null
     */
    public function commentAction($userId, $communityId, $questionId, $text): ?Comment
    {
        $community = CommunityRepository::getCommunity($communityId);
        $comment = $community->addComment($questionId, $text);

        $user = CommunityRepository::getUser($userId);
        $user->addComment($comment);

        return $comment;
    }
}
