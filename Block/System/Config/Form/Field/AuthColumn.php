<?php

declare(strict_types=1);

namespace Nazmul\Mail\Block\System\Config\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class AuthColumn extends Select

{

    /**
     * Set "name" for <select> element
     *
     * @param string $value
     * @return $this
     */

    public function setInputName($value)

    {
        return $this->setName($value);
    }


    /**
     * Set "id" for <select> element
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

    public function _toHtml(): string

    {

        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }

        return parent::_toHtml();

    }
    private function getSourceOptions(): array

    {
        return [

            ['label' => 'No', 'value' => '0'],
            ['label' => 'Plain', 'value' => 'plain'],
            ['label' => 'Login', 'value' => 'login'],
            ['label' => 'Crammd 5', 'value' => 'crammd5'],
        ];

    }

}
