<?php

namespace Withouth\Component\EntityManager;

/**
 * Entity resource adapter interface
 */
interface ResourceAdapterInterface
{
    /**
     * Find one by primary key
     *
     * @param mixed $id
     *
     * @return EntityInterface
     */
    public function find($entityClass, $id);

    /**
     * Find collection by criteria
     *
     * @param array        $criteria
     * @param array|null   $orderBy
     * @param integer|null $limit
     * @param integer|null $offset
     *
     * @return mixed
     */
    public function findBy($entityClass, array $criteria, array $orderBy = null, $limit = null, $offset = null);


    /**
     * Find one by criteria
     *
     * @param array $criteria
     *
     * @return EntityInterface
     */
    public function findOneBy($entityClass, array $criteria);

    /**
     * Remove entity
     *
     * @param EntityInterface $entity
     *
     * @return boolean
     */
    public function remove(EntityInterface $entity);

    /**
     * save entity
     *
     * @param EntityInterface $entity
     * @param boolean         $flush
     *
     * @return boolean
     */
    public function save(EntityInterface $entity, $flush = true);

}