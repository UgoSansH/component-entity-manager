<?php

namespace Withouth\Component\EntityManager;

/**
 * Base entity manager
 */
class Manager implements ManagerInterface
{
    /**
     * @var ResourceAdapterInterface
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * Construct
     *
     * @param ResourceAdapterInterface $adapter
     * @param string                   $entityClass
     */
    public function __construct(ResourceAdapterInterface $adapter, $entityClass)
    {
        $this->adapter     = $adapter;
        $this->entityClass = $entityClass;
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * {@inheritDoc}
     */
    public function createEntity()
    {
        $reflection = new \ReflectionClass($this->entityClass);

        if (!$reflection->isInstantiable()) {
            throw new Exception(sprintf('Entity "%s" is not instantiable', $className));
        }

        $entity = $reflection->newInstance();

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        return $this->adapter->find($this->entityClass, $id);
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->adapter->findBy($this->entityClass, $criteria, $orderBy, $limit, $offset);
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->adapter->findOneBy($this->entityClass, $criteria);
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
        $this->persist($entity);

        if ($flush === true) {
            $this->flush();
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function persist(EntityInterface $entity)
    {
        return $this->adapter->persist($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function flush()
    {
        $this->adapter->flush();

        return true;
    }

}
