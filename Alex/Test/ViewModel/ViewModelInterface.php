<?php

namespace Alex\Test\ViewModel;

use Alex\Test\Model\MultiStoreEntityInterface;

/**
 * Interface ViewModelInterface
 */
interface ViewModelInterface
{
    public function getMultipleStoreEntity(): MultiStoreEntityInterface;
}
