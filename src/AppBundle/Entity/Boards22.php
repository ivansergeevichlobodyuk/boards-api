<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="Tasks", inversedBy="boards", cascade={"remove"})
     * @ORM\JoinTable(name="tasks")
     **/
    private $relationsTasks;


    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->relationsTasks = new ArrayCollection();
    }

    /**
     * Set pressContact
     *
     * @param $pressContact
     *
     * @return $this
     */
    public function setRelationsTasks( ArrayCollection $relationsTasks)
    {
       $this->relationsTasks = $relationsTasks;
        return $this;
    }
//
//    /**
//     * Add pressContact
//     *
//     * @param \AppBundle\Entity\PressContact $pressContact
//     *
//     * @return News
//     */
//    public function addRelationsTasks(\AppBundle\Entity\Tasks $relationsTasks)
//    {
//        $this->relationsTasks[] = $relationsTasks;
//
//        return $this;
//    }
//
//
//    /**
//     * Remove pressContact
//     *
//     * @param \AppBundle\Entity\PressContact $pressContact
//     */
//    public function removeRelationsTasks(\AppBundle\Entity\Tasks $relationsTasks)
//    {
//        $this->relationsTasks->removeElement($relationsTasks);
//    }

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
     * Get count
     *
     * @return ArrayCollection
     */
    public function getRelationsTasks()
    {
        return $this->relationsTasks;
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


    /**
     * Set id
     *
     * @param \AppBundle\Entity\Tasks $id
     *
     * @return Boards
     */
    public function setId(\AppBundle\Entity\Tasks $id = null)
    {
        $this->id = $id;

        return $this;
    }
}
