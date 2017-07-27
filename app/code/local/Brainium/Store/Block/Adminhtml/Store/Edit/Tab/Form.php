<?php

class Brainium_Store_Block_Adminhtml_Store_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        /* start editor */
        $form->setHtmlIdPrefix('store');
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('tab_id' => 'form_section'));
        $wysiwygConfig["files_browser_window_url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index');
        $wysiwygConfig["directives_url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive');
        $wysiwygConfig["directives_url_quoted"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg/directive');
        $wysiwygConfig["widget_window_url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/widget/index');
        $wysiwygConfig["files_browser_window_width"] = (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_width');
        $wysiwygConfig["files_browser_window_height"] = (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_height');
        $plugins = $wysiwygConfig->getData("plugins");
        $plugins[0]["options"]["url"] = Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/system_variable/wysiwygPlugin');
        $plugins[0]["options"]["onclick"]["subject"] = "MagentovariablePlugin.loadChooser('" . Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/system_variable/wysiwygPlugin') . "', '{{html_id}}');";
        $plugins = $wysiwygConfig->setData("plugins", $plugins);
        /* end editor */

        $fieldset = $form->addFieldset('store_form', array('legend' => Mage::helper('store')->__('Item information')));

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('store')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));

        $fieldset->addField('url', 'text', array(
            'label' => Mage::helper('store')->__('Url'),
            'required' => false,
            'name' => 'url',
        ));

        $fieldset->addField('image', 'file', array(
            'label' => Mage::helper('store')->__('Store Image'),
            'required' => false,
            'name' => 'image',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('store')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('store')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('store')->__('Disabled'),
                ),
            ),
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('store')->__('Store View'),
                'title' => Mage::helper('store')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')
                        ->getStoreValuesForForm(false, true),
            ));
        } else {
            $fieldset->addField('store_id', 'hidden', array(
                'name' => 'stores[]',
                'value' => Mage::app()->getStore(true)->getId()
            ));
        }

        $fieldset->addField('description', 'editor', array(
            'name' => 'description',
            'label' => Mage::helper('store')->__('Content'),
            'title' => Mage::helper('store')->__('Content'),
            'style' => 'width:700px; height:500px;',
            'wysiwyg' => true,
            'required' => true,
            'state' => 'html',
            'config' => $wysiwygConfig,
        ));

        if (Mage::getSingleton('adminhtml/session')->getBannerData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBannerData());
            Mage::getSingleton('adminhtml/session')->setBannerData(null);
        } elseif (Mage::registry('store_data')) {
            $form->setValues(Mage::registry('store_data')->getData());
        }
        return parent::_prepareForm();
    }

}
