<?php 
namespace Excellence\Crud\Model\ResourceModel;
class Test extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb{
 public function _construct(){
 $this->_init("excellence_crud_operation","excellence_crud_id");
 }
}
 ?>