<?php

namespace walkers;

class Walker_Footer_Menu extends \Walker
{
    public $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id',
    );

    private function _render_single_link(string &$output, $element){
        if (str_contains($element->url, 'http')) {
            $output .= '<a target="_blank" rel="noopener" href="'.$element->url.'">'.$element->post_title.'</a>';
        } else {
            $output .= '<a href="'.get_site_url().$element->url.'">'.$element->post_title.'</a>';
        }
    }

    public function walk( $elements, $max_depth, ...$args ) {
        $output = '';

        foreach ($elements as $e){
            if(intval($e->menu_item_parent) !== 0) continue;

            $this->_render_single_link($output, $e);
        }

        return $output;
    }
}
