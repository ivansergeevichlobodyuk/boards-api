<?php

namespace AppBundle\Entity\EmberDataSerializerAdapter;

use UniqueLibs\EmberDataSerializerBundle\Interfaces\EmberDataSerializableInterface;
use UniqueLibs\EmberDataSerializerBundle\Interfaces\EmberDataSerializerAdapterInterface;
use AppBundle\Entity\Tasks;

class TasksAdapter implements EmberDataSerializerAdapterInterface
{
    const MODEL_NAME_SINGULAR = 'task';
    const MODEL_NAME_PLURAL = 'tasks';

    /**
     * @param EmberDataSerializableInterface $object
     *
     * @return bool
     */
    public function hasAccess(EmberDataSerializableInterface $object)
    {
        /** @var User $object */
        return true;
    }

    /**
     * @param EmberDataSerializableInterface $object
     *
     * @return array
     */
    public function getData(EmberDataSerializableInterface $object)
    {
        /** @var Tasks $object */
        return array(
            'id' => array($object->getId(), false),
            'taskName' => array($object->getTaskName(), false),
            'taskType' => array($object->getTaskType(), false),
            'title' => array($object->getTitle(), false),
            'introText' => array($object->getIntroText(), false),
            'fullText' => array($object->getFullText(), false),
            'board' => array($object->getBoard()->getId(), false)
        );
    }

    /**
     * @return string
     */
    public function getModelNameSingular()
    {
        return self::MODEL_NAME_SINGULAR;
    }

    /**
     * @return string
     */
    public function getModelNamePlural()
    {
        return self::MODEL_NAME_PLURAL;
    }
}