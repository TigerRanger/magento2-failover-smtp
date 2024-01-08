<?php
namespace Nazmul\Mail\Block\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;


class SMTP extends AbstractFieldArray
{


    protected $_AuthRenderer;

    protected $_SSLRenderer;

    protected $_PassRenderer;

    /**
     * @inheritDoc
     */
    protected function _prepareToRender()
    {
        $this->addColumn('smtp', ['label' => __('SMTP'),'class' => 'required-entry' , 'type'=>'text',
        ]);
        $this->addColumn('port', ['label' => __('port'),'class' => 'required-entry' , 'type'=>'number']);
        $this->addColumn('auth', ['label' => __('Auth'), 'type'=>'select' ,'id'=>'auth',
            'renderer' => $this->getAuthRenderer(),
            ]);
        $this->addColumn('user', ['label' => __('User'), 'type'=>'text']);
        $this->addColumn('password', ['label' => __('Password'), 'type'=>'password',
            'renderer' => $this->getPassRenderer()
            ]);
        $this->addColumn('ssl', ['label' => __('SSL Type') , 'type'=>'select',
        'renderer' => $this->getSslRenderer()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add SMTP');
    }

    protected function getPassRenderer() {
        if (!$this->_PassRenderer) {
            $this->_PassRenderer = $this->getLayout()->createBlock(
                'Nazmul\Mail\Block\System\Config\Form\Field\Password', '', ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->_PassRenderer;
    }

    protected function getAuthRenderer() {
        if (!$this->_AuthRenderer) {
            $this->_AuthRenderer = $this->getLayout()->createBlock(
                'Nazmul\Mail\Block\System\Config\Form\Field\AuthColumn', '', ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->_AuthRenderer;
    }


    protected function getSslRenderer() {
        if (!$this->_SSLRenderer) {
            $this->_SSLRenderer = $this->getLayout()->createBlock(
                'Nazmul\Mail\Block\System\Config\Form\Field\SSLColumn', '', ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->_SSLRenderer;
    }



    protected function _prepareArrayRow(\Magento\Framework\DataObject $row) {
        $options = [];
        $Auth = $row->getAuth();
        if ($Auth) {
            $options['option_' . $this->getAuthRenderer()->calcOptionHash($Auth)] = 'selected="selected"';
        }
        $SSL = $row->getSsl();

        if ($SSL) {
            $options['option_' . $this->getSslRenderer()->calcOptionHash($SSL)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }

}
