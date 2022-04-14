<?php

namespace AbraaoMarques\Correios\Controller\Search;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use AbraaoMarques\Correios\Model\Quotation\Quotation as ModelQuotation;

class Quotation extends Action
{
    /**
     * @var ModelQuotation
     */
    private $modelQuotation;

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @param ModelQuotation $modelQuotation
     * @param JsonFactory $jsonFactory
     * @param Context $context
     */
    public function __construct(
        ModelQuotation $modelQuotation,
        JsonFactory $jsonFactory,
        Context $context
    ) {
        $this->modelQuotation = $modelQuotation;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $param = $this->getRequest()->getParams();
        $result = $this->modelQuotation->get($param['zipcode'], $param['productSku']);
        $jsonFactory = $this->jsonFactory->create();

        return $jsonFactory->setData($result);
    }
}
