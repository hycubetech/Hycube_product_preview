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
class HC_Ppp_Model_Configupdate extends Mage_Core_Model_Abstract {

      public function updateConfig($category, $toRm=false) {

        $reinit = false;
        
        $storeId = $category->getStoreId();
        $categoryId = $category->getId();
        $catsToRm = $category->getDeletedChildrenIds();
        $catsToRm[] = $categoryId;

        $configEntities = Mage::getResourceModel('ppp/configupdate')->getConfigEntities($toRm);

        if (!empty($configEntities)) {

            foreach ($configEntities as $entity) {

                   if ($toRm) {

                    $catIdFromEntity = explode(',', $entity['value']);
                    $newCatForEntity = array_diff($catIdFromEntity, $catsToRm);

                    if ($newCatForEntity !== $catIdFromEntity) {
                        $stringToSend = implode(',', $newCatForEntity);
                        $this->_updateConfig($stringToSend, (int) $entity['scope_id'], $entity['scope']);
                        $reinit = true;
                    }
                } else {

                    if (!array_key_exists('yn', $entity) && $entity['scope'] != 'websites') {

                        $entity['yn'] = $this->_getParentValue($configEntities, $entity);
                    }

                if (!array_key_exists('cat', $entity))  $categoryId =  $entity['defcat'] . ',' . $categoryId;

                    if ($entity['yn'] == HC_Ppp_Helper_Config::YES && ( $storeId == $entity['scope_id'] || $storeId == 0 ) && $entity['scope'] != 'websites') {

                        $this->_addToConfig($categoryId, (int) $entity['scope_id'], $entity['scope']);
                        $reinit = true;
                    }
                }
            }

            if ($reinit) {

                Mage::getConfig()->reinit();
                Mage::app()->reinitStores();
            }
        }
    }

    private function _getParentValue($configEntities, $_entity) {

        $valueToReturn = $_entity['defyn'];

        foreach ($configEntities as $entity) {

            if ($entity['scope'] == 'websites') {

                $storeCodes = Mage::app()->getWebsite($entity['scope_id'])->getStoreIds();

                if (in_array($_entity['scope_id'], $storeCodes) && array_key_exists('yn', $entity) ) {

                    $valueToReturn = $entity['yn'];
                    continue;
                }
            }
        }
        return $valueToReturn;
    }

    private function _addToConfig($categoryId, $scopeId, $scope) {

        $configProductCatIds = (string) Mage::getConfig()->getNode('ppp/ppp_configuration/categories', $scope, $scopeId);

        $idsFromConfig = explode(",", $configProductCatIds);
        if (!in_array($categoryId, $idsFromConfig)) {

            $configProductCatIds = $configProductCatIds . "," . $categoryId;

            Mage::getConfig()->saveConfig('ppp/ppp_configuration/categories', $configProductCatIds, $scope, $scopeId);
        }
    }

    private function _updateConfig($configProductCatIds, $scopeId, $scope) {
        Mage::getConfig()->saveConfig('ppp/ppp_configuration/categories', $configProductCatIds, $scope, $scopeId); 
    }
}