<?php

namespace Withouth\Component\EntityManager;

/**
 * Entity manager interface
 */
interface ManagerInterface
{
    /**
     * Get entity class
     *
     * @return string
     */
    public function getEntityClass();

    /**
     * Create new entity instance
     *
     * @return EntityInterface
     */
    public function createEntity();

    /**
     * Find one by primary key
     *
     * @param mixed $id
     *
     * @return EntityInterface
     */
    public function find($id);

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
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);


    /**
     * Find one by criteria
     *
     * @param array $criteria
     *
     * @return EntityInterface
     */
    public function findOneBy(array $criteria);


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
