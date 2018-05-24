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
class HC_Ppp_Block_System_Config_Form_Element_Tree extends Mage_Adminhtml_Block_System_Config_Form_Field
{
     /**
     * Change field renderer
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $newElement = new HC_Ppp_Block_System_Entity_Form_Element_Tree($element->getData());
        return $newElement->getElementHtml();
    }

}

