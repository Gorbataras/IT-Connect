const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

// Get the the most recent posts and format for a card display
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
                    <a href="${currPost.link}" target="_blank" class="no-decoration">
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

// Prevent from closing the only showing card on accordion
$('.expand-toggle').on('click', function(e) {
   if ($(this).parents('.card').children('.collapse').hasClass('show')) {
       e.stopPropagation();
   }
   e.preventDefault();
});

// Show regular cursor for unclickable card title
$('.expand-toggle').mouseenter(function() {
    if ($(this).parents('.card').children('.collapse').hasClass('show')) {
        $(this).css('cursor', 'default');
    }
});

// Show pointer for clickable card title
$('.expand-toggle').mouseleave(function() {
    if ($(this).parents('.card').children('.collapse').hasClass('show')) {
        $(this).css('cursor', 'pointer');
    }
});

var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function () {
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function () {
            div.style.display = "none";
        }, 600);
    }
}