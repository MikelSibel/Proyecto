thumbs.onclick = function(event) {
    let thumbnail = event.target.closest('a');
    if (!thumbnail) return;
    showThumbnail(thumbnail.href, thumbnail.title);
    event.preventDefault();
  }

  function showThumbnail(href, title) {
    let largeImg = document.getElementById('largeImg');
    largeImg.src = href;
    largeImg.alt = title;
  }