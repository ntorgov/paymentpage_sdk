<?php

namespace ecommpay\Request;

/**
 * Sale
 *
 * @copyright it ecommpay
 * @author Dmitry Fedorov <d.fedorov@it.ecommpay.com>
 * @license PHP Version 7+
 */
class Sale extends \ArrayObject
{

    /**
     * __construct
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $request = [];
        $general = array_keys(Validator::$generalInfo);
        $customer = array_keys(Validator::$customerInfo);
        $card = array_keys(Validator::$cardInfo);
        $payment = array_keys(Validator::$paymentInfo);

        foreach ($params as $name => $value) {
            if (in_array($name, $general)) {
                $request['general'][$name] = $value;
            } elseif (in_array($name, $customer)) {
                $request['customer'][$name] = $value;
            } elseif (in_array($name, $payment)) {
                $request['payment'][$name] = $value;
            } elseif (in_array($name, $card)) {
                $request['card'][$name] = $value;
            }
        }

        parent::__construct($request);
    }
}