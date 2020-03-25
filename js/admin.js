(function($){
    "use strict";
    function parseURL(url) {
        var parser = document.createElement('a'),
            searchObject = {},
            queries, split, i;
        // Let the browser do the work
        parser.href = url;
        // Convert query string to object
        queries = parser.search.replace(/^\?/, '').split('&');
        for( i = 0; i < queries.length; i++ ) {
            split = queries[i].split('=');
            searchObject[split[0]] = split[1];
        }
        return {
            protocol: parser.protocol,
            host: parser.host,
            hostname: parser.hostname,
            port: parser.port,
            pathname: parser.pathname,
            search: parser.search,
            searchObject: searchObject,
            hash: parser.hash
        };
    }
    $(document).ready(function(){
        var url = acf.getField('field_5e768dd9b2db0');
        var content = acf.getField('field_5e754bc1b3ce6');
        $('#acf-field_5e768dd9b2db0').on('paste', function () {
            var element = this;
            setTimeout(function () {
              var stringURL = parseURL(url.val()).pathname;
              var twtURL = stringURL.split('/');
              var twtID = twtURL[3];
              
              var tweet = document.getElementById("acf-field_5e754bc1b3ce6");
              var id = twtID;
              var twtContent = twttr.widgets.createTweetEmbed(
				id, tweet,
				{
					conversation: 'none',    // or all
					cards: 'hidden',  // or visible 
					linkColor: '#cc0000', // default is blue
					theme: 'light'    // or dark
                }).then(function(v){
                    console.log(v);
                    content.val(v.outerHTML);
                });

            }, 100);
          });
    });
    $(document).ready(function () {
        var tweets = $(".tweet");
        
		$(tweets).each(function (t, tweet) {
			var id = $(this).attr('id');
			var coso = twttr.widgets.createTweetEmbed(
				id, tweet,
				{
					conversation: 'none',    // or all
					cards: 'hidden',  // or visible 
					linkColor: '#cc0000', // default is blue
					theme: 'light'    // or dark
                });
                coso.then(function(v){
                   alert(v);
                   $('#acf-field_5e754bc1b3ce6').val(v);
                });
		});
	});
}(jQuery));