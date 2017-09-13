<?php

namespace AppBundle\Entity\EmberDataSerializerAdapter;

use UniqueLibs\EmberDataSerializerBundle\Interfaces\EmberDataSerializableInterface;
use UniqueLibs\EmberDataSerializerBundle\Interfaces\EmberDataSerializerAdapterInterface;
use AppBundle\Entity\Boards;

class BoardsAdapter implements EmberDataSerializerAdapterInterface
{
    const MODEL_NAME_SINGULAR = 'board';
    const MODEL_NAME_PLURAL = 'boards';

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
        /** @var User $object */
        return array(
            'id' => array($object->getId(), false),
            'name' => array($object->getName(), false),
            'count' => array($object->getCount(), false),
            'relations' => array($object)
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