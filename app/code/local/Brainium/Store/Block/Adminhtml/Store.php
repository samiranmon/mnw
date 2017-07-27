<?php

class Brainium_Store_Block_Adminhtml_Store extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_store';
        $this->_blockGroup = 'store';
        $this->_headerText = Mage::helper('store')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('store')->__('Add Item');
        parent::__construct();
    }

}
