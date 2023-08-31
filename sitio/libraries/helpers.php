<?php
 /**
 * @param string $string
 * @return string
 */
function sluggify(string $string): string {
    $search = [' ', '%', '+', '\'', '"', '`', '´'];
    $replace = ['-', '', '-', '', '', '', ''];
    return str_replace($search, $replace, $string);
}

/**
 * @param null|string $string
 * @return string
 */
function specialChatConv(?string $string): string {
    return htmlspecialchars($string);
}

/**
 * @param null|string $string
 * @return string
 */
function getUserBadge(string $string): string {
    if($string === '1') {
        return 'Admin';
    }else if($string === '2') {
        return 'Moderator';
    } else {
        return 'User';
    }
}