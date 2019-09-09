<?php

function parseMarkdown($markdown)
{
    $markdown = preg_replace_callback('/^(#{1,6})\s*(.*)/', function($matches) {
        $headingLevel = strlen($matches[1]);
        return sprintf('<h%d>%s</h%d>', $headingLevel, $matches[2], $headingLevel);
    }, $markdown);

    $markdown = preg_replace('/\*\s*(.*)/', '<li>\1</li>', $markdown);
    $markdown = preg_replace('/__(.*)__/', '<em>\1</em>', $markdown);
    $markdown = preg_replace('/_(.*)_/', '<i>\1</i>', $markdown);
    $markdown = preg_replace('/^(?!<h|<ul|<p|<li)(.*)$/', '<p>\1</p>', $markdown);
    $markdown = preg_replace('/<li>(?!<em|<i)(.*)<\/li>/', '<li><p>\1</p></li>', $markdown);

    return str_replace("\n", '', preg_replace('/(<li>.*<\/li>(\n|$))+/', '<ul>\0</ul>', $markdown));
}
