<?php

namespace Wise\WidgetLayoutUpdatesByAttributeSet\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Catalog\Model\Product\AttributeSet\Options;

class ProductsByAttribute
{
    /**
     * @var ProductRepositoryInterface $_productRepository
     */
    protected $_productRepository;

    /**
     * @var SearchCriteriaInterface $_searchCriteria
     */
    protected $_searchCriteria;

    /**
     * @var Filter $_filter
     */
    protected $_filter;

    /**
     * @var FilterGroup $_filterGroup
     */
    protected $_filterGroup;

    /**
     * @var Options $_attrOptions
     */
    protected $_attrOptions;

    public $_products;

    /**
     * ProductsByAttribute constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaInterface $searchCriteria
     * @param FilterGroup $filterGroup
     * @param Filter $filter
     * @param Options $attrOptions
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaInterface $searchCriteria,
        FilterGroup $filterGroup,
        Filter $filter,
        Options $attrOptions
    ) {
        $this->_productRepository = $productRepository;
        $this->_searchCriteria = $searchCriteria;
        $this->_filterGroup = $filterGroup;
        $this->_filter = $filter;
        $this->_attrOptions = $attrOptions;
    }

    /**
     * @param $id
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     */
    public function getProductsByAttributeSetId($id)
    {
        $filter = $this->_filter
            ->setField('attribute_set_id')
            ->setValue($id)
            ->setConditionType('eq');
        $filterGroup = $this->_filterGroup->setFilters([$filter]);
        $search = $this->_searchCriteria->setFilterGroups([$filterGroup]);
        $this->_products = $this->_productRepository->getList($search);
        return $this->_products;
    }


    /**
     * @return array|null
     */
    private function getAttrSets()
    {
        return $this->_attrOptions->toOptionArray();
    }

    /**
     * @return array|null
     */
    public function formatAttrSets()
    {
        $attrSets = $this->getAttrSets();
        $attrSetsData = [];
        foreach ($attrSets as $set){
            $attrSetsData[] = ['value' => 'attribute_set_id_' . $set['value'], 'label' => $this->escapeHtmlAttr(__(strtoupper($set['label'])))];
        }
        return $attrSetsData;
    }

    public function getAllProductsByAttrSet($id)
    {
        $items = $this->getProductsByAttributeSetId($id)->getItems();
        return $items;
    }

    /**
     * @param $string
     * @return string
     */
    protected function escapeHtmlAttr($string)
    {
        return htmlspecialchars($string, ENT_COMPAT, 'UTF-8', false);
    }

    public function setLayoutHandles()
    {
        $attrSets = $this->getAttrSets();
        return $attrSets;
    }
}