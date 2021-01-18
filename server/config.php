<?php 
    include('simple_html_dom.php'); 
    $phrase = strtolower($_GET['phrase']); 
    $url = 'https://www.spanishdict.com/translate/'.$phrase; 
    $html = file_get_html($url);
    $definitions = array();
    foreach($html->find('._3aQ9irLD') as $postDiv) {
        foreach($postDiv->find('a') as $a) {
            array_push($definitions, $a->plaintext);
        }
    }

    if(count($definitions) > 0) {
        echo "<br><p class='word-in-phrase'>". $phrase . "<br></p>";
        for($i=0; $i<count($definitions); $i++) {
            echo "<p class='definition-of-word'>". $definitions[$i] . "<br></p>";
        }
    } else if(count($definitions) < 1) {
        $phrase = explode(' ', $phrase);
        foreach($html->find('._3G2VT5U3') as $postDiv) {
            foreach($postDiv->find('a') as $a) {
                array_push($definitions, $a->plaintext);
            }
        }
        if(count($definitions) > 2) {
            for($i=0; $i<count($definitions); $i++) {
                if(in_array($definitions[$i], $phrase)) {
                    echo "<br><p class='word-in-phrase'>". $definitions[$i]. "<br></p>";
                }
                else {
                    if($i<1) {
                        echo "<br><p style='color: rgb(0, 155, 255);
                        font-family: -apple-system, BlinkMacSystemFont, Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; font-weight:500;'>". $definitions[$i]. "<br></p>";
                    } else {
                        echo "<p style='color: black;
                        font-family: -apple-system, BlinkMacSystemFont, Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; font-weight:500;'>". $definitions[$i] . "<br></p>";
                    }
                }
            }
        }
    }
?>
