<?php

namespace Alex\Test\Model;

use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

class ActiveStores
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var array
     */
    private $storeById = [];

    private $currentStoreId = null;

    /**
     * ActiveStores constructor.
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
        $this->prepareActiveStores();
    }

    /**
     * @return void
     */
    public function prepareActiveStores()
    {
        if (empty($this->storeById)) {
            foreach ($this->storeManager->getStores() as $store) {
                /**
                 * @var $store Store
                 */
                if ($store->isActive()) {
                    $this->storeById[$store->getId()] = $store;
                }
            }
        }
    }

    /**
     * @return Store[]
     */
    public function getActiveStores()
    {
        return $this->storeById;
    }

    /**
     * @param int $storeId
     * @return Store|null
     */
    public function getStore(int $storeId)
    {
        return $this->storeById[$storeId] ?? null;
    }

    /**
     * @return int
     */
    public function getCurrentStoreId()
    {
        if (null === $this->currentStoreId) {
            $this->currentStoreId = (int)$this->storeManager->getStore()->getId();
        }
        return $this->currentStoreId;
    }
}
