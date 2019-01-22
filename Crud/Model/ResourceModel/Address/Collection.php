<?php
namespace Excellence\Crud\Model\ResourceModel\Address;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Excellence\Crud\Model\Address','Excellence\Crud\Model\ResourceModel\Address');
    }
}