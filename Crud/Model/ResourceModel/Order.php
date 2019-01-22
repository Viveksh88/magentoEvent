<?php 
namespace Excellence\Crud\Model\ResourceModel;
class Order extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
 public function _construct(){

 $this->_init("excellence_crud_orderSuccessDetails","excellence_crud_orderId");
 
 }
}
 ?>