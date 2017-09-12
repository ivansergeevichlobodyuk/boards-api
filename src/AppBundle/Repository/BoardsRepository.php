<?php
namespace AppBundle\Repository;


use Doctrine\ORM\Query;

/**
 * Class TasksRepository
 */
class BoardsRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Finds task by board id and task id
     *
     * @param $boardId
     * @param $taskId
     * @return array
     */
    public function findAllBoards( )
    {
        $result = $this->createQueryBuilder('b')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);

        $data = array( 'data' => array( ) );
        foreach ( $result AS $key => $value ){
            $data['data'][] = array(
                'type' => 'board',
                'id' => $value['id'],
                'attributes' => array( 'name' => $value['name'], 'count' => $value['count'])
            );
        }
        return $data;
    }
}