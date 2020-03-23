<?php

function embed($url){

    $youtube = parse_url($url, PHP_URL_HOST);
    if($youtube !== 'www.youtube.com') {
        echo $url;
    } else {
        parse_str( parse_url( $url, PHP_URL_QUERY ), $yid );
        echo '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/'.$yid['v'].'?controls=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }
}

function twitter($url){
    $twitter = parse_url($url, PHP_URL_PATH);
    $twitterID = explode('/',$twitter);
    echo '<div class="tweet" id="'.$twitterID[3].'"></div>';
}