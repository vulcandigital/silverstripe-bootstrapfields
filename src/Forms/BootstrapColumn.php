<?php

namespace Vulcan\BootstrapFields\Forms;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormField;

class BootstrapColumn extends FormField
{
    protected $classes;

    protected $children;

    public function __construct($classes, $children = null)
    {
        if ($children instanceof FieldList) {
            $this->children = $children;
        } else {
            if (is_array($children)) {
                $this->children = new FieldList($children);
            } else {
                //filter out null/empty items
                $children = array_filter(func_get_args());
                $this->children = new FieldList($children);
            }
        }
        $this->children->setContainerField($this);
        $this->addExtraClass($classes);

        parent::__construct(null, false);
    }

    public function Field($properties = [])
    {
        return $this->renderWith(static::class);
    }

    public function FieldList()
    {
        return $this->children;
    }

    public function isComposite()
    {
        return true;
    }
}