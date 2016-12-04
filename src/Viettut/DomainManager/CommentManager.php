<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:07 PM
 */

namespace Viettut\DomainManager;


use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CommentInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\TutorialInterface;
use Viettut\Model\ModelInterface;
use Viettut\Repository\Core\ChapterRepositoryInterface;
use Viettut\Repository\Core\CommentRepositoryInterface;

class CommentManager implements CommentManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    protected $repository;

    public function __construct(EntityManagerInterface $em, CommentRepositoryInterface $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * Should take an object instance or string class name
     * Should return true if the supplied entity object or class is supported by this manager
     *
     * @param ModelInterface|string $entity
     * @return bool
     */
    public function supportsEntity($entity)
    {
        return is_subclass_of($entity, CommentInterface::class);
    }

    /**
     * @param ModelInterface $entity
     * @return void
     */
    public function save(ModelInterface $entity)
    {
        if (!$entity instanceof CommentInterface) {
            throw new InvalidArgumentException('expect an CommentInterface object');
        }

        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * @param ModelInterface $entity
     * @return void
     */
    public function delete(ModelInterface $entity)
    {
        if (!$entity instanceof CommentInterface) {
            throw new InvalidArgumentException('expect an CommentInterface object');
        }

        $this->em->remove($entity);
        $this->em->flush();
    }

    /**
     * @return ModelInterface
     */
    public function createNew()
    {
        $entity = new ReflectionClass($this->repository->getClassName());
        return $entity->newInstance();
    }

    /**
     * @param int $id
     * @return ModelInterface|null
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return ModelInterface[]
     */
    public function all($limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria = [], $orderBy = null, $limit, $offset);
    }

    /**
     * @param CourseInterface $course
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByCourse(CourseInterface $course, $limit = null, $offset = null)
    {
        return $this->repository->getByCourse($course, $limit, $offset);
    }

    /**
     * @param ChapterInterface $chapter
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByChapter(ChapterInterface $chapter, $limit = null, $offset = null)
    {
        return $this->repository->getByChapter($chapter, $limit, $offset);
    }

    /**
     * @param TutorialInterface $tutorial
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByTutorial(TutorialInterface $tutorial, $limit = null, $offset = null)
    {
        return $this->repository->getByTutorial($tutorial, $limit, $offset);
    }
}