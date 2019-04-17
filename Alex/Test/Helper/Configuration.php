<?php

namespace Alex\Test\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Configuration extends AbstractHelper
{
    const XML_PATH_LANGUAGE_CODE = 'general/locale/hreflang_code';

    /**
     * @param int $storeId
     * @return string
     */
    public function getLanguageCode(int $storeId): string
    {
        return (string)$this->scopeConfig->getValue(
            static::XML_PATH_LANGUAGE_CODE,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );
    }
}
