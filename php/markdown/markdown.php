<?php

function parseMarkdown($markdown)
{
    $lines = explode("\n", $markdown);
    foreach ($lines as &$line) {
        if (preg_match('/^(#{1,6})\s*(.*)/', $line, $matches)) {
            $headingLevel = strlen($matches[1]);
            $line = sprintf('<h%d>%s</h%d>', $headingLevel, $matches[2], $headingLevel);
        }

        $line = preg_replace('/\*\s*(.*)/', '<li>\1</li>', $line);
        $line = preg_replace('/__(.*)__/', '<em>\1</em>', $line);
        $line = preg_replace('/_(.*)_/', '<i>\1</i>', $line);
        $line = preg_replace('/^(?!<h|<ul|<p|<li)(.*)$/', '<p>\1</p>', $line);
        $line = preg_replace('/<li>(?!<em|<i)(.*)<\/li>/', '<li><p>\1</p></li>', $line);
    }

    return preg_replace('/(<li>.*<\/li>(\n|$))+/', '<ul>\0</ul>', join($lines));
}
