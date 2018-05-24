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
class HC_Ppp_Adminhtml_TreeController extends Mage_Adminhtml_Controller_Action
{
    const DEFAULT_ACTION_NAME = 'getCatChildrens';
    const RESOURCE_NAME = 'admin/system/config/ppp';

    public function getCatChildrensAction($id = null)
    {
        $category = $this->getRequest()->getParam('category');
        $childrens = '';

        if ($category) {
            $childCategories = Mage::getModel('catalog/category')->getCategories($category);
            foreach ($childCategories as $category) {
                $childrens .= $category->getEntityId() . ',';
            }
            $childrens = substr($childrens, 0, -1);
        }

        $this->getResponse()->setBody($childrens);
    }

    protected function _isAllowed()
    {
        $isAllowed = false;
        $actionName = $this->getRequest()->getActionName();
        if ($actionName == self::DEFAULT_ACTION_NAME) {
            $isAllowed = Mage::getSingleton('admin/session')->isAllowed(self::RESOURCE_NAME);
        }
        return $isAllowed;
    }
}
