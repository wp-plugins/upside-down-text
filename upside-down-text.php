<?php
/*
Plugin Name: Upside Down Text
Plugin URI: http://www.grenadepod.com/projects/upside-down-text-plugin-for-wordpress/
Description: This plugin allows to "flip" any section of text upside down
Version: 1.1.0
Author: Grenadepod
Author URI: http://www.grenadepod.com
*/

/*  Copyright 2009 pulegium (email : info@grenadepod.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Since we're introducing a new attribute (<upsidedown>) we need to 'legalise' it.
// More info in wp-includes/kses.php
if (!CUSTOM_TAGS) {
    // allow new tag in the posts
    $allowedposttags['upsidedown'] = array();
    // ... and also in the comments
    $allowedtags['upsidedown'] = array();
}

// This function converts all characters in a string
// to matching "upside-down" Unicode characters
// Input is an array as suppplied by PHP preg_replace_callback function,
// so if called directly it needs to receive array('', <your string to convert>)
function convert_to_upsidedown_unicode($match)
{
    // conversion table
    $flipTable = array(
                        '!' => '&#x00A1;',
                        '"' => '&#x201E;',
                        '&' => '&#x214B;',
                        "'" => ',',
                        '(' => ')',
                        ')' => '(',
                        ',' =>  "'",
                        '.' => '&#x02D9',
                        '0' => '0',
                        '1' => '&#x21C2;',
                        '2' => '&#x1105;',
                        '3' => '&#x0190;',
                        '4' => '&#x3123;',
                        '5' => '&#x078E',
                        '6' => '9',
                        '7' => '&#x3125;',
                        '8' => '8',
                        '9' => '6',
                        ';' => '&#x061B;',
                        '<' => '>',
                        '>' => '<',
                        '?' => '&#x00BF',
                        'A' => '&#x2200',
                        'B' => '&#x10412',
                        'C' => '&#x0186',
                        'D' => '&#x25D6',
                        'E' => '&#x018E',
                        'F' => '&#x2132',
                        'G' => '&#x2141',
                        'H' => 'H',
                        'I' => 'I',
                        'J' => '&#x017F',
                        'K' => '&#x22CA',
                        'L' => '&#x02E5',
                        'M' => 'W',
                        'N' => 'N',
                        'O' => 'O',
                        'P' => '&#x0500',
                        'Q' => '&#x038C',
                        'R' => '&#x1D1A',
                        'S' => 'S',
                        'T' => '&#x22A5',
                        'U' => '&#x2229',
                        'V' => '&#x039B',
                        'W' => 'M',
                        'Y' => '&#x2144',
                        '[' => ']',
                        ']' => '[',
                        '_' => '&#x203E',
                        'a' => '&#x0250',
                        'b' => 'q',
                        'c' => '&#x0254',
                        'd' => 'p',
                        'e' => '&#x01DD',
                        'f' => '&#x025F',
                        'g' => '&#x0183',
                        'h' => '&#x0265',
                        'i' => '&#x0131',
                        'j' => '&#x027E',
                        'k' => '&#x029E',
                        'l' => '&#x0283',
                        'm' => '&#x026F',
                        'n' => 'u',
                        'o' => 'o',
                        'p' => 'd',
                        'q' => 'b',
                        'r' => '&#x0279',
                        's' => 's',
                        't' => '&#x0287',
                        'u' => 'n',
                        'v' => '&#x028C',
                        'w' => '&#x028D',
                        'x' => 'x',
                        'y' => '&#x028E',
                        'z' => 'z',
                        '{' => '}',
                        '}' => '{'
    );

    // original string needs to be reversed, because we're rotating it 180 degrees
    // in future releases this might have two options: rotate 180 or mirror (no reverse then)
    $origStr = strrev($match[1]);
    $newStr = ' ';
    for ($i = 0; $i < strlen($origStr); $i++) {
        $ch = $origStr[$i];
        if (array_key_exists($ch, $flipTable)) {
            $newStr .= $flipTable[$ch];
        } else {
            $newStr .= $ch;
        }
    }
    return $newStr;
}

// This is a filter hook function that selects portions of the content in between new tags
// and passes contents for conversion to character mapping function
function flip_text_upside_down_filter($content) 
{
    return preg_replace_callback(
        '/\s*<upsidedown>(.*)<\/upsidedown>/siU',
        'convert_to_upsidedown_unicode',
        $content
    );
}

// Shortcode function to parse [upsidedown] shortcodes
function flip_text_upside_down_shortcode($atts, $content=null)
{
    return convert_to_upsidedown_unicode(array('', $content));
}

// And just add appropriate filters where we want to allow upside-down text:
// post body, excerpt and comments
add_filter('the_content', 'flip_text_upside_down_filter');
add_filter('the_excerpt', 'flip_text_upside_down_filter');
add_filter('comment_text', 'flip_text_upside_down_filter');

// Also register shortcode handler
add_shortcode('upsidedown', 'flip_text_upside_down_shortcode');
