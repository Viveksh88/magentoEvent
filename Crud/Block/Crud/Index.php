<?php
/**
 * Copyright © 2015 Excellence . All rights reserved.
 */
namespace Excellence\Crud\Block\Crud;
use Excellence\Crud\Block\BaseBlock;

class Index extends BaseBlock
{
	protected function _prepareLayout()
	{
        parent::_prepareLayout();
        if ($this->getCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager'
            )->setCollection(
                $this->getCollection() // assign collection to pager
            );
            $this->setChild('pager', $pager);// set pager block in layout
        }
        return $this;
    }
  
    /**
     * @return string
     */
    // method for get pager html
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }  
    
   

}
