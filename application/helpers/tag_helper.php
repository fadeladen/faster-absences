<?php


function value_and_selected($value, $var)
{
    return 'value="' . $value . '" ' . (($var == $value) ? 'selected' : '');
}


function value_and_attr($value, $var, $attribute = 'selected')
{
    return 'value="' . $value . '" ' . (($var == $value) ? $attribute.'="true"' : '');
}


/**
 * Script
 *
 * Generates link to a JS file
 *
 * @param mixed $src       Script source or an array
 * @param bool  $indexPage Should indexPage be added to the JS path
 *
 * @return string
 */
function script_tag($src = '', bool $index_page = TRUE): string
{
    $script = '<script ';
    if (!is_array($src)) {
        $src = ['src' => $src];
    }

    foreach ($src as $k => $v) {
        if ($k === 'src' && !preg_match('#^([a-z]+:)?//#i', $v)) {
            if ($index_page === true) {
                $script .= 'src="' . site_url($v) . '" ';
            } else {
                $script .= 'src="' . base_url() . $v . '" ';
            }
        } else {
            $script .= $k . '="' . $v . '" ';
        }
    }

    return $script . 'type="text/javascript"' . '></script>';
}
