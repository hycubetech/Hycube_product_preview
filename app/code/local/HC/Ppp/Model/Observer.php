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
class HC_Ppp_Model_Observer extends Mage_Core_Model_Abstract {

    public function categorySaved($observer) {

        $category = $observer->getEvent()->getCategory();

        Mage::getModel('ppp/configupdate')->updateConfig($category);
    }

    public function categoryDeleted($observer) {

        $category = $observer->getEvent()->getCategory();
        $remove = true;

        Mage::getModel('ppp/configupdate')->updateConfig($category, $remove);
    }

}
