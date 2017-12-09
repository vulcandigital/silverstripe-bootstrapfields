<?php

namespace Vulcan\BootstrapFields\Extensions;

use SilverStripe\Core\Extension;

/**
 * Class UpdateFormFieldsExtension
 * @package Vulcan\BootstrapFields\Extensions
 */
class UpdateFormFieldsExtension extends Extension
{
    public function updateAttributes(&$attributes)
    {
        $classes = $attributes['class'];

        if (strstr($classes, 'hidden') || strstr($classes, 'optionset') || strstr($classes, 'grid-field') || strstr($classes, 'checkbox')) {
            return;
        }

        if (isset($attributes['name']) && !strstr($attributes['name'], 'action_')) {
            $attributes['class'] = $classes . " form-control";
        } else {
            $attributes['class'] = $classes . " btn btn-primary";
        }
    }
}