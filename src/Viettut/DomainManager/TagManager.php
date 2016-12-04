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
use Viettut\Model\Core\TagInterface;
use Viettut\Model\ModelInterface;
use Viettut\Repository\Core\TagRepositoryInterface;

class TagManager implements TagManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;
    protected $repository;

    public function __construct(EntityManagerInterface $em, TagRepositoryInterface $repository)
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
        return is_subclass_of($entity, TagInterface::class);
    }

    /**
     * @param ModelInterface $entity
     * @return void
     */
    public function save(ModelInterface $entity)
    {
        if (!$entity instanceof TagInterface) {
            throw new InvalidArgumentException('expect an TagInterface object');
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
        if (!$entity instanceof TagInterface) {
            throw new InvalidArgumentException('expect an TagInterface object');
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
}