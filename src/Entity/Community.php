<?php

namespace Task\GetOnBoard\Entity;

use Task\GetOnBoard\Constants\PostTypes;
use Task\GetOnBoard\Entity\Posts\IPost;
use Task\GetOnBoard\Entity\Posts\Post;
use Task\GetOnBoard\Factories\Posts\IPostFactory;

class Community
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $posts = [];

    /**
     * @var IPostFactory
     */
    protected $postFactory;

    public function __construct(IPostFactory $postFactory)
    {
        $this->id = uniqid();
        $this->postFactory = $postFactory;
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
     * @param string $title
     * @param string $text
     * @param string $type
     * @param Post|null $parent
     * @return IPost
     */
    public function addPost(string $title, string $text, string $type, ?Post $parent = null): IPost
    {
        $post = $this->postFactory->make($type);
        $post->create($title, $text, $type, $parent);

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
