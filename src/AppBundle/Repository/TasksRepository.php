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
     * @param $boardId
     * @param $taskId
     * @return array
     */
    public function findTaskByBoardIdTaskId( $boardId, $taskId )
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.board','b')
            ->andWhere('b.id = :boardId')
            ->andWhere('t.id = :taskId')
            ->setParameter(':boardId', $boardId)
            ->setParameter(':taskId', $taskId)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }
}