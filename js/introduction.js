//todo limit query results to only what is needed
$.get('https://api.rss2json.com/v1/api.json?rss_url=https://medium.com/feed/green-river-web-mobile-developers', function(result) {
    //$('#latest-blogs').html(result.items[0].title);
    let output = '';
    for (let i = 0; i < 3; i++) {
        let currPost = result.items[i];
        output +=
            `<li class="list-group-item">
                <h4 class="card-title h5">${currPost.title}</h4>
                <p class="card-subtitle mb-2 text-muted h6">${currPost.author}</p>
                <p class="card-subtitle mb-2 text-muted h6">${currPost.pubDate}</p>
                <p class="card-text">${currPost.content}</p>
            </li>`;
    }
    
    // $(result.items).each(function () {
    //     $latest
    // });
    $('#latest-blogs').html(output);
});