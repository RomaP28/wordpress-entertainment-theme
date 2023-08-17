<?php

namespace walkers;

class Walker_Footer_Mobile_Menu extends \Walker
{
    public $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id',
    );

    private function _start_main_elem(string &$output) : void
    {
        $output .= '<div class="mobile">';
    }

    private function _render_single_link(string &$output, $element){
        $output .= '<a href="'.get_site_url().$element->url.'">'.$element->post_title.'</a>';
    }

    private function _end_main_elem(string &$output) : void
    {
        $output .= '</div>';
    }

    public function walk( $elements, $max_depth, ...$args ) {
        $output = '';

        $this->_start_main_elem($output);

        foreach ($elements as $e){
            if(intval($e->menu_item_parent) !== 0) continue;
            $this->_render_single_link($output, $e);
        }

        $this->_end_main_elem($output);

        return $output;
    }
}
