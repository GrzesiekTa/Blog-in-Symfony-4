<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Tag;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Post::class);
    }

    public function findPosts() {
        $posts = $this->getEntityManager()->createQueryBuilder('p');
        $posts
                ->select('partial p.{id, title, slug,shortcontent,publishedAt}', 't')
                ->from('App:Post', 'p')
                ->leftJoin('p.tags', 't')
                ->orderBy('p.id', 'DESC');

        return $posts;
    }

    /**
     * 
     * 
     * @param type $tag
     * 
     * @return type
     */
    public function findPostsByTag(Tag $tag) {
        //dump($tag);
        $posts = $this->getEntityManager()->createQueryBuilder('p');
        $posts
                ->select('partial p.{id, title, slug,shortcontent,publishedAt}', 't')
                ->from('App:Post', 'p')
                ->leftJoin('p.tags', 't')
                ->where('t.id = :subCompanyId')
                ->setParameter("subCompanyId", $tag)
                ->orderBy('p.id', 'DESC');

        return $posts;
    }

    //    public function findPostsByTag($tag) {
//        $query = $this->getEntityManager()
//                        ->createQuery('
//                SELECT partial p.{id, title, slug,shortcontent,publishedAt}, t
//                FROM App:Post p
//                left JOIN p.tags t
//				where t.id=:tag
//                ORDER BY p.publishedAt DESC
//         ')->setParameter('tag', $tag);
//
//        return $query;
//    }
}
