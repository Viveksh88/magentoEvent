<?php
/**
 *
 * Copyright © 2015 Excellencecommerce. All rights reserved.
 */
namespace Excellence\Crud\Controller\Addressdata;

class Index extends \Magento\Framework\App\Action\Action
{

	/**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $_cacheTypeList;

    /**
     * @var \Magento\Framework\App\Cache\StateInterface
     */
    protected $_cacheState;

    /**
     * @var \Magento\Framework\App\Cache\Frontend\Pool
     */
    protected $_cacheFrontendPool;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $_collectiondata;
    protected $_coreRegistry;
    protected $_addresscollection;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
       \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Excellence\Crud\Model\TestFactory  $collectiondata,
        \Excellence\Crud\Model\AddressFactory  $addresscollection,
        \Magento\Framework\App\Cache\StateInterface $cacheState,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_addresscollection = $addresscollection;
        $this->_collectiondata = $collectiondata;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheState = $cacheState;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->resultPageFactory = $resultPageFactory;
    }
	
    /**
     * Flush cache storage
     *
     */
    public function execute()
    {
        $addressAdd = $this->getRequest()->getParams();
        if(isset($addressAdd['deleteAddId'])){ //deleting address data..
            $id=$addressAdd['deleteAddId'];
            $deleteData = $this->_addresscollection->create();
            
            $data = $deleteData->load($id);
            $params = $data['excellence_user_id'];
            $dDeleted = $deleteData->delete();
            
            if($dDeleted){
                $this->messageManager->addNotice( __('Record Deleted Successfully !') );
            }
            $this->_redirect('crud/viewaddress/index', array('viewAddId' => $params));
        }
        $editData = $this->getRequest()->getPostValue();
        if(isset($editData['id'])){ //for editing address data
            $aId = $editData['id'];
            $uId = $editData['userId'];
            $house = $editData['hNo'];
            $street = $editData['street'];
            $city = $editData['city'];
            $state = $editData['state'];
            $pin = $editData['pin'];
            $params = array('uid' => $aId);
            

            $modelUpdate = $this->_addresscollection->create()->load($aId);
            $modelUpdate->addData([
                "excellence_address_id" =>$aId,
                "excellence_user_id" =>$uId,
                "House_no" => $house,
                "Street_name" => $street,
                "City_name" => $city,
                "State_name" => $state,
                "pin" => $pin
                ]);
            $saveUpdatedData = $modelUpdate->save();
            if($saveUpdatedData){
                $this->messageManager->addSuccess( __('Record Updated Successfully....!') );
            }
            
            return ;
        }
        //for inserting address data into table
        if(isset($addressAdd['addressUserId'])){
            $dataAdd = $this->getRequest()->getPostValue();
           
           $userId = $dataAdd['addressUserId'];
           $hNo = $dataAdd['houseAdd'];
           $street = $dataAdd['streetAdd'];
           $city = $dataAdd['cityAdd'];
           $state = $dataAdd['stateAdd'];
           $pin = $dataAdd['pinAdd'];

           $addressInsert = $this->_addresscollection->create();
           $addressInsert->addData([
               "excellence_user_id" => $userId,
               "House_no" => $hNo,
               "Street_name" => $street,
               "City_name" => $city,
               "State_name" => $state,
               "pin" => $pin,
               ]);
           $saveData = $addressInsert->save();
           if($saveData){
               $this->messageManager->addSuccess( __('Insert Record Successfully !') );
           }
           $this->_redirect('crud/display/index');
        }
        
    }

}