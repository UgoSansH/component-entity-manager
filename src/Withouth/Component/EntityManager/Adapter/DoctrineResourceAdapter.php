<?php

namespace Ugosansh\Component\EntityManager\Adapter;

use Doctrine\ORM\EntityManager;
use Ugosansh\Component\EntityManager\ResourceAdapterInterface;
use Ugosansh\Component\EntityManager\EntityInterface;

/**
 * Doctrine Manager adapter
 */
class DoctrineResourceAdapter implements ResourceAdapterInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Construct
     *
     * @param EntityManager $entityManager
     * @param string        $entityClass
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritDoc}
     */
    public function find($entityClass, $id)
    {
        return $this->getRepository($entityClass)->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findBy($entityClass, array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getRepository($entityClass)->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy($entityClass, array $criteria)
    {
        return $this->getRepository($entityClass)->findOneBy($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function save(EntityInterface $entity, $flush = true)
    {
        $this->persist($entity);

        if ($flush) {
            $this->flush();
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function remove(EntityInterface $entity, $flush = true)
    {
        $this->entityManager->remove($entity);

        if ($flush === true) {
            $this->entityManager->flush();
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function persist(EntityInterface $entity)
    {
        $this->entityManager->persist($entity);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function flush()
    {
        $this->entityManager->flush();

        return true;
    }

    /**
     * getRepository
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($entityClass)
    {
        return $this->entityManager->getRepository($entityClass);
    }

}
