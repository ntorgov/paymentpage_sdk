<?php

namespace ecommpay;

/**
 * Class Payment
 *
 * @link https://developers.ecommpay.com/en/en_PP_Parameters.html
 *
 * phpcs:disable
 * @method $this setAccountToken(string $token):self The token of the bank card that will be used to perform a payment
 * @method $this setCardOperationType(string $type) Type of payment performed via payment card
 * @method $this setCashierDefaultMode(string $mode) The tab that is opened to customer when the payment page is opened
 * @method $this setCashierForceMode(string $mode) The only tab that is opened in the payment page
 * @method $this setCashierManualInput(bool $bool) Turning on or turning off the customer's ability to manually input amount of the payment or payout.
 * @method $this setCashierMaxValue(int $value) Maximum payment amount in minor unit of currency.
 * @method $this setCashierMinValue(int $value) Minimum payment amount in minor unit of currency.
 * @method $this setCloseOnMissclick(bool $bool) A parameter that specifies the action of the widget (opened in the modal window) when a customer clicks outside the widget area.
 * @method $this setCssModalWrap(string $wrap) An additional CSS class for a modal window.
 * @method $this setCustomerId(string $id) Unique ID of the customer in your project
 * @method $this setForceAcsNewWindow(bool $bool) The forced display mode with the ACS page opening in a new window despite the settings in Payment Page
 * @method $this setForcePaymentMethod(string $method) The ID of the payment provider that is opened to customers by default.
 * @method $this setLanguageCode(string $code) The language in which the payment page will be opened to the customer in ISO 639-1 alpha-2 format.
 * @method $this setListPaymentBlock(string $block) The payment block on the list of payment methods.
 * @method $this setMerchantFailUrl(string $url) The URL of the page in your project to which a customer is returned after a failed payment.
 * @method $this setMerchantSuccessUrl(string $url) The URL of the page in your project to which a customer is returned after a successful payment.
 * @method $this setMode(string $mode) Payment Page mode.
 * @method $this setPaymentAmount(int $amount) Payment amount specified in minor units of the currency of the payment
 * @method $this setPaymentCurrency(string $currency) Payment currency in ISO 4217 alpha-3 format
 * @method $this setPaymentDescription(string $desc) Payment description
 * @method $this setPaymentId(string $id) Unique ID of the payment in your project
 * @method $this setRecurringRegister(bool $bool) Parameter that indicates whether this payment should be registered as recurring
 * @method $this setCustomerFirstName(string $name) Customer first name
 * @method $this setCustomerLastName(string $name) Customer last name
 * @method $this setCustomerPhone(string $phone) Customer phone number. Must have from 4 to 24 digits
 * @method $this setCustomerEmail(string $email) Customer e-mail
 * @method $this setCustomerCountry(string $country) Country of the customer address, in ISO 3166-1 alpha-2 format
 * @method $this setCustomerState(string $state) State or region of the customer address
 * @method $this setCustomerCity(string $city) City of the customer address
 * @method $this setCustomerDayOfBirth(string $date) Customer birth date, DD-MM-YYYY
 * @method $this setCustomerSsn(int $ssn) The last 4 digits of the social security number of US
 * @method $this setBillingPostal(string $postal) The postal code of the customer billing address
 * @method $this setBillingCountry(string $country) The country of the customer billing address, in ISO 3166-1 alpha-2 format
 * @method $this setBillingRegion(string $region) The region or state of the customer billing address
 * @method $this setBillingCity(string $city) The city of the customer billing address
 * @method $this setBillingAddress(string $address) The street of the customer billing address
 * @method $this setRedirect(bool $bool) A parameter that enables opening of the generated payment page in a separate tab
 * @method $this setRedirectFailMode(string $mode) The mode for customer redirection when the payment failed
 * @method $this setRedirectFailUrl(string $url) The URL of the page in your project to which the customer is redirected when the payment failed
 * @method $this setRedirectOnMobile(bool $bool) A parameter that enables opening of the generated payment page in a separate tab on mobile devices only
 * @method $this setRedirectSuccessMode(string $mode) The mode for customer redirection after a successful payment.
 * @method $this setRedirectSuccessUrl(string $url) The URL of the page in your project to which the customer is redirected after a successful payment
 * @method $this setRedirectTokenizeMode(string $mode) The mode for customer redirection once a token is generated.
 * @method $this setRedirectTokenizeUrl(string $url) The URL of the page in your project to which the customer is redirected after a successful token generation.
 * @method $this setRegionCode(string $code) The region in ISO 3166-1 alpha-2 format. By default the region is determined by the IP address of the customer
 * @method $this setTargetElement(string $target) The element in which the iframe of the payment page is embedded in the web page of your project.
 * @method $this setTerminalId(int $id) Unique ID of the Payment Page template which you want to run despite the regional and A/B test settings
 * @method $this setBaseurl(string $url) Basic Payment Page address that is used in case the Payment Page domain differs from the domain used to connect libraries or if merchant.js is not connected via the <script> tag
 * @method $this setPaymentExtraParam(string $param) Additional parameter to be forwarded to Gate
 * phpcs:enable
 */
class Payment
{
    /**
     * @var array Payment parameters
     */
    private $params;

    public function __construct(string $projectId)
    {
        $this->params = [
            'project_id' => $projectId,
        ];
    }

    /**
     * Get payment parameters
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Date and time when the payment period expires.
     *
     * @param \DateTime $time
     *
     * @return Payment
     */
    public function setBestBefore(\DateTime $time): Payment
    {
        $this->params['best_before'] = $time->format('r');
        return $this;
    }

    /**
     * A range of predefined amounts that are available for selection by the customer.
     *
     * @param array $amounts
     * @return Payment
     */
    public function setCashierPredefinedAmounts(array $amounts): Payment
    {
        $this->params['cashier_predefined_amounts'] = implode(',', $amounts);

        return $this;
    }

    public function __call($name, $arguments)
    {
        if (strpos($name, 'set') === 0) {
            // convert 'setAccountToken' to 'account_token'
            $key = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', lcfirst(substr($name, 3))));
            $this->params[$key] = $arguments[0];
            return $this;
        }
        throw new \BadMethodCallException('Bad method call');
    }
}
