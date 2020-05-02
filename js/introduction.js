const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

//todo limit query results to only what is needed
$.get('https://api.rss2json.com/v1/api.json?rss_url=https://medium.com/feed/green-river-web-mobile-developers',
    function(result) {

        // Separate comments from posts
        let posts = result.items.filter(item => item.categories.length > 0);

        let output = '';

        // Add each post to a list item
        for (let i = 0; i < 3; i++) {
            let currPost = result.items[i];

            // Get first paragraph and cap its length
            let intro = $($.parseHTML('<div>' + currPost.content + '</div>')).find('p').first().text();
            intro = intro.substring(0, 150);

            let date = new Date(currPost.pubDate);
            let formattedDate = MONTHS[date.getMonth()] + ' ' + date.getDate();

            output +=
                `<li class="list-group-item">
                    <a href="${currPost.link}" target="_blank">
                        <div class='photo-header'>
                            <img class="card-img-top" src="${currPost.thumbnail}" alt="thumbnail for the post titled ${currPost.title}">
                            <h4 class="card-title h5">${currPost.title}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-text"><p>${intro}... read more</p></div>
                            <small class="card-subtitle mb-2 text-muted">${currPost.author}, ${formattedDate}</small>
                        </div>
                    </a>
                </li>`;
        }

        // Put posts on card
        $('#latest-blogs').html(output);
    });
