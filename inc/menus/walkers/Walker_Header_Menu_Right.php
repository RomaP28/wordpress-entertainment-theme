<?php

namespace walkers;

class Walker_Header_Menu_Right extends \Walker
{
    public $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id',
    );

    private function _render_single_link(string &$output, $element){
        if(strpos($element->url, '/book-a-party/') !== false){
            $output .= '<a href="/book-a-party/" class="book-party">'.$element->post_title.'</a>';
        }elseif(strpos($element->url, '#reservations') !== false){
            $output .= '<a href="'.get_site_url().$element->url.'" class="btn"><span>'.$element->post_title.'</span> <img src="'.get_template_directory_uri().'/assets/img/chevron-down.svg" alt="chevron down"></a>';
        }else{
            $output .= '<a href="'.get_site_url().$element->url.'" class="link">'.$element->post_title.'</a>';
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
