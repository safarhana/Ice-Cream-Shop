$(document).ready(function () {
  $('#search_box').keyup(function () {
    var query = $(this).val();
    if (query != '') {
      $.ajax({
        url: '../php/Search_suggestions.php',
        method: 'POST',
        data: { query: query },
        dataType: 'json',
        success: function (data) {
          var html = '';
          if (data.length > 0) {
            $.each(data, function (index, item) {
              html += '<a href="#" class="suggestion-item" data-name="' + item.name + '">';
              html += '<img src="../../../Admin/MVC/uploaded_files/' + item.image + '" alt="" style="width: 30px; height: 30px; object-fit: cover; margin-right: 10px;">';
              html += '<span>' + item.name + '</span>';
              html += '</a>';
            });
          } else {
            html = '<p class="no-results">No products found</p>';
          }
          $('#search-results').fadeIn();
          $('#search-results').html(html);
        }
      });
    } else {
      $('#search-results').fadeOut();
      $('#search-results').html('');
    }
  });

  $(document).on('click', '.suggestion-item', function (e) {
    e.preventDefault();
    var name = $(this).data('name');
    $('#search_box').val(name);
    $('#search-results').fadeOut();

    $('.search-form').submit();
  });


  $(document).on('click', function (e) {
    if (!$(e.target).closest('.search-form').length) {
      $('#search-results').fadeOut();
    }
  });
});