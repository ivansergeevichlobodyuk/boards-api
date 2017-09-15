<?php
namespace AppBundle\Repository;


use Doctrine\ORM\Query;

/**
 * Class TasksRepository
 */
class TasksRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Finds task by board id and task id
     *
     * @param $taskId
     * @return array
     */
    public function findTaskById( $taskId )
    {

        return $this->createQueryBuilder('t')
            ->andWhere('t.id = :taskId')
            ->setParameter(':taskId', $taskId)
            ->getQuery()
            ->getResult();
    }
}