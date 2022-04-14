<?php

namespace AbraaoMarques\Correios\Model\Quotation;

use AbraaoMarques\Correios\Helper\Data;
use AbraaoMarques\Correios\Api\QuotationInterface;
use Magento\Catalog\Model\ProductFactory;

class Quotation implements QuotationInterface
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @param Data $helper
     * @param ProductFactory $productFactory
     */
    public function __construct(Data $helper, ProductFactory $productFactory)
    {
        $this->helper = $helper;
        $this->productFactory = $productFactory;
    }

    /**
     * @param $destination
     * @param $sku
     * @return array|false
     */
    public function get($destination, $sku)
    {
        $helper = $this->helper;

        if (!$helper->getIsActive()) {
            return false;
        }

        $weight = null;

        if ($sku) {
            $productFactory = $this->productFactory->create();
            $product = $productFactory->loadByAttribute('sku', $sku);
            $weight = (float) $product->getData('weight');
        }

        $methods = $helper->getPostingMethods();
        $result = '';

        foreach ($methods as $method) {
            $data = simplexml_load_string(file_get_contents($this->consult($destination, $method, $weight)));

            $value = $data->cServico->Valor;
            $time = $data->cServico->PrazoEntrega;
            $methodName = $this->getQuotationMethodName($method);

            $result .= '<span>'.$methodName.' - Em média '.$time.' dia(s) R$'.$value.'</span>';
        }

        return $result;
    }

    /**
     * @param $destination
     * @param $method
     * @param $weight
     * @return string
     */
    public function consult($destination, $method, $weight)
    {
        $helper = $this->helper;

        $webService = $helper->getWebServiceUrl();
        $login = $helper->getLogin();
        $password = $helper->getPassword();
        $defaultDepth = $helper->getDefaultDepth();
        $defaultHeight = $helper->getDefaultHeight();
        $defaultWidth = $helper->getDefaultWidth();
        $originPostCode = $helper->getOriginPostCode();

        return $webService.'&nCdEmpresa='.$login.'&sDsSenha='.$password.'&nCdFormato=1&nCdServico='.$method.'&nVlComprimento='.$defaultDepth.'&nVlAltura='.$defaultHeight.'&nVlLargura='.$defaultWidth.'&sCepOrigem='.$originPostCode.'&sCdMaoPropria=N&sCdAvisoRecebimento=N&nVlPeso='.$weight.'&sCepDestino='.$destination;
    }

    /**
     * @param $method
     * @return string
     */
    private function getQuotationMethodName($method)
    {
       if ($method == '40010' || $method == '4162') {
           $methodName = 'Sedex';
       } elseif ($method == '41106' || $method == '4669') {
           $methodName = 'PAC';
       } elseif ($method == '40215') {
           $methodName = 'Sedex 10';
       } elseif ($method == '40290') {
           $methodName = 'Sedex 10';
       } elseif ($method == '40045') {
           $methodName = 'Sedex 10';
       }

       return $methodName;
    }
}
