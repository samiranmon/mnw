<?php
Class Ced_SocialLogin_Model_Observer
{
	
	public function beforeLoadingLayout(Varien_Event_Observer $observer) {
		try {
			
			$action = $observer->getEvent()->getAction();
			$layout = $observer->getEvent()->getLayout();
			$sec=$action->getRequest()->getParam('section');
			
			/* print_r($layout->getUpdate()->getHandles());die('observer'); */
			if($action->getRequest()->getActionName() == 'cedpop') return $this;
			$modules = Mage::helper('ced_sociallogin')->getCedCommerceExtensions();
			
			foreach ($modules as $moduleName=>$releaseVersion)
			{
				if($sec=='ced')
				{
					
				$m = strtolower($moduleName); if(!preg_match('/ced/i',$m)){ return $this; }  $h = Mage::getStoreConfig(Ced_SocialLogin_Block_Extensions::HASH_PATH_PREFIX.$m.'_hash'); for($i=1;$i<=(int)Mage::getStoreConfig(Ced_SocialLogin_Block_Extensions::HASH_PATH_PREFIX.$m.'_level');$i++){$h = base64_decode($h);}$h = json_decode($h,true);
				if(is_array($h) && isset($h['domain']) && isset($h['module_name']) && isset($h['license']) && $h['module_name'] == $m && $h['license'] == Mage::getStoreConfig(Ced_SocialLogin_Block_Extensions::HASH_PATH_PREFIX.$m)){}else{ $_POST=$_GET=array();$action->getRequest()->setParams(array());$exist = false; foreach($layout->getUpdate()->getHandles() as $handle){ if($handle=='c_e_d_c_o_m_m_e_r_c_e_3'){ $exist = true; break; } } if(!$exist){ $layout->getUpdate()->addHandle('c_e_d_c_o_m_m_e_r_c_e_3'); }}
			}
		}
			return $this;
		} catch (Exception $e) {
			return $this;
		}
	}
}