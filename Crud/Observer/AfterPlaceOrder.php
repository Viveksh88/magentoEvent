<?php 
namespace Excellence\Crud\Observer;

use Magento\Framework\Event\ObserverInterface;

class AfterPlaceOrder implements ObserverInterface
{
    /**
     * Order Model
     *
     * @var \Magento\Sales\Model\Order $order
     */
    protected $order;
    protected $_coreRegistry;
    protected $_orderCollection;

     public function __construct(
        \Magento\Sales\Model\Order $order,
        \Magento\Framework\Registry $coreRegistry,
        \Excellence\Crud\Model\OrderFactory  $orderCollection
    )
    {
        $this->order = $order;
        $this->_orderCollection = $orderCollection;
        $this->_coreRegistry = $coreRegistry;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
       $orderId = $observer->getEvent()->getOrderIds();
        $order = $this->order->load($orderId);
        //get Order All Item
        $itemCollection = $order->getItemsCollection();
        
        $customerEmail = $order->getCustomerEmail();//Saving Data into Data Base
        $customerid = $order->getCustomerId();
        $customerTotal = $order->getBaseGrandTotal();
        $currency = $order->getBaseCurrencyCode();
        $customerFname = $order->getCustomerFirstname();
        $customerLname = $order->getCustomerLastname();
        $orderData = $this->_orderCollection->create();
        
        $orderData->addData([
            "grandTotal" => $customerTotal,
            "customerId" => $customerid,
            "customerEmail" => $customerEmail,
            "customerFirstname" => $customerFname,
            "customerLastname" => $customerLname,
            "currencyCode" => $currency,
        ]);

        $saveOrderData = $orderData->save();                                                                                                                                                                                                                                                                        
	}
}