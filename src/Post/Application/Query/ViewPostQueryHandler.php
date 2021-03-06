<?php

namespace App\Post\Application\Query;

use App\Kernel\Application\Query\Query;
use App\Kernel\Application\Query\QueryHandler;
use App\Post\Domain\Model\Post;
use App\Post\Domain\Model\PostDoesNotExistException;
use App\Post\Domain\Model\PostId;
use App\Post\Domain\Model\PostRepository;

class ViewPostQueryHandler implements QueryHandler
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(Query $request = null) : Post
    {
        $idPost = $request->idPost();

        $post = $this->postRepository->ofId($idPost);

        if (!$post) {
            throw new PostDoesNotExistException();
        }

        /*if (!$post->id()->equals(new PostId($idPost))) {
            throw new \InvalidArgumentException('Post is not authorized to view this wish');
        }*/

        return $post;
    }
}
