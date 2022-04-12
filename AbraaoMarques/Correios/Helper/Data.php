<?php

namespace AbraaoMarques\Correios\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const BASE_MODULE_PATH = 'carriers/abraaomarques_correios/';

    /**
     * Get is active
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->getValue('active');
    }

    /**
     * Get module's method name
     * @return mixed
     */
    public function getMethodName()
    {
        return $this->getValue('name');
    }

    /**
     * Get all methods were selected
     * @return false|string[]
     */
    public function getPostingMethods()
    {
        $postingMethods = $this->getValue('posting_methods');
        return explode(",", $postingMethods);
    }

    /**
     * @return mixed
     */
    public function getPostingFreeMethod()
    {
        return $this->getValue('posting_freemethod');
    }

    /**
     * Get login (correios contract number)
     * @return mixed
     */
    public function getLogin()
    {
        return $this->getValue('login');
    }

    /**
     * Get password (correios contract password)
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getValue('password');
    }

    /**
     * @return mixed
     */
    public function getOwnerHands()
    {
        return $this->getValue('owner_hands');
    }

    /**
     * @return mixed
     */
    public function getReceivedWarning()
    {
        return $this->getValue('received_warning');
    }

    /**
     * @return mixed
     */
    public function getDeclaredValue()
    {
        return $this->getValue('declared_value');
    }

    /**
     * @return mixed
     */
    public function getDefaultHeight()
    {
        return $this->getValue('default_height');
    }

    /**
     * @return mixed
     */
    public function getDefaultWidth()
    {
        return $this->getValue('default_width');
    }

    /**
     * @return mixed
     */
    public function getDefaultDepth()
    {
        return $this->getValue('default_depth');
    }

    /**
     * @return mixed
     */
    public function getHandlingFee()
    {
        return $this->getValue('handling_fee');
    }

    /**
     * @return mixed
     */
    public function getShowDeliveryDays()
    {
        return $this->getValue('show_deliverydays');
    }

    /**
     * @return mixed
     */
    public function getAddDeliveryDays()
    {
        return $this->getValue('add_deliverydays');
    }

    /**
     * @return mixed
     */
    public function getDeliveryDaysMessage()
    {
        return $this->getValue('deliverydays_message');
    }

    /**
     * @return mixed
     */
    public function getFreeShippingMessage()
    {
        return $this->getValue('freeshipping_message');
    }

    /**
     * @return mixed
     */
    public function getWebServiceUrl()
    {
        return $this->getValue('webservice_url');
    }

    /**
     * @return mixed
     */
    public function getMaxWeight()
    {
        return $this->getValue('max_weight');
    }

    /**
     * @return mixed
     */
    public function getEnabledLog()
    {
        return $this->getValue('enabled_log');
    }

    /**
     * @param $param
     * @return mixed
     */
    private function getValue($param)
    {
        return $this->scopeConfig->getValue(self::BASE_MODULE_PATH.$param, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getOriginPostCode()
    {
        return $this->scopeConfig->getValue('shipping/origin/postcode', ScopeInterface::SCOPE_STORE);
    }
}
