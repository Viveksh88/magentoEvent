<?php
namespace Excellence\Shippingmethod\Model;
use Magento\Quote\Model\Quote\Address\RateResult\Error;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Carrier\AbstractCarrierOnline;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\Result;
use Magento\Shipping\Model\Simplexml\Element;
use Magento\Ups\Helper\Config;
use Magento\Framework\Xml\Security;
 
 
class Carrier extends AbstractCarrierOnline implements CarrierInterface
{

    const CODE = 'customshipping';
    protected $_code = self::CODE;
    protected $_request;
    protected $_result;
    protected $_baseCurrencyRate;
    protected $_xmlAccessRequest;
    protected $_localeFormat;
    protected $_logger;
    protected $configHelper;
    protected $_errors = [];
    protected $_isFixed = true;
    protected $_cartdata;
     
    public function __construct(
        
        \Magento\Checkout\Model\Cart $cartdata,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        Security $xmlSecurity,
        \Magento\Shipping\Model\Simplexml\ElementFactory $xmlElFactory,
        \Magento\Shipping\Model\Rate\ResultFactory $rateFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Shipping\Model\Tracking\ResultFactory $trackFactory,
        \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory,
        \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Directory\Helper\Data $directoryData,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        Config $configHelper,
        array $data = []
    ) {
        $this->_cartdata = $cartdata;
        $this->_localeFormat = $localeFormat;
        $this->configHelper = $configHelper;
        parent::__construct(
            $scopeConfig,
            $rateErrorFactory,
            $logger,
            $xmlSecurity,
            $xmlElFactory,
            $rateFactory,
            $rateMethodFactory,
            $trackFactory,
            $trackErrorFactory,
            $trackStatusFactory,
            $regionFactory,
            $countryFactory,
            $currencyFactory,
            $directoryData,
            $stockRegistry,
            $data
        );
    }
    protected function _doShipmentRequest(\Magento\Framework\DataObject $request)
    {
    }
    public function getShippingCost(){
        $fetchPrice = $this->_cartdata->getQuote();    
        $productTotalPrice =  $fetchPrice->getSubtotal(); 
        $shippingCost = ($productTotalPrice*0.10);//10% cost of total price of products.
        return $shippingCost;
    }
 
    public function getAllowedMethods()
    { 
    }
    public function collectRates(RateRequest $request)
    {   
         
        $result = $this->_rateFactory->create();

        $method = $this->_rateMethodFactory->create();
        $shipppingData = $this->getShippingCost();
        
        $method->setCarrier($this->_code);
       
        $method->setCarrierTitle('10% Shipping Charge[Fixed Rate]');
        $method->setMethod($this->_code);
        $method->setMethodTitle('10% Shipping Charge[Flat Rate]');
        $method->setCost($shipppingData);
        $method->setPrice($shipppingData);
        $result->append($method);
        return $result; 
    }
     
    public function proccessAdditionalValidation(\Magento\Framework\DataObject $request) {
        return true;
    }
}