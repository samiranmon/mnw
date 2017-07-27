<?php

class Brainium_Store_Block_Adminhtml_Store_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('storeGrid');
        $this->setDefaultSort('store_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('store/store')->getCollection();

        foreach ($collection as $view) {
            if ($view->getStoreId() && $view->getStoreId() != 0) {
                $view->setStoreId(explode(',', $view->getStoreId()));
            } else {
                $view->setStoreId(array('0'));
            }
        }

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('store_id', array(
            'header' => Mage::helper('store')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'store_id',
        ));

        $this->addColumn('title', array(
            'header' => Mage::helper('store')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        $this->addColumn('description', array(
            'header' => Mage::helper('store')->__('Item Content'),
            'width' => '150px',
            'index' => 'description',
        ));

        $this->addColumn('image', array(
            'header' => Mage::helper('store')->__('Image'),
            'filter' => false,
            'index' => 'image',
            'renderer' => 'store/adminhtml_store_renderer_image',
            'align' => 'center',
            'width' => '100px',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header' => Mage::helper('store')->__('Store View'),
                'index' => 'store_id',
                'type' => 'store',
                'store_all' => true,
                'store_view' => true,
                'sortable' => true,
                'filter_condition_callback' => array($this, '_filterStoreCondition'),
            ));
        }

        $this->addColumn('status', array(
            'header' => Mage::helper('store')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('store')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('store')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                )
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'stores',
            'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('store')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('store')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('store_id');
        $this->getMassactionBlock()->setFormFieldName('store');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('store')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('store')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('store/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('store')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('store')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
