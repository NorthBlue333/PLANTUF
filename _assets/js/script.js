$('document').ready(function() {
  $('nav .nav-item').removeClass('active');
  $('nav .nav-item').each(function() {
    if($(this).find('.nav-link').text() == $('h1').text()) {
      $(this).addClass('active');
    }
  });

  $('[data-toggle="tooltip"]').tooltip({trigger: 'manual', offset: '50%', animation: false}).tooltip('show');
  $('.label-left').each(function() {
    $(this).css('margin-left', '-'+($(this).width()+5)+'px');
  });

  $('h2.desc').click(function() {
    $('[data-toggle="tooltip"]').tooltip('hide');
    $('[data-toggle="tooltip"]').tooltip('show');
    $(this).closest('article').find('p').toggleClass('show');
    $(this).closest('article').find('.sizes').toggleClass('show');
    $(this).find('.parrow').toggleClass('parrow-down');
    $(this).find('.parrow').toggleClass('parrow-up');
  });

  $('.periods button[type=submit], button[name=plantdelete]').click(function() {
    let butt = $(this);
    if(butt.attr('name') == 'plantdelete') {
      request = $.ajax({
        url: "controllers/plant_update.php",
        type: "post",
        data: 'delete&plantid=' + $(this).val(),
        success: function(response, textStatus, jqXHR) {
          document.location.href = '?p=plants';
        },
        error: function (jqXHR, error, desc) {

        }
      });
    } else {
      butt.closest('article').find('.alert').remove();
      let id = $(this).val().split('-');
      request = $.ajax({
        url: "controllers/plant_update.php",
        type: "post",
        data: butt.attr('name') + '=' + id[1] + '&plantid=' + id[0],
        success: function(response, textStatus, jqXHR) {
          butt.val(id[1] == '0' ? '1' : '0');
          butt.toggleClass('border-green');
        },
        error: function (jqXHR, error, desc) {
          butt.closest('article').find('p').after(`
            <div class="alert alert-danger text-center mt-2 w-50 mx-auto" role="alert">
              It didn't work. Try again.
            </div>
            `);
          setTimeout(function() { butt.closest('article').find('.alert').remove(); }, 2000);
        }
      });
    }
  });

  $('select[name^="community_"]').change(function() {
    let parameters = window.location.href.split('?')[1].split('&');
    let user = '';
    for(let i = 0; i < parameters.length; i++) {
      parameters[i] = parameters[i].split('=');
      if(parameters[i][0] == 'user') {
        user = '&user=' + parameters[i][1];
      }
    }
    if($(this).find(':selected').val() == "none") {
      param = user;
    } else {
      if($(this).attr('name') == 'community_category') {
        param = '&category=' + $(this).find(':selected').val() + user;
      } else if($(this).attr('name') == 'community_subcategory') {
        param = '&subcategory=' + $(this).find(':selected').val() + user;
      }
    }
    document.location.href = '?p=community' + param;
  });

  $('.user-search').submit(function(e) {
    e.preventDefault();
    let parameters = window.location.href.split('?')[1].split('&');
    let cat = '';
    for(let i = 0; i < parameters.length; i++) {
      parameters[i] = parameters[i].split('=');
      if(parameters[i][0] == 'category' || parameters[i][0] == 'subcategory') {
        cat = '&' + parameters[i][0] + '=' + parameters[i][1];
      }
    }
    if($(this).find('input[name=user_search]').val() == "") {
      param = cat;
    } else {
      param = cat + '&user=' + $(this).find('input[name=user_search]').val();
    }
    document.location.href = '?p=community' + param;
  });

  $('.comment aside').click(function() {
    $(this).closest('.comment').find('.answers').toggleClass('collapse');
  });

  $('.comment .parrow').click(function() {
    let arrow = $(this);
    let id = arrow.closest('article').attr('id').split('-');
    data = id[0] + '=' + id[1];
    data += arrow.hasClass('parrow-down') ? '&vote=0' : '&vote=1';
    request = $.ajax({
      url: "controllers/vote.php",
      type: "post",
      data: data,
      success: function(response, textStatus, jqXHR) {
        document.location.reload(true);
        document.location.href = '#' + id[0] + '-' + id[1];
        arrow.closest('.comment').find('.answers').toggleClass('collapse');
      },
      error: function (jqXHR, error, desc) {
      }
    });
  })
});
