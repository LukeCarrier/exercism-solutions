<?php

function parseMarkdown($markdown)
{
    $lines = explode("\n", $markdown);

    $isInList = false;

    foreach ($lines as &$line) {
        if (preg_match('/^(#{1,6})\s*(.*)/', $line, $matches)) {
            $headingLevel = strlen($matches[1]);
            $line = sprintf('<h%d>%s</h%d>', $headingLevel, $matches[2], $headingLevel);
        }

        if (preg_match('/\*(.*)/', $line, $matches)) {
            $line = $matches[1];
            if (!$isInList) {
                $isInList = true;
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
                    $line = "<ul><li>" . trim($line) . "</li>";
                } else {
                    $line = "<ul><li><p>" . trim($line) . "</p></li>";
                }
            } else {
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
                    $line = "<li>" . trim($line) . "</li>";
                } else {
                    $line = "<li><p>" . trim($line) . "</p></li>";
                }
            }
        } else {
            if ($isInList) {
                $line = "</ul>" . $line;
                $isInList = false;
            }
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
    }
    $html = join($lines);
    if ($isInList) {
        $html .= '</ul>';
    }
    return $html;
}
