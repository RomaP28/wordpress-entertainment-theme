<?php

namespace walkers;

class Walker_Header_Mobile_Menu extends \Walker
{

    const RIGHT = '#right';

    public $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id',
    );

    private function _render_children_elements(string &$output, $elements, $args){
        $output .= '<div class="'.$args[0]->menu_class.'">';
        foreach ($elements as $e){
            $output .= '<a href="'.get_site_url().$e->url.'" class="link">'.$e->post_title.'</a>';
        }
        $output .= '</div>';
    }

    private function _start_main_elem(string &$output, $element) : void
    {
        $output .= '<div class="link-title">';
        $output .= '<div class="title">'.$element->post_title
            .'<img src="'.get_template_directory_uri().'/assets/img/chevron-down.svg" alt="chevron down"></div>';
    }

    private function _end_main_elem(string &$output) : void
    {
        $output .= '</div>';
    }

    private function _render_single_link(string &$output, $element){
        $output .= '<a href="'.get_site_url().$element->url.'" class="link">'.$element->post_title.'</a>';
    }

    private function _render_right_elements(string &$output, $elements){
        $output .= '<div class="right">';
        foreach ($elements as $e){
            if(strpos($e->url, '/book_a_party/') !== false){
                $output .= '<a href="/book-a-party/" class="book-party">'.$e->post_title.'</a>';
            }elseif(strpos($e->url, '#reservations') !== false){
                $output .= '<a href="'.get_site_url().$e->url.'" class="btn"><span>'.$e->post_title.'</span> <img src="'.get_template_directory_uri().'/assets/img/chevron-down.svg" alt="chevron down"></a>';
            }
        }
        $output .= '</div>';
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

            if(!empty($children_elements[$e->ID])){
                if($e->url === self::RIGHT && $e->post_title === self::RIGHT){
                    $this->_render_right_elements($output, $children_elements[$e->ID]);
                }else{
                    $this->_start_main_elem($output, $e);
                    $this->_render_children_elements($output, $children_elements[$e->ID], $args);
                    $this->_end_main_elem($output);
                }
            }else{
                $this->_render_single_link($output, $e);
            }
        }

        return $output;
    }
}
