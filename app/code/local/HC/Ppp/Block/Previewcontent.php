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
class HC_Ppp_Block_Previewcontent extends Mage_Core_Block_Template {

    public function getContainerSize() {

        $configImagesize = $this->getConfigImageSize();

        $parametersToReturn = "";

            if ((bool) Mage::getStoreConfig('ppp/ppp_configuration/showproducttitle')) {
                $parametersToReturn = "max-width: " . $configImagesize . "px; max-height: " . ($configImagesize + HC_Ppp_Helper_Config::PRODUCT_NAME_LINE_HEIGHT) . "px;";
            } else {
                $parametersToReturn = "max-width: " . $configImagesize . "px; max-height: " . $configImagesize . "px;";
            }
        return $parametersToReturn;
    }

     public function getImageLineHeight() {

        $result = HC_Ppp_Helper_Config::DEFAULT_IMAGE_RESIZE_PARAM;

        $configImagesize = Mage::getStoreConfig('ppp/ppp_configuration/maximagesize');

        if (is_numeric($configImagesize)) {
            if($configImagesize>0)
               $result = $configImagesize;
        }
        return $result;

    }

    public function displayTitle() {

        $displayTitle = (bool) Mage::getStoreConfig('ppp/ppp_configuration/showproducttitle');
        $res = "display:none;";

        if ($displayTitle) {
            $res = "";
        }

        return $res;
    }

       public function getConfigImageSize() {

        $result = HC_Ppp_Helper_Config::DEFAULT_IMAGE_RESIZE_PARAM;

        $configImagesize = Mage::getStoreConfig('ppp/ppp_configuration/maximagesize');

        if (is_numeric($configImagesize)) {
            if($configImagesize>0)
               $result = $configImagesize;
        }
        return $result;
    }
}