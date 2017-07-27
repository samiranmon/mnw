<?php
/**
 * CedCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
  * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    Ced
 * @package     Ced_SocialLogin
 * @author 		CedCommerce Magento Core Team <Ced_MagentoCoreTeam@cedcommerce.com>
 * @copyright   Copyright CedCommerce (http://cedcommerce.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * SocialLogin data Helper
 *
 * @category   	Ced
 * @package    	Ced_SocialLogin
 * @author 		CedCommerce Magento Core Team <Ced_MagentoCoreTeam@cedcommerce.com>
 */
class Ced_SocialLogin_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
     * redirect to 404 page
     */
public function redirect404($frontController)
    {
        $frontController->getResponse()
            ->setHeader('HTTP/1.1','404 Not Found');
        $frontController->getResponse()
            ->setHeader('Status','404 File not found');

        $pageId = Mage::getStoreConfig('web/default/cms_no_route');
        if (!Mage::helper('cms/page')->renderPage($frontController, $pageId)) {
				$frontController->_forward('defaultNoRoute');
			}
    }
    
    public function getCedCommerceExtensions($asString = false,$productName = false) {
    	if($asString) {
    		$cedCommerceModules = '';
    	} else {
    		$cedCommerceModules = array();
    	}
    	$allModules = Mage::app()->getConfig()->getNode(Ced_SocialLogin_Model_Feed::XML_PATH_INSTALLATED_MODULES);
    	$allModules = json_decode(json_encode($allModules),true);
    	foreach($allModules as $name=>$module) {
    		$name = trim($name);
    		if(preg_match('/ced_/i',$name) && isset($module['release_version']) && !preg_match('/ced_csvendorpanel/i',$name) && !preg_match('/ced_cstransaction/i',$name)) {
    
    			if($asString) {
    				$cedCommerceModules .= $name.':'.trim($module['release_version']).'~';
    			} else {
    				if($productName){
    					$cedCommerceModules[$name]['release_version'] = trim($module['release_version']);
    					$cedCommerceModules[$name]['parent_product_name'] = (isset($module['parent_product_name']) && strlen($module['parent_product_name']) > 0) ? $module['parent_product_name'] : trim($name);
    				} else {
    					$cedCommerceModules[$name] = trim($module['release_version']);
    				}
    					
    			}
    		}
    	}
    	if($asString) trim($cedCommerceModules,'~');
    	return $cedCommerceModules;
    }
    public function getEnvironmentInformation () {
    	$info = array();
    	$info['domain_name'] = Mage::getBaseUrl();
    	$info['framework'] = 'magento';
    	$info['edition'] = 'default';
    	if(method_exists('Mage','getEdition')) $info['edition'] = Mage::getEdition();
    	$info['version'] = Mage::getVersion();
    	$info['php_version'] = phpversion();
    	$info['feed_types'] = Mage::getStoreConfig(Ced_SocialLogin_Model_Feed::XML_FEED_TYPES);
    	$info['admin_name'] =  Mage::getStoreConfig('trans_email/ident_general/name');
    	if(strlen($info['admin_name']) == 0) $info['admin_name'] =  Mage::getStoreConfig('trans_email/ident_sales/name');
    	$info['admin_email'] =  Mage::getStoreConfig('trans_email/ident_general/email');
    	if(strlen($info['admin_email']) == 0) $info['admin_email'] =  Mage::getStoreConfig('trans_email/ident_sales/email');
    	$info['installed_extensions_by_cedcommerce'] = $this->getCedCommerceExtensions(true);
    
    	return $info;
    }
    
    public function addParams($url = '', $params = array(), $urlencode = true) {
    	if(count($params)>0){
    		foreach($params as $key=>$value){
    			if(parse_url($url, PHP_URL_QUERY)) {
    				if($urlencode)
    					$url .= '&'.$key.'='.$this->prepareParams($value);
    				else
    					$url .= '&'.$key.'='.$value;
    			} else {
    				if($urlencode)
    					$url .= '?'.$key.'='.$this->prepareParams($value);
    				else
    					$url .= '?'.$key.'='.$value;
    			}
    		}
    	}
    	return $url;
    }
    public function prepareParams($data){
    	if(!is_array($data) && strlen($data)){
    		return urlencode($data);
    	}
    	if($data && is_array($data) && count($data)>0){
    		foreach($data as $key=>$value){
    			$data[$key] = urlencode($value);
    		}
    		return $data;
    	}
    	return false;
    }
}
	 