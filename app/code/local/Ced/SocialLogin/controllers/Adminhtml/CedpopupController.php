<?php
class Ced_SocialLogin_Adminhtml_CedpopupController extends Mage_Adminhtml_Controller_Action
{
	public function cedpopAction() {
		
		if (!Mage::getSingleton('admin/session')->isLoggedIn()) {
			$this->_redirect('*/index/login');
			return;
		}
		$this->loadLayout(array('c_e_d_c_o_m_m_e_r_c_e_4'));
		$this->renderLayout();
	}
	
}