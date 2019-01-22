<?php
namespace Excellence\Crud\Model\ResourceModel\Order;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
    protected function _construct(){
        $this->_init('Excellence\Crud\Model\Order','Excellence\Crud\Model\ResourceModel\Order');
    }
}