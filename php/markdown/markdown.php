<?php

const TRANSFORMS = [
    '/\*\s*(.*)/' => '<li>\1</li>',
    '/__(.*)__/' => '<em>\1</em>',
    '/_(.*)_/' => '<i>\1</i>',
    '/^(?!<h|<ul|<p|<li)(.*)$/' => '<p>\1</p>',
    '/<li>(?!<em|<i)(.*)<\/li>/' => '<li><p>\1</p></li>',
    '/(<li>.*<\/li>(\n|$))+/' => '<ul>\0</ul>'
];

function parseMarkdown($markdown)
{
    $markdown = preg_replace_callback('/^(#{1,6})\s*(.*)/', function($matches) {
        $headingLevel = strlen($matches[1]);
        return sprintf('<h%d>%s</h%d>', $headingLevel, $matches[2], $headingLevel);
    }, $markdown);

    $markdown = preg_replace(array_keys(TRANSFORMS), array_values(TRANSFORMS), $markdown);

    return str_replace("\n", '', $markdown);
}
