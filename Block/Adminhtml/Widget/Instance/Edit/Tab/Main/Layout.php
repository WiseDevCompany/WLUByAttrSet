<?php
namespace Wise\WidgetLayoutUpdatesByAttributeSet\Block\Adminhtml\Widget\Instance\Edit\Tab\Main;

use Magento\Widget\Block\Adminhtml\Widget\Instance\Edit\Tab\Main\Layout as MagentoLayout;

/**
 * Widget Instance page groups (predefined layouts group) to display on
 *
 * @method \Wise\WidgetLayoutUpdatesByAttributeSet\Model\Widget\Instance getWidgetInstance()
 */
class Layout extends MagentoLayout
{
    /**
     * @var string
     */
    protected $_template = 'instance/edit/layout.phtml';

    /**
     * @var \Wise\WidgetLayoutUpdatesByAttributeSet\Model\ProductsByAttribute
     */
    protected $_productsByAttribute;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Catalog\Model\Product\Type $productType
     * @param \Wise\WidgetLayoutUpdatesByAttributeSet\Model\ProductsByAttribute $productsByAttribute
     * @param array $data
     * @param \Magento\Framework\Serialize\Serializer\Json|null $serializer
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\Product\Type $productType,
        \Wise\WidgetLayoutUpdatesByAttributeSet\Model\ProductsByAttribute $productsByAttribute,
        array $data = [],
        \Magento\Framework\Serialize\Serializer\Json $serializer = null
    )
    {
        parent::__construct($context, $productType, $data, $serializer);
        $this->_productsByAttribute = $productsByAttribute;
    }

    /**
     * Retrieve Display On options array.
     * Add attribute sets to layout
     * @return array
     */
    protected function _getDisplayOnOptions()
    {
        $attrSets = $this->_productsByAttribute->formatAttrSets();
        $options = parent::_getDisplayOnOptions();
        $options[] = [
            'label' => $this->escapeHtmlAttr(__('Attribute sets')),
            'value' => $attrSets,
        ];

        return $options;
    }

    /**
     * Generate array of parameters for every container type to create html template
     * Add attribute sets to container
     * @return array
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function getDisplayOnContainers()
    {
        $container = parent::getDisplayOnContainers();
        $attrSets = $this->_productsByAttribute->formatAttrSets();
        foreach ($attrSets as $attrSetValue) {
            $container[$attrSetValue['value']] = [
                'label' => $attrSetValue['label'],
                'code' => 'products',
                'name' => $attrSetValue['value'],
                'layout_handle' => str_replace(
                    '{{ID}}',
                    $attrSetValue['value'],
                    \Wise\WidgetLayoutUpdatesByAttributeSet\Model\Widget\Instance::ATTR_SET_LAYOUT_HANDLE
                ),
                'is_anchor_only' => '',
                'product_type_id' => '',
            ];
        }

        return $container;
    }
}
