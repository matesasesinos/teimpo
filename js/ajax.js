// var page = 2;
// jQuery(function($) {

//     function cargar() {
//         var data = {
//             'action': 'load_posts_by_ajax',
//             'page': page,
//             'security': blog.security
//         };
 
//         $.post(blog.ajaxurl, data, function(response) {
//             if($.trim(response) != '') {
//                 $('.blog-posts').append(response);
//                 page++;
//             } else {
//                 $('.loadmore').hide();
//             }
//         });
//     }
//     $('body').on('click', '.loadmore', function() {
        
//     });
// });