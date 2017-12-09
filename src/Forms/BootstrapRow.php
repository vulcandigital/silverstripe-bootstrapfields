<?php

namespace Vulcan\BootstrapFields\Forms;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormField;
use SilverStripe\Security\RandomGenerator;

/**
 * Class BootstrapRow
 *
 * @package Vulcan\BootstrapFields\Forms
 */
class BootstrapRow extends FormField
{
    /** @var FieldList */
    protected $children;

    /**
     * BootstrapRow constructor.
     *
     * @param null $children
     */
    public function __construct($children = null)
    {
        if ($children instanceof FieldList) {
            $this->children = $children;
        } else if (is_array($children)) {
            $this->children = new FieldList($children);
        } else {
            //filter out null/empty items
            $children = array_filter(func_get_args());
            $this->children = new FieldList($children);
        }
        $this->children->setContainerField($this);

        parent::__construct(null, false);
    }

    /**
     * @param array $properties
     *
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function Field($properties = [])
    {
        return $this->renderWith(static::class);
    }

    /**
     * @return FieldList
     */
    public function FieldList()
    {
        return $this->children;
    }

    /**
     * @return string
     */
    public function getName()
    {
        $generator = new RandomGenerator();
        $result = $generator->randomToken('sha1');
        return $result;
    }

    public function isComposite()
    {
        return true;
    }
}