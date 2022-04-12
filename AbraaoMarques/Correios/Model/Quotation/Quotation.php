<?php

namespace AbraaoMarques\Correios\Model\Quotation;

use AbraaoMarques\Correios\Helper\Data;

class Quotation
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }

    public function get()
    {
        $helper = $this->helper;

        if (!$helper->getIsActive()) {
            return false;
        }

        $methods = $helper->getPostingMethods();

        foreach ($methods as $method) {
            $data = simplexml_load_string(file_get_contents($this->consult('13219-071', $method, 1)));
            return $data;
        }
    }

    /**
     * @param $destination
     * @param $method
     * @param $weight
     * @return string
     */
    private function consult($destination, $method, $weight)
    {
        $helper = $this->helper;

        $webService = $helper->getWebServiceUrl();
        $login = $helper->getLogin();
        $password = $helper->getPassword();
        $defaultDepth = $helper->getDefaultDepth();
        $defaultHeight = $helper->getDefaultHeight();
        $defaultWidth = $helper->getDefaultWidth();
        $originPostCode = $helper->getOriginPostCode();

        return $webService.'&nCdEmpresa='
            .$login.'&sDsSenha='.$password.'&nCdFormato=1&nCdServico='
            .$method.'&nVlComprimento='.$defaultDepth.'&nVlAltura='
            .$defaultHeight.'&nVlLargura='.$defaultWidth.'&sCepOrigem='
            .$originPostCode.'&sCdMaoPropria=N&sCdAvisoRecebimento=N&nVlPeso='
            .$weight.'&sCepDestino='.$destination;
    }
}
