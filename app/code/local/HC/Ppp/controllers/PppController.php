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
class HC_Ppp_PppController extends Mage_Core_Controller_Front_Action
{

    public function previewAction()
    {
        $id = $this->getRequest()->getParam('id');
        $preview = Mage::getModel('ppp/productpreview')->getPreviewByProductId($id);
        $htmlBlock = $this->getLayout()
            ->createBlock('ppp/previewcontent', '', array(
            'product_name' => $preview['productName'],
            'product_image_url' => $preview['imageUrl'],
        ))
            ->setTemplate('ppp/previewcontent.phtml')
            ->toHtml();
        return $this->getResponse()->setBody($htmlBlock);
    }
}