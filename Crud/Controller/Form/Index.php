<?php
/**
 *
 * Copyright © 2015 Excellencecommerce. All rights reserved.
 */
namespace Excellence\Crud\Controller\Form;

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

    protected $_dataSend;
    protected $_coreRegistry;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        
    
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Registry $coreRegistry,
        \Excellence\Crud\Model\TestFactory  $dataSend,
        \Magento\Framework\App\Cache\StateInterface $cacheState,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        
        $this->_coreRegistry = $coreRegistry;
        $this->_dataSend = $dataSend;
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

        // Deleting Data From Database......using Id..
        $deleteData = $this->getRequest()->getParams('id');
        if(isset($deleteData['deleteId'])){
            $id=$deleteData['deleteId'];
            $delete = $this->_dataSend->create();
            
            $delete->load($id);
            $dDeleted = $delete->delete();
            
            if($dDeleted){
                $this->messageManager->addNotice( __('Record Deleted Successfully !') );
            }
            $this->_redirect('crud/display/index');
        }
        // Adding And Updating Data To database....
        $dataEdit = $this->getRequest()->getPostValue();
        if(!empty($dataEdit['id'])){
            
           
            $uId = $dataEdit['id'];
            $username = $dataEdit['uname'];
            $fname = $dataEdit['fname'];
            $lname = $dataEdit['lname'];
            $email = $dataEdit['emailAd'];
            $password = $dataEdit['pwd'];
            $hashPass = substr(md5($password),0,8);//password Encrypted upto 7 numbers...

            $modelUpdate = $this->_dataSend->create()->load($uId);
            $modelUpdate->addData([
                "excellence_crud_id" =>$uId,
                "username" => $username,
                "fristname" => $fname,
                "lastname" => $lname,
                "email" => $email,
                "password" => $hashPass
                ]);
            $saveUpdatedData = $modelUpdate->save();
            if($saveUpdatedData){
                $this->messageManager->addSuccess( __('Record Updated Successfully....!') );
            }
            return $this->resultPageFactory->create();
        }   

        $post = $this->getRequest()->getPostValue();
        if(isset($post['sendData']))
        {
            
            $username = $post['username'];
            $fname = $post['fname'];
            $lname = $post['lname'];
            $email = $post['email'];
            $password = $post['password'];
            $hashPass = substr(md5($password),0,8);//password Encrypted upto 7 numbers...
            

            $modelInsert = $this->_dataSend->create();
            $modelInsert->addData([
                "username" => $username,
                "fristname" => $fname,
                "lastname" => $lname,
                "email" => $email,
                "password" => $hashPass
                ]);
            $saveData = $modelInsert->save();
            if($saveData){
                $this->messageManager->addSuccess( __('Insert Record Successfully !') );
            }
            $this->_redirect('crud/display/index');
            return $this->resultPageFactory->create();
            
        }
        
    }

}
?>