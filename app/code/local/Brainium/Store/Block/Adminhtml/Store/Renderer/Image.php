<?php

class Brainium_Store_Block_Adminhtml_Store_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        if ($row->getImage() == "") {
            return "";
        } else {
            //you can also use some resizer here...
            return "<img src='" . Mage::getBaseUrl("media") . 'store/' . $row->getImage() . "' width='75' height='75'/>";
        }
    }

}
