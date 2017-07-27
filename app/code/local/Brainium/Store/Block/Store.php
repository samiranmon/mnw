<?php

class Brainium_Store_Block_Banner extends Mage_Core_Block_Template {

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getBanner() {
        if (!$this->hasData('store')) {
            $this->setData('store', Mage::registry('store'));
        }
        return $this->getData('store');
    }

}
