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
class HC_Ppp_Model_Productpreview extends Mage_Catalog_Model_Product
{

    public function getPreviewByProductId($productId)
    {
        $this->load($productId);
        $productName = $this->getName();
        $configImageSize = Mage::getStoreConfig('ppp/ppp_configuration/maximagesize') ? Mage::getStoreConfig('ppp/ppp_configuration/maximagesize') : HC_Ppp_Helper_Config::DEFAULT_IMAGE_RESIZE_PARAM;
        $productImageUrl = Mage::helper('catalog/image')
            ->init($this, 'image')
            ->constrainOnly(true)
            ->keepAspectRatio(true)
            ->keepFrame(false);
        $productImageUrl = (string)$productImageUrl->resize($configImageSize, $configImageSize);
        return array(
            'imageUrl' => $productImageUrl,
            'productName' => $productName,
        );
    }
}