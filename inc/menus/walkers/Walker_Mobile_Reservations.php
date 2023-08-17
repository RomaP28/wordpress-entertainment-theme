<?php

namespace walkers;

class Walker_Mobile_Reservations extends \Walker
{

    const RIGHT = '#right';

    public $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id',
    );

    private function _render_single_link(string &$output, $element){
        $output .= '<a href="'.$element->url.'" class="link">'.$element->post_title.'</a>';
    }

    public function walk( $elements, $max_depth, ...$args ) {
        $output = '';

        $children_elements = [];

        foreach ($elements as $id => $e){
            if(intval($e->menu_item_parent) === 0) continue;
            $children_elements[intval($e->menu_item_parent)][$id] = $e;
        }

        foreach ($elements as $e){
            if(intval($e->menu_item_parent) !== 0) continue;
                $this->_render_single_link($output, $e);
        }

        return $output;
    }
}
