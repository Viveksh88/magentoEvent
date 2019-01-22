<?php
namespace Excellence\Crud\Model\ResourceModel\Test;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Excellence\Crud\Model\Test','Excellence\Crud\Model\ResourceModel\Test');
    }
}