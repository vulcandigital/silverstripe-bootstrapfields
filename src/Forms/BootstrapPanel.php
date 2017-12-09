<?php

namespace Vulcan\BootstrapFields\Forms;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormField;

/**
 * Class BootstrapPanel
 * @package Vulcan\BootstrapFields\Forms
 */
class BootstrapPanel extends FormField
{
    /** @var FieldList */
    protected $children;

    /** @var string */
    protected $panelTitle;

    /** @var string */
    protected $description = '';

    /** @var bool */
    protected $accordion = false;

    /** @var bool */
    protected $accordionState = false;

    /** @var bool */
    protected $accordionLocked = false;

    /**
     * BootstrapPanel constructor.
     *
     * @param string         $title
     * @param null|FieldList $children
     * @param null|string    $description
     */
    public function __construct($title, $children = null, $description = null)
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

        if ($description) {
            $this->setPanelDescription($description);
        }

        $this->panelTitle = $title;

        parent::__construct(null, false);
    }

    /**
     * @param array $properties
     *
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function Field($properties = [])
    {
        return $this->renderWith(static::class, [
            'Title'           => $this->panelTitle,
            'Description'     => $this->description,
            'Accordion'       => $this->accordion,
            'AccordionState'  => $this->accordionState,
            'AccordionLocked' => $this->accordionLocked,
        ]);
    }

    /**
     * @param bool $bool
     *
     * @return $this
     */
    public function setAccordion($bool = false)
    {
        $this->accordion = $bool;

        return $this;
    }

    public function setAccordionState($bool = false)
    {
        $this->accordionState = $bool;

        return $this;
    }

    public function FieldList()
    {
        return $this->children;
    }

    public function getName()
    {
        return sha1(md5(time() - rand(500, 5000000)));
    }

    /**
     * @param string $description
     *
     * @return string
     */
    public function setPanelDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setAccordionLocked($bool = false)
    {
        $this->accordionLocked = $bool;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPanelDescription()
    {
        return $this->description;
    }

    public function isComposite()
    {
        return true;
    }
}