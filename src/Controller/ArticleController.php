<?php

namespace Task\GetOnBoard\Controller;

use Task\GetOnBoard\Repository\CommunityRepository;
use \Task\GetOnBoard\Entity\Post;

class ArticleController
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
     * I assume that userId and communityId are integers, since usually by id we understand auto-incremented primary ids from database,
     * but of course I'm familiar with a case when id can be a string, like some kind of uuid.
     *
     * @param int $userId
     * @param int $communityId
     * @param string $title
     * @param string $text
     * @return Post|null
     */
    public function createAction(int $userId, int $communityId, string $title, string $text): Post
    {
        $community = CommunityRepository::getCommunity($communityId);
        $post = $community->addPost($title, $text, 'article');

        $user = CommunityRepository::getUser($userId);
        $user->addPost($post);

        return $post;
    }

    /**
     * @param int $userId
     * @param int $communityId
     * @param int $articleId
     * @param string $title
     * @param string $text
     * @return mixed|null
     */
    public function updateAction(int $userId, int $communityId, int $articleId, string $title, string $text): ?Post
    {
        $user = CommunityRepository::getUser($userId);

        //post variable may not exist of "if" statement won't have true at least once
        $post = null;

        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $articleId) {
                $community = CommunityRepository::getCommunity($communityId);
                $post = $community->updatePost($articleId, $title, $text);
            }
        }

        return $post;
    }

    /**
     * I've removed return null, since no need to return it, it's better to return just void.
     * function by default anyway will have returned value "null"
     *
     * @param $userId
     * @param $communityId
     * @param $articleId
     */
    public function deleteAction($userId, $communityId, $articleId): void
    {
        $user = CommunityRepository::getUser($userId);

        foreach ($user->getPosts() as $userPost) {
            if ($userPost->id == $articleId) {
                $community = CommunityRepository::getCommunity($communityId);
                $community->deletePost($articleId);
            }
        }
    }

    /**
     * @param $userId
     * @param $communityId
     * @param $articleId
     * @param $text
     * @return null
     */
    public function commentAction($userId, $communityId, $articleId, $text)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $comment = $community->addComment($articleId, $text);

        $user = CommunityRepository::getUser($userId);
        $user->addComment($comment);

        return $comment;
    }

    /**
     * @param $communityId
     * @param $articleId
     *
     * PATCH
     */
    public function disableCommentsAction($communityId, $articleId)
    {
        $community = CommunityRepository::getCommunity($communityId);
        $community->disableCommentsForArticle($articleId);
    }
}
