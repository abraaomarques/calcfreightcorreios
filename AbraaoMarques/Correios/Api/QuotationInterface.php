<?php

namespace AbraaoMarques\Correios\Api;

interface QuotationInterface
{
    /**
     * @param $destination
     * @param $sku
     * @return mixed
     */
    public function get($destination, $sku);

    /**
     * @param $destination
     * @param $method
     * @param $weight
     * @return mixed
     */
    public function consult($destination, $method, $weight);
}
