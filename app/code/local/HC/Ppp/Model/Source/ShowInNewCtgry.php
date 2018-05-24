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
class HC_Ppp_Model_Source_ShowInNewCtgry {

    public function toOptionArray() {
        return array(
            array(
                'value' => HC_Ppp_Helper_Config::YES,
                'label' => Mage::helper('ppp')->__('Yes')
            ),
            array(
                'value' => HC_Ppp_Helper_Config::NO,
                'label' => Mage::helper('ppp')->__('No')
        ));
    }

}