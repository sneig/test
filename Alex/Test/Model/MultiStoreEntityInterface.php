<?php

namespace Alex\Test\Model;

/**
 * Interface MultiStoreEntityInterface
 */
interface MultiStoreEntityInterface
{
    /**
     * @return array
     */
    public function getStoreIds(): array;

    /**
     * @param int $storeId
     * @return string
     */
    public function getStoreUrl(int $storeId): string;

    /**
     * @param mixed $entity
     * @return mixed
     */
    public function setCurrentEntity($entity);

    /**
     * @param int $storeId
     * @return mixed
     */
    public function getStoreLanguage(int $storeId): string;
}
