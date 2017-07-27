<?php

class Brainium_Store_Block_Adminhtml_Store_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    protected function _prepareLayout() {
        // Load Wysiwyg on demand and Prepare layout
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled() && ($block = $this->getLayout()->getBlock('head'))) {
            $block->setCanLoadTinyMce(true);
        }
        parent::_prepareLayout();
    }

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'store';
        $this->_controller = 'adminhtml_store';

        $this->_updateButton('save', 'label', Mage::helper('store')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('store')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('store_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'store_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'store_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText() {
        if (Mage::registry('store_data') && Mage::registry('store_data')->getId()) {
            return Mage::helper('store')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('store_data')->getTitle()));
        } else {
            return Mage::helper('store')->__('Add Item');
        }
    }

}
