<?php
/**
 *
 * Copyright © 2015 Excellencecommerce. All rights reserved.
 */
namespace Excellence\Crud\Controller\Display;

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
        $searchData = $this->getRequest()->getPostValue();
        if(isset($searchData['uName'])){
            $userN = $searchData['uName'];
            
            $fetchdata = $this->_collectiondata->create()->getCollection();
            $userData = $fetchdata->addFieldToFilter('username',array('like' => '%' . $userN. '%'));
           
            foreach($userData as $uCollection){
                $data[] = array(
                    'id'=>$uCollection['excellence_crud_id'],
                    'username'=>$uCollection['username'],
                    'fName'=>$uCollection['fristname'],
                    'lName'=>$uCollection['lastname'],
                    'eMail'=>$uCollection['email'],
                    'pass' =>$uCollection['password'],
                );
               
            }
            $data['count'] = count($data);
            return $this->getResponse()->setBody(json_encode($data));


        }
        
		
		return $this->resultPageFactory->create();
    }

}