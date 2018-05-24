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
class HC_Ppp_Block_System_Entity_Form_Element_Tree_RenderCheck extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Categories {

    protected $_selectedIds = array();

    public function __construct() {
        parent::__construct();
        $this->setTemplate('hc_ppp/form/element/render/newTree.phtml');
    }

    protected function _prepareLayout() {
        parent::_prepareLayout();
    }

    public function getCategoryIds() {
        return $this->_selectedIds;
    }

    public function setCategoryIds($ids) {
        if (empty($ids)) {
            $ids = array();
        } elseif (!is_array($ids)) {
            $ids = array((int) $ids);
        }
        $this->_selectedIds = $ids;
        return $this;
    }

    public function getLoadTreeUrl($expanded=null) {
        $params = array('_current' => true, 'id' => null, 'store' => null);
        if (
                (is_null($expanded) && Mage::getSingleton('admin/session')->getIsTreeWasExpanded())
                || $expanded == true) {
            $params['expand_all'] = true;
        }
        return $this->getUrl('adminhtml/catalog_product/categoriesJson', $params);
    }

    protected function _getNodeJson($node, $level = 1) {
        $item = array();
        $item['text'] = $this->htmlEscape($node->getName());

        if ($this->_withProductCount) {
            $item['text'].= ' (' . $node->getProductCount() . ')';
        }
        $item['id'] = $node->getId();
        $item['path'] = $node->getData('path');
        $item['cls'] = 'folder ' . ($node->getIsActive() ? 'active-category' : 'no-active-category');
        $item['allowDrop'] = false;
        $item['allowDrag'] = false;

        if ($node->hasChildren()) {
            $item['children'] = array();
            foreach ($node->getChildren() as $child) {
                $item['children'][] = $this->_getNodeJson($child, $level + 1);
            }
        }

        if (empty($item['children']) && (int) $node->getChildrenCount() > 0) {
            $item['children'] = array();
        }

        if (!empty($item['children'])) {
            $item['expanded'] = true;
        }

        if (in_array($node->getId(), $this->getCategoryIds())) {
            $item['checked'] = true;
        }
        return $item;
    }

    public function getRoot($parentNodeCategory=null, $recursionLevel=3) {
        return $this->getRootByIds($this->getCategoryIds());
    }

}

