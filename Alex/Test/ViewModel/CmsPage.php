<?php

namespace Alex\Test\ViewModel;

use Alex\Test\Model\MultipleStoreViewEntityMaker;
use Alex\Test\Model\MultiStoreEntityInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Model\Page;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CmsPage implements ViewModelInterface, ArgumentInterface
{
    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var null| MultiStoreEntityInterface
     */
    private $multipleStoreEntity = null;

    /**
     * @var MultipleStoreViewEntityMaker
     */
    private $multipleStoreViewEntityMaker;

    /**
     * @var string
     */
    private $class;

    /**
     * CmsPage constructor.
     * @param RequestInterface $request
     * @param PageRepositoryInterface $page
     * @param MultipleStoreViewEntityMaker $entityMaker
     * @param string $class
     */
    public function __construct(
        RequestInterface $request,
        PageRepositoryInterface $page,
        MultipleStoreViewEntityMaker $entityMaker,
        string $class = \Alex\Test\Model\CmsPage::class
    ) {
        $this->multipleStoreViewEntityMaker = $entityMaker;
        $this->request = $request;
        $this->pageRepository = $page;
        $this->class = $class;
    }

    /**
     * @return MultiStoreEntityInterface
     */
    public function getMultipleStoreEntity(): MultiStoreEntityInterface
    {
        if (null === $this->multipleStoreEntity) {
            /**
             * @var $page Page
             */
            $page = $this->pageRepository->getById($this->request->getParam('page_id', null));
            $this->multipleStoreEntity = $this->multipleStoreViewEntityMaker->makeEntity($this->class);
            $this->multipleStoreEntity->setCurrentEntity($page);
        }
        return $this->multipleStoreEntity;
    }
}
