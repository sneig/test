<?php

namespace Alex\Test\Model;

use Magento\Cms\Model\Page;
use Alex\Test\Helper\Configuration;

class CmsPage implements MultiStoreEntityInterface
{
    /**
     * @var Page
     */
    private $currentEntity;

    /**
     * @var array
     */
    private $assignedStoreIds = [];

    /**
     * @var ActiveStores
     */
    private $activeStores;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * CmsPage constructor.
     * @param ActiveStores $activeStores
     * @param Configuration $configuration
     */
    public function __construct(ActiveStores $activeStores, Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->activeStores = $activeStores;
    }

    /**
     * @return array
     */
    public function getStoreIds(): array
    {
        if (empty($this->assignedStoreIds)) {
            $stores = $this->currentEntity->getStores();
            if (in_array(0, $stores)) {
                foreach ($this->activeStores->getActiveStores() as $activeStore) {
                    $this->pushToAssignedStores($activeStore->getId());
                }
            } else {
                foreach ($stores as $storeId) {
                    if ($this->activeStores->getStore($storeId)) {
                        $this->pushToAssignedStores($storeId);
                    }
                }
            }
        }

        return $this->assignedStoreIds;
    }

    /**
     * @param int $storeId
     * @return MultiStoreEntityInterface
     */
    private function pushToAssignedStores(int $storeId): MultiStoreEntityInterface
    {
        if (!$this->isCurrentStoreId($storeId)) {
            $this->assignedStoreIds[] = $storeId;
        }

        return $this;
    }

    /**
     * @param int $storeId
     * @return bool
     */
    private function isCurrentStoreId(int $storeId): bool
    {
        return $this->activeStores->getCurrentStoreId() == $storeId;
    }

    /**
     * @param int $storeId
     * @return string
     */
    public function getStoreUrl(int $storeId): string
    {
        $url = '';
        $store = $this->activeStores->getStore($storeId);
        if ($store) {
            $url = $store->getCurrentUrl(false);
        }

        return (string)$url;
    }

    /**
     * @param mixed $entity
     * @return $this
     */
    public function setCurrentEntity($entity)
    {
        $this->currentEntity = $entity;
        return $this;
    }

    /**
     * @param int $storeId
     * @return string
     */
    public function getStoreLanguage(int $storeId): string
    {
        return $this->configuration->getLanguageCode($storeId);
    }
}
