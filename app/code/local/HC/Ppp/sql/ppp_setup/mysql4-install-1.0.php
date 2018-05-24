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
$installer = $this;

$installer->startSetup();

try {

    $mediaBaseDir = Mage::getBaseDir('media') . DS . 'hc_ppp' . DS . 'default';
    $sourceImageFile = Mage::getBaseDir('skin') . DS . 'adminhtml' . DS . 'default' . DS . 'default' . DS . 'hc_ppp' . DS . 'images' . DS . 'hc_ppp_loader.gif';

    $destImageFile = $mediaBaseDir . DS . 'hc_ppp_loader.gif';

    mkdir($mediaBaseDir, 0777, true);
    copy($sourceImageFile, $destImageFile);
} catch (Exception $e) {
    Mage::log($e->getTrace());
}
try {

    $stmt = $installer->getConnection()->select()
                    ->from($installer->getTable('core_config_data'))
                    ->where("path = 'ppp/ppp_configuration/image'");

    $result = $installer->getConnection()->fetchAll($stmt);

    if (empty($result)) {

        $installer->setConfigData('ppp/ppp_configuration/image', 'default/hc_ppp_loader.gif');
        $installer->setConfigData('ppp/ppp_configuration/categories', '');
        $installer->setConfigData('ppp/ppp_configuration/enablefornewcat', '0');
        $installer->setConfigData('ppp/ppp_configuration/showproducttitle', '0');
        $installer->setConfigData('ppp/ppp_configuration/maximagesize', '300');
        $installer->setConfigData('ppp/ppp_configuration/delaybeforedisplay', '500');
    }
} catch (Exception $e) {
    Mage::log($e->getTrace());
}

$installer->endSetup();
