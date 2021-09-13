<?php

namespace Task\GetOnBoard\Entity;

class Community
{
    public $id;
    public $name;
    public $posts = [];

    public function __construct()
    {
        $this->id =  uniqid();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param $title
     * @param $text
     * @param $type
     * @param null $parent
     * @return Post|null
     */
    public function addPost($title, $text, $type, $parent = null)
    {
        $post = null;

        if ($type == 'article') {
            $post = new Post();
            $post->setTitle($title);
            $post->setText($text);
            $post->setType($type);
        }

        if ($type == 'conversation') {
            $post = new Post();
            $post->setText($text);
            $post->setType($type);

            if ($parent) {
                $post->setParent($parent);
            }
        }

        if ($type == 'question') {
            $post = new Post();
            $post->setTitle($title);
            $post->setText($text);
            $post->setType($type);

            if ($parent) {
                $post->setParent($parent);
            }
        }

        $this->posts[] = $post;

        return $post;
    }

    /**
     * @param Post $post
     * @param string $title
     * @param string $text
     * @return Post|null
     */
    public function updatePost(Post $post, string $title, string $text): Post
    {
        $post->setTitle($title);
        $post->setText($text);

        $this->posts[] = $post;

        return $post;
    }

    /**
     * @param Post $parentPost
     * @param string $text
     * @return Comment|null
     */
    public function addComment(Post $parentPost, string $text): ?Comment
    {
        foreach ($this->posts as $post) {
            if ($post->getId() == $parentPost->getId()) {
                return $post->addComment($text);
            }
        }

        return null;
    }

    /**
     * @param Post $deletingPost
     */
    public function deletePost(Post $deletingPost)
    {
        foreach ($this->posts as $post) {
            if ($post->getId() == $deletingPost->getId()) {
                $post->setDeleted(true);
                break;
            }
        }
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        $posts = [];

        foreach ($this->posts as $post){
            if (!$post->getDeleted()) {
                $posts[] = $post;
            }
        }

        return $posts;
    }

    /**
     * @param Post $article
     */
    public function disableCommentsForArticle(Post $article): void
    {
        foreach ($this->posts as $post) {
            if ($post->getId() == $article->getId()) {
                $post->setCommentsAllowed(false);
                break;
            }
        }
    }
}
