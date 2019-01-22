<?php 
namespace Excellence\Crud\Model;
class Address extends \Magento\Framework\Model\AbstractModel{
	public function _construct(){
		$this->_init("Excellence\Crud\Model\ResourceModel\Address");
	}
}
 ?>