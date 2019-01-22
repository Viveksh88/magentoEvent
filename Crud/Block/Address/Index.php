<?php 
namespace Excellence\Crud\Block\Address;
use Excellence\Crud\Block\BaseBlock;

class Index extends BaseBlock
{
    public function showUserAadd(){
        $postCollection = $this->_coreRegistry->registry('showData');
        return $postCollection;
    }
    
}
?>