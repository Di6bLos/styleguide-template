<?php

class Walker_Nav_Primary extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 1, $args = null ) {
        $indent = str_repeat("\t", $depth);
        
        // Build class name with 'sub-' prefix for each nested level
        // depth 1 = sub-menu, depth 2 = sub-sub-menu, depth 3 = sub-sub-sub-menu, etc.
        $class_name = str_repeat('sub-', $depth) . 'sub-menu dropdown-inner';
        
        $output .= $indent . '<div class="dropdown"> <ul class="' . $class_name . '">';
    }
}