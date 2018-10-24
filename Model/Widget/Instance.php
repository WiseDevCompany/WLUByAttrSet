<?php

namespace Wise\WidgetLayoutUpdatesByAttributeSet\Model\Widget;

use Magento\Framework\Serialize\Serializer\Json;

class Instance extends \Magento\Widget\Model\Widget\Instance
{
    const ATTR_SET_LAYOUT_HANDLE = 'catalog_product_view_{{ID}}';
    /**
     * @var \Wise\WidgetLayoutUpdatesByAttributeSet\Model\ProductsByAttribute $productsByAttribute
     */
    protected $productsByAttribute;

    /**
     * Instance constructor.
     * @param \Wise\WidgetLayoutUpdatesByAttributeSet\Model\ProductsByAttribute $productsByAttribute
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Escaper $escaper
     * @param \Magento\Framework\View\FileSystem $viewFileSystem
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Catalog\Model\Product\Type $productType
     * @param \Magento\Widget\Model\Config\Reader $reader
     * @param \Magento\Widget\Model\Widget $widgetModel
     * @param \Magento\Widget\Model\NamespaceResolver $namespaceResolver
     * @param \Magento\Framework\Math\Random $mathRandom
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Widget\Helper\Conditions $conditionsHelper
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $relatedCacheTypes
     * @param array $data
     * @param Json|null $serializer
     */
    public function __construct(
        \Wise\WidgetLayoutUpdatesByAttributeSet\Model\ProductsByAttribute $productsByAttribute,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Escaper $escaper,
        \Magento\Framework\View\FileSystem $viewFileSystem,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Catalog\Model\Product\Type $productType,
        \Magento\Widget\Model\Config\Reader $reader,
        \Magento\Widget\Model\Widget $widgetModel,
        \Magento\Widget\Model\NamespaceResolver $namespaceResolver,
        \Magento\Framework\Math\Random $mathRandom,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Widget\Helper\Conditions $conditionsHelper,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $relatedCacheTypes = [],
        array $data = [],
        Json $serializer = null
    ) {
        $this->productsByAttribute = $productsByAttribute;
        parent::__construct(
            $context,
            $registry,
            $escaper,
            $viewFileSystem,
            $cacheTypeList,
            $productType,
            $reader,
            $widgetModel,
            $namespaceResolver,
            $mathRandom,
            $filesystem,
            $conditionsHelper,
            $resource,
            $resourceCollection,
            $relatedCacheTypes,
            $data,
            $serializer
        );
    }

    /**
     * Internal Constructor
     * Add attribute sets to layout handle
     * @return void
     */
    protected function _construct()
    {
        $attrSets = $this->productsByAttribute->setLayoutHandles();
        parent::_construct();
        foreach ($attrSets as $attrSetValue){
            $layoutHandle = str_replace('{{ID}}', 'attribute_set_id_' . $attrSetValue['value'], self::ATTR_SET_LAYOUT_HANDLE);
            $this->_layoutHandles['attribute_set_id_' . $attrSetValue['value']] = $layoutHandle;
        }
    }

    public function beforeSave()
    {
        parent::beforeSave();
    }
}
