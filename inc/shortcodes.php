<?php
//feed
function feed_function()
{
    $args = ['post_type' => 'notas', 'posts_per_page' => -1];
    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {
        $content =  '<div id="notas" class="notas grid">';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $url =  get_field('url_nota', $post->ID);
            $url2 = parse_url($url, PHP_URL_HOST);
            $graph = OpenGraph::fetch($url);
            $terms = get_the_terms($post->ID, 'feed_tag');
            $filter = implode(',',wp_list_pluck($terms,'name'));
            $fuente = get_field('fuente', $post->ID) ? get_field('fuente', $post->ID) : get_field('otra', $post->ID);
            $twitter = get_field('twitter_url', $post->ID);
            if (empty($twitter)) {
                $content .=  '<div class="nota-feed grid-item" data-filter="'.$filter.'">';
                if ($fuente && $fuente !== 'tiempo') {
                    $content .=  '<a href="' . $url . '" target="_blank" class="fuente-footer ' . $fuente . '">' . $fuente . '</a>';
                } else {
                    $content .=  '<a href="' . $url . '" target="_blank" class="fuente-footer"><img src="'.get_stylesheet_directory_uri().'/img/image.png" class="tiempo-logo-fuente" /></a>';
                }
                $content .=  '<div class="nota-img-feed">';
                if ($url2 === 'www.youtube.com') {
                    $content .= embed($url);
                } else {
                    $content .=  '<a href="'.$url.'" target="_blank"><img src="' . get_field('imagen_nota', $post->ID) . '"/></a>';
                }

                $content .=  '</div>';
                $content .=  '<div class="nota-title-feed"><a href="'.$url.'" target="_blank">' . get_field('titulo_nota', $post->ID) . '</a></div>';
                $content .=  '<div class="nota-description-feed"><a href="'.$url.'" target="_blank">' . get_field('descripcion', $post->ID) . '</a></div>';
                $content .=  '<div class="terms nota-footer">';
                $content .=  '<span class="tags-f">';
                foreach ($terms as $t) {
                    $content .=  '<a href="#" class="tag-term" data-tag="' . $t->name . '">' . $t->name . '</a> ';
                }
                $content .=  '</span>';
                $content .= '<span class="social-footer">
                <a href="https://facebook.com/sharer.php?u='.$url.'" class="face-social" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/intent/tweet?url='.$url.'" class="twt-social" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://wa.me/?text='.$url.'" class="ws-social" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </span>';
                $content .=  '</div>';
                $content .=  '</div>';
            } else {
                $content .=  '<div class="grid-item nota-feed feed-twitter" data-filter="'.$filter.'">';
                if ($fuente) {
                    $content .=  '<a href="#" target="_blank" class="fuente-footer ' . $fuente . '">' . $fuente . '</a>';
                }
                $content .= twitter($twitter);
                $content .=  '<div class="terms nota-footer">';
                $content .=  '<span class="tags-f">';
                foreach ($terms as $t) {
                    $content .=  '<a href="#" class="tag-term" data-tag="' . $t->name . '">' . $t->name . '</a> ';
                }
                $content .=  '</span>';
                $content .= '<span class="social-footer">
                    <a href="https://facebook.com/sharer.php?u='.$twitter.'" class="face-social" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url='.$twitter.'" class="twt-social" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://wa.me/?text='.$twitter.'" class="ws-social" target="_blank"><i class="fab fa-whatsapp"></i></a>
                </span>';
                $content .=  '</div>';
                $content .=  '</div>';
            }
            
        }
        $content .=  '</div>';
    } else {
        $content .=  'no hay notas';
    }
    wp_reset_postdata();
    return $content;
}
add_shortcode('feed_shortcode', 'feed_function');

//cloud tags
function cloud_tags() {
    $args = [
        'format' => 'list',
        'order'      => 'RAND',
        'post_type' => 'notas',
        'taxonomy' => 'feed_tag',
        'number'     => 22,
        'show_count' => 0,
        'link' => 'view',
        'orderby' => 'count',
        'echo'  => 0
    ];
   return wp_tag_cloud( $args );
}

add_shortcode('cloud', 'cloud_tags');

function testgraph(){
    $graph = OpenGraph::fetch('https://www.instagram.com/p/B-FX76dAFOO/');

    $url = parse_url('https://www.instagram.com/p/B-FX76dAFOO/',PHP_URL_HOST);

    return $url;
}

add_shortcode('test', 'testgraph');