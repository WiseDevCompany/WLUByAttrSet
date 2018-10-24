<?php

namespace Wise\WidgetLayoutUpdatesByAttributeSet\Plugin;

use \Magento\Framework\View\Result\Page;

class PageLayoutHandlesPlugin
{
    /**
     * @param \Magento\Catalog\Helper\Product\View $subject
     * @param Page $resultPage
     * @param $product
     * @param null $params
     */
    public function beforeInitProductLayout(
        \Magento\Catalog\Helper\Product\View $subject,
        Page $resultPage,
        $product,
        $params = null
    ) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $isShowGuideLinkEnable = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('wiselayoutupdates/general/enable');
        if($isShowGuideLinkEnable) $resultPage->addPageLayoutHandles(['attribute_set_id' => $product->getAttributeSetId()], null, false);
    }
}