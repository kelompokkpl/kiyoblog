<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="description" content="Kiyoblog">

  <title>Kiyoblog</title>

  <link rel="shortcut icon" href="<?=base_url('assets/images/favicon.png')?>" type="image/x-icon">

  <link rel="stylesheet" href="<?=base_url('assets/reader/css/maicons.css')?>">

  <link rel="stylesheet" href="<?=base_url('assets/reader/vendor/animate/animate.css')?>">

  <link rel="stylesheet" href="<?=base_url('assets/reader/vendor/owl-carousel/css/owl.carousel.min.css')?>">

  <link rel="stylesheet" href="<?=base_url('assets/reader/css/bootstrap.css')?>">

  <link rel="stylesheet" href="<?=base_url('assets/reader/css/mobster.css')?>">
  <script type="text/javascript" src="<?=base_url('assets/js/jquery-3.1.1.js')?>"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#keyword').on('keyup', function(e){
        e.preventDefault();
        e.stopPropagation();
        
        if($(this).val().length > 0){
          $.ajax({
            url: '<?=base_url('Reader/searchAjax')?>',
            type: 'post',
            data: {'key': $('#keyword').val() },
            success: function(hasil){
              $('#results').html(hasil);
            }
          });
        } else if ($(this).val().length == 0){
          $('#results').html('');
        }
      });

      $('.del').on('click', function(){
          $.ajax({
            url: '<?=base_url('Reader/deleteComment')?>',
            type: 'post',
            data: {'id': $(this).val() },
            success: function(){
              $('.modal').modal('hide')
              $('body').load('')
            }
          });
      });

      $('.addCom').on('click', function(){
          var data = $('.formCom').serialize()
          $.ajax({
            url: '<?=base_url('Reader/saveComment')?>',
            type: 'post',
            data: data,
            cache: false,
            success: function(){
              $('body').load('')
            }
          });
      });

    });
  </script>

</head>
<body>