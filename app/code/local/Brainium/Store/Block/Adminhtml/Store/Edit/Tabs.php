<?php

class Brainium_Store_Block_Adminhtml_Store_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('store_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('store')->__('Item Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('store')->__('Item Information'),
            'title' => Mage::helper('store')->__('Item Information'),
            'content' => $this->getLayout()->createBlock('store/adminhtml_store_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}
