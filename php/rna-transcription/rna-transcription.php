<?php

function toRna(string $dna): string
{
    $rna = '';
    foreach (str_split($dna) as $nucleotide) {
        switch ($nucleotide) {
            case 'G': $rna .= 'C'; break;
            case 'C': $rna .= 'G'; break;
            case 'T': $rna .= 'A'; break;
            case 'A': $rna .= 'U'; break;
        }
    }
    return $rna;
}
