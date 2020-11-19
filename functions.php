<?php 
function cariData($text, $cari)
{
    $c = 0;
    for ($i = 0; $i < strlen($text); $i++) {
         (strtolower($text[$i]) == strtolower($cari[$c])) ? $c++: $c = 0;//lanjut next state
        if ($c == strlen($cari)) {
            if ($text[$i - $c] != " " || $text[$i + 1] != " ") {
                $c = 0;
                continue;
            };
            //untuk mengambil kalimat yang terkait dengan keywordnya
            $leftkeyword = $i - $c;
            if ($leftkeyword < 0) $leftkeyword = 0;
            $startleftkeyword = $leftkeyword - 25;
            if ($startleftkeyword < 0) {
                $startleftkeyword = 0;
                $textleftkeyword = substr($text, $startleftkeyword, $leftkeyword);
            } else {
                $tmp = 25;
                while ($text[$startleftkeyword] != " ") {
                    $startleftkeyword--;
                    $tmp++;
                }
                $textleftkeyword = substr($text, $startleftkeyword, $tmp);
            }
            $textrightkeyword = substr($text, $i + 1, 150);
            $accept['word'] = $textleftkeyword . " " . "<b>" . $cari . "</b>" . $textrightkeyword . "...";

            break;
        }
    }
    $accept['state'] = $c;
    return $accept;
}
 ?>