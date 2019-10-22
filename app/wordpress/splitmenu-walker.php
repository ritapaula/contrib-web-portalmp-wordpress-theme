<?php

namespace UVigoThemeWPApp;

use Walker_Nav_Menu;
use DOMDocument;

class UVigoSplitMenuWalker extends Walker_Nav_Menu
{
    private $split_at;
    private $button;
    private $count = 0;
    private $wrappedOutput;
    private $replaceTarget;
    private $wrapped = false;
    private $toSplit = false;

    public function __construct($split_at = 4, $button = '<button class="menu-item-open" data-icon="L"><span class="sr-only" aria-hidden="true">More</span></button>')
    {
        $this->split_at = $split_at;
        $this->button = $button;
    }

    public function walk($elements, $max_depth)
    {
        $args = array_slice(func_get_args(), 2);
        $output = parent::walk($elements, $max_depth, reset($args));
        return $this->toSplit ? $output.'</ul></li>' : $output;
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        $this->count += $depth === 0 ? 1 : 0;
        parent::start_el($output, $item, $depth, $args, $id);
        if (($this->count === $this->split_at) && ! $this->wrapped) {
            // split at number has been reached generate and store wrapped output
            $this->wrapped = true;
            $this->replaceTarget = $output;
            $this->wrappedOutput = $this->wrappedOutput($output);
        } elseif (($this->count === $this->split_at + 1) && ! $this->toSplit) {
            // split at number has been exceeded, replace regular with wrapped output
            $this->toSplit = true;
            $output = str_replace($this->replaceTarget, $this->wrappedOutput, $output);
        }
    }

    private function wrappedOutput($output)
    {
        $dom = new DOMDocument;
        $dom->loadHTML($output.'</li>');
        $lis = $dom->getElementsByTagName('li');
        $last = trim(substr($dom->saveHTML($lis->item($lis->length-1)), 0, -5));
        // remove last li
        $wrappedOutput = substr(trim($output), 0, -1 * strlen($last));
        $classes = array(
          'menu-item',
          'menu-item-type-custom',
          'menu-item-object-custom',
          'menu-item-has-children',
          'menu-item-split-wrapper'
        );
        // add wrap li element
        $wrappedOutput .= '<li class="'.implode(' ', $classes).'">';
        // add the "more" link
        $wrappedOutput .= $this->button;
        // add the last item wrapped in a submenu and return
        return $wrappedOutput . '<ul class="sub-menu">'. $last;
    }
}
