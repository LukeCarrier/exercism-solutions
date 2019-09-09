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

        $isBold = false;
        $isItalic = false;

        if (preg_match('/(.*)__(.*)__(.*)/', $line, $matches)) {
            $line = $matches[1] . '<em>' . $matches[2] . '</em>' . $matches[3];
            $isBold = true;
        }

        if (preg_match('/(.*)_(.*)_(.*)/', $line, $matches)) {
            $line = $matches[1] . '<i>' . $matches[2] . '</i>' . $matches[3];
            $isItalic = true;
        }

        if ($isItalic || $isBold) {
            $line = trim($line);
        } else {
            $line = trim($line);
        }

        if (!preg_match('/<h|<ul|<p|<li/', $line)) {
            $line = "<p>$line</p>";
        }

        if (preg_match('/(.*)__(.*)__(.*)/', $line, $matches)) {
            $line = $matches[1] . '<em>' . $matches[2] . '</em>' . $matches[3];
        }

        if (preg_match('/(.*)_(.*)_(.*)/', $line, $matches)) {
            $line = $matches[1] . '<i>' . $matches[2] . '</i>' . $matches[3];
        }

        $line = preg_replace('/<li>(?!<em|<i)(.*)<\/li>/', '<li><p>\1</p></li>', $line);
    }

    return preg_replace('/(<li>.*<\/li>(\n|$))+/', '<ul>\0</ul>', join($lines));
}
