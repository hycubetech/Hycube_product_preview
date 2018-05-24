<?php

/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/LICENSE-M1.txt
 *
 * @category   HC
 * @package    HC_Ppp
 * @copyright  Copyright (c) 2008-2011 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/LICENSE-M1.txt
 */
class HC_Ppp_Block_Wrapper extends Mage_Core_Block_Template {

    public function  getBaseUrl(){

        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
    }

    public function  getLoadingIndicator(){

        $loadingIndicator = Mage::getStoreConfig('ppp/ppp_configuration/image');

        $loadingIndicatorUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."hc_ppp/".$loadingIndicator;

        return $loadingIndicatorUrl;
    }

    public function  getTimeout(){

        $timeoutFromConfig = Mage::getStoreConfig('ppp/ppp_configuration/delaybeforedisplay');

        if (!$timeoutFromConfig) $timeoutFromConfig= HC_Ppp_Helper_Config::TIMEOUT;
        if((int)$timeoutFromConfig<300){
            $timeoutFromConfig = 300;
        }
        return $timeoutFromConfig;
    }

    public function isAvaliableForThisCategory($currCateg) {
        $configProductCatIds = Mage::getStoreConfig('ppp/ppp_configuration/categories');
        if (strlen($configProductCatIds)>1) {
            $idsFromConfig = explode(",", $configProductCatIds);
            if (!in_array($currCateg, $idsFromConfig)) {
                return false;
            }
        }
        return true;
    }

    public function getContainersize() {

        $configImagesize = $this->getConfigImageSize();
        $parametersToReturn = "";     
        
        if ((bool) Mage::getStoreConfig('ppp/ppp_configuration/showproducttitle')) {
            $parametersToReturn = "width: " . $configImagesize . "px; max-height: " . ($configImagesize + HC_Ppp_Helper_Config::PRODUCT_NAME_LINE_HEIGHT) . "px;";
        } else {
            $parametersToReturn = "width: " . $configImagesize . "px; max-height: " . $configImagesize . "px;";
        }

        return $parametersToReturn;
    }

    public function getLoaderLineHeight() {

        $parametersToReturn = "";
        
        $configImagesize = $this->getConfigImageSize();

        if ((bool) Mage::getStoreConfig('ppp/ppp_configuration/showproducttitle')) {
            $parametersToReturn = $configImagesize + HC_Ppp_Helper_Config::PRODUCT_NAME_LINE_HEIGHT . "px";
        } else {
            $parametersToReturn = $configImagesize . "px";
        }

        return $parametersToReturn;
    }


    public function getConfigImageSize() {

        $result = HC_Ppp_Helper_Config::DEFAULT_IMAGE_RESIZE_PARAM;
        $configImagesize = Mage::getStoreConfig('ppp/ppp_configuration/maximagesize');

        if (is_numeric($configImagesize))
             if($configImagesize>0)
            $result = $configImagesize;

        return $result;
    }
}