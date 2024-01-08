<?php

namespace Nazmul\Mail\Block\System\Config\Form\Field;



class Password  extends \Magento\Framework\View\Element\AbstractBlock

{
    /**
     * Set "name" for <input> element
     *
     * @param string $value
     * @return $this
     */

    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <input> element
     *
     * @param $value
     * @return $this
     */

    public function setInputId($value)

    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */

    protected function _toHtml()
    {
      return '<input type="password" name="' . $this->getName() . '" id="' . $this->getId() . '" class="input-password" />';

    }

}
