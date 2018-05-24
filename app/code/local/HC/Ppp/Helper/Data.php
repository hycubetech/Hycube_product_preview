<?php

/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/HC-LICENSE-COMMUNITY.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This package designed for Magento COMMUNITY edition
 * aheadWorks does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * aheadWorks does not provide extension support in case of
 * incorrect edition usage.
 * =================================================================
 *
 * @category   HC
 * @package    HC_Ppp
 * @copyright  Copyright (c) 2010-2011 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/HC-LICENSE-COMMUNITY.txt
 */
class HC_Ppp_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function extensionEnabled($extension_name)
    {
        if (!isset($this->extensionEnabled[$extension_name])) {
            $modules = (array)Mage::getConfig()->getNode('modules')->children();
            if (!isset($modules[$extension_name])
                || $modules[$extension_name]->descend('active')->asArray() == 'false'
                || Mage::getStoreConfig('advanced/modules_disable_output/' . $extension_name)
            ) $this->extensionEnabled[$extension_name] = false;
            else $this->extensionEnabled[$extension_name] = true;
        }
        return $this->extensionEnabled[$extension_name];
    }
}