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
class HC_Ppp_Block_System_Entity_Form_Element_Tree extends Varien_Data_Form_Element_Select {

    /**
     * Retrives element's html
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function getElementHtml() {
        $select = new HC_Ppp_Block_System_Entity_Form_Element_Tree_RenderCheck();
        if ($this->getValue()) {
            $selected = explode(',', $this->getValue());
            for ($i = 0; $i <= count($selected); $i++) {
                if ($selected[$i] == '')
                    unset($selected[$i]);
            }
            $select->setCategoryIds($selected);
        }


        if (Mage::registry('current_product')) {
            $select->setData('name', 'product[' . $select->getName() . ']');
        }

        $html = '';
        $html .= $select->toHtml();

        $html.= $this->getAfterElementHtml();
        return $html;
    }

}