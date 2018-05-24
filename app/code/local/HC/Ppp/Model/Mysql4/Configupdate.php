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
class HC_Ppp_Model_Mysql4_Configupdate extends Mage_Core_Model_Mysql4_Config {
  
    public function getConfigEntities($toRm) {

        $resultToReturn = array();
        $enablefornewcat_rows = array();
        $categories_rows = array();
        $enablefornewcat_defvalue = array();
        $categories_defvalue = array();
        $enablefornewcat_cond = "path='ppp/ppp_configuration/enablefornewcat'";
        $categories_cond = "path='ppp/ppp_configuration/categories'";
        $defvalue_cond = "path='ppp/ppp_configuration/enablefornewcat' AND scope='default'";
        $defcat_cond = "path='ppp/ppp_configuration/categories' AND scope='default'";

        try {
            $read = $this->_getReadAdapter();

            $categories_rows = $read->fetchAll("select scope, scope_id, path, value from " . $this->getMainTable() . ($categories_cond ? ' where ' . $categories_cond : ''));
            if ($toRm) return $categories_rows;

            $enablefornewcat_rows = $read->fetchAll("select scope, scope_id, path, value from " . $this->getMainTable() . ($enablefornewcat_cond ? ' where ' . $enablefornewcat_cond : ''));           
            $enablefornewcat_defvalue = $read->fetchAll("select  value from " . $this->getMainTable() . ($defvalue_cond ? ' where ' . $defvalue_cond : ''));
            $categories_defvalue = $read->fetchAll("select  value from " . $this->getMainTable() . ($defcat_cond ? ' where ' . $defcat_cond : ''));
        } catch (Exception $e) {

            Mage::log("Exception here: " . __CLASS__ . " on line " . __LINE__ . "</b>");
            Mage::log(var_export($e->getMessage(), true));
        }

        if (!empty($enablefornewcat_rows) && !empty($categories_rows) && !empty($enablefornewcat_defvalue) && !empty($categories_defvalue)) {

            $results = array_merge_recursive($enablefornewcat_rows, $categories_rows);

            foreach ($results as $resValue) {

                $_key = $resValue['scope'] . '_' . $resValue['scope_id'];

                if (!array_key_exists($_key, $resultToReturn))
                    $resultToReturn[$_key] = array(
                        'scope' => $resValue['scope'],
                        'scope_id' => $resValue['scope_id'],
                        'defyn' => $enablefornewcat_defvalue[0]['value'],
                        'defcat' => $categories_defvalue[0]['value']
                    );

                if ($resValue['path'] == 'ppp/ppp_configuration/enablefornewcat')
                    $resultToReturn[$_key]['yn'] = $resValue['value'];

                if ($resValue['path'] == 'ppp/ppp_configuration/categories')
                    $resultToReturn[$_key]['cat'] = $resValue['value'];
            }
            ksort($resultToReturn);
        }
        return $resultToReturn;
    }

}