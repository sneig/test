<?php

namespace Alex\Test\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\ObjectManagerInterface;

class MultipleStoreViewEntityMaker
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * MultipleStoreViewEntityMaker constructor.
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param string $class
     * @param array $arguments
     * @return MultiStoreEntityInterface
     * @throws LocalizedException
     */
    public function makeEntity(string $class, array $arguments = []): MultiStoreEntityInterface
    {
        $object = $this->objectManager->create(
            $class,
            $arguments
        );
        if (!($object instanceof MultiStoreEntityInterface)) {
            throw new LocalizedException(__('Entity class must implement %1', MultiStoreEntityInterface::class));
        }

        return $object;
    }
}
