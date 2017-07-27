<?php
$installer = $this;
$installer->startSetup();
$installer->addAttribute('catalog_category', 'size_chart1', array(
    'group'                    => 'General',
    'label'                    => 'Size Chart',
    'input'                    => 'image',
    'type'                     => 'varchar',
    'backend'                  => 'brainium_sizechart/category_attribute_backend_file',
    'global'                   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'                  => true,
    'required'                 => false,
    'user_defined'             => true,
    'order'                    => 40
));
$installer->endSetup();