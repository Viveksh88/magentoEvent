<?php 
namespace Excellence\Crud\Model\ResourceModel;
class Address extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
 public function _construct(){
 $this->_init("excellence_crud_address","excellence_address_id");
 }
}
 ?>