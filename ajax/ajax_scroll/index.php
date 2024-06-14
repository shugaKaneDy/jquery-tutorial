<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Infinite Scroll</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    #blog-posts {
      width: 700px;
    }
    .blog-post {
      border: 1px solid black;
      margin: 10px 10px 20px 10px;
      padding: 6px 10px;
    }
    #spinner {
      display: none;
    }
  </style>
</head>
<body>
  <div id="blog-posts">
    
  </div>

  <div id="spinner" class="spinner-border" role="status">
    <span class="sr-only"></span>
  </div>

  <div id="load-more-container">
    <button class="btn btn-light m-2" id="load-more" data-page="0">Load more</button>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

  var container = $('#blog-posts');
  var load_more = $('#load-more');
  var request_in_progress = false; // prevents from continuously requesting

  function showSpinner() {
    var spinner = $('#spinner');
    spinner.show();
  }

  function hideSpinner() {
    var spinner = $('#spinner');
    spinner.hide();
  }

  function showLoadMore() {
    load_more.show();
  }

  function hideLoadMore() {
    load_more.hide();
  }

  function appendToDiv(div, new_html) {
    // Put the new HTML into a temp div
    // This causes browsers to parse it as elements
    var temp = $('<div>');
    temp.html(new_html);

    // Then we can find and work those elements
    // Use firstElementChild because of how DOM treats whitespace.

    // var class_name = temp.firstElementChild.className;
    // var item = temp.getElementByClass(class_name);
    div.append(temp.children());
    
  }

  function setCurrentPage (page) {
    console.log('Incrementing page to: ' + page);
    load_more.attr('data-page', page);
  }

  // scroll reacts adds 3 content
  function scrollReaction() {
    /* var content_height = container.offsetHeight;
    var current_y = window.innerHeight + window.pageYOffset;
    console.log(current_y + '/' + content_height); */
    var content_height = container.height();
    var current_y = $(window).height() + $(window).scrollTop();
    // console.log(current_y + '/' + content_height);

    if (current_y > content_height) {
      loadMore();
    }
  }

  function loadMore() {
    
    // prevents from continuously requesting
    if(request_in_progress) {return;}
    request_in_progress = true;

    showSpinner();
    hideLoadMore();

    var page = parseInt(load_more.attr("data-page"));
    var nex_page = page + 1;
    $.ajax({
      url: "blog_posts.php?page=" + nex_page,
      method: "GET",
      success: function(response) {
        console.log('Result: ' + response);

        hideSpinner();
        setCurrentPage(nex_page);
        // append results to end of blog posts
        appendToDiv(container, response);
        showLoadMore();
        request_in_progress = false; // prevents from continuously requesting
      },
      error: function(xhr, status, error) {
        console.error('Error: ' + error);
      }
    });



    /* var xhr = new XMLHttpRequest();
    xhr.open('GET', 'blog_posts.php?page=1', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
      if(xhr.readyState == 4 && xhr.status == 200) {
        var result = xhr.responseText;
        console.log('Result: ' + result);

        hideSpinner();
        // append results to end of blog posts
        showLoadMore();

      }
    };
    xhr.send(); */
  }

  // load_more.addEventListener("click", loadMore);
  load_more.on('click', loadMore);

  // Scroll effect
  window.onscroll = function () {
    scrollReaction();
  }

  // Load even the first page with Ajax
  loadMore();
</script>

</body>
</html>
