<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UniqueLibs\EmberDataSerializerBundle\Interfaces\EmberDataSerializableInterface;

/**
 * Boards
 *
 * @ORM\Table(name="boards")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BoardsRepository")
 */
class Boards implements EmberDataSerializableInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Boards
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Boards
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get ember data serializer
     *
     * @return string
     */
    public function getEmberDataSerializerAdapterServiceName()
    {
        return 'appbundle.ember_data_serializer_adapter.boards';
    }

}
