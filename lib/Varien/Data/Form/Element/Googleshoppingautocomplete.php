<?php

/**
 * @project gastrodax
 *
 * @author pbreitsprecher
 * @copyright 2017
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 *
 * @last_modified 02.02.17 16:41
 * @file Googleshoppingautocomplete.php
 *
 */
class Varien_Data_Form_Element_Googleshoppingautocomplete extends Varien_Data_Form_Element_Abstract
{
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->setType('text');
        $this->setExtType('textfield');
        $this->_renderer = null; // disable renderer
    }

    public function getAfterElementHtml()
    {
        return '
            <div id="gs_category_autocomplete" class="autocomplete"></div>
            <script type="text/javascript">
                new Ajax.Autocompleter(
                    \'' . $this->getHtmlId() . '\',
                    \'gs_category_autocomplete\',
                    \'' . Mage::getUrl('adminhtml/googleShoppingApi_taxonomy/search', array(
            'store' => (int)Mage::app()->getRequest()->getParam('store', 0),
        )) . '\',
                    {
                        paramName:\'query\',
                        minChars:2,
                        indicator:\'gs_search_indicator\',
                        updateElement:function (li) { $(\'google_shopping_category\').value = li.readAttribute(\'value\'); },
                        evalJSON:\'force\'
                    }
                );
            </script>
            ' . $this->getData('after_element_html');
    }

    public function getElementHtml()
    {
        return parent::getElementHtml() . '<span id="gs_search_indicator"
        class="autocomplete-indicator" style="display: none"> <img src="' .
        Mage::getDesign()->getSkinUrl('images/ajax-loader.gif')
        . '" alt="Loading..." class="v-middle"/></span>';
    }

    public function getHtml()
    {
        $this->addClass('input-text gs-autocomplete');
        return parent::getHtml();
    }
}