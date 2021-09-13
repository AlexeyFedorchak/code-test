<?php

namespace Task\GetOnBoard\Repository;

use Task\GetOnBoard\Entity\Community;
use Task\GetOnBoard\Entity\User;

class CommunityRepository
{
    /**
     * @var array
     */
    private static $communities = [];

    /**
     * @var array
     */
    private static $users = [];

    /**
     * @param $id
     * @return Community|null
     */
    public static function getCommunity($id): ?Community
    {
        foreach (self::$communities as $community) {
            if ($community->id == $id) {
                return $community;
            }
        }

        return null;
    }

    /**
     * @param Community $community
     */
    public static function addCommunity(Community $community): void
    {
        self::$communities[] = $community;
    }

    /**
     * @param $id
     * @return User|null
     */
    public static function getUser($id): ?User
    {
        foreach (self::$users as $user) {
            if ($user->id == $id) {
                return $user;
            }
        }

        return null;
    }

    /**
     * @param User $user
     */
    public static function addUser(User $user): void
    {
        self::$users[] = $user;
    }
}
