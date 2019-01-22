<?php 
namespace Excellence\Crud\Model;
class Order extends \Magento\Framework\Model\AbstractModel{
	public function _construct(){

		$this->_init("Excellence\Crud\Model\ResourceModel\Order");
		
	}
}
 ?>