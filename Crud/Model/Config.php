<?php

namespace Excellence\Crud\Model;

class Config extends \Magento\Framework\DataObject
{	
    protected $_scopeConfig;
	
    protected $_configValueFactory;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\Config\ValueFactory $configValueFactory,
        array $data = []
    ) {
        parent::__construct($data);
        $this->_scopeConfig = $scopeConfig;
        $this->_configValueFactory = $configValueFactory;
	}

}