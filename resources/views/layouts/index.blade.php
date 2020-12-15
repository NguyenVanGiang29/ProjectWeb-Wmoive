<!doctype html>
<html lang="vi">
  <head>
    <title>Wmovie</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Slick CSS -->
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <!-- End Slick CSS -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap-rating.css">
    <!-- End Bootstrap CSS -->
  
    <link rel="stylesheet" href="css/main.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" integrity="sha384-wxqG4glGB3nlqX0bi23nmgwCSjWIW13BdLUEYC4VIMehfbcro/ATkyDsF/AbIOVe" crossorigin="anonymous">

    <script src="https://www.google.com/recaptcha/api.js?hl=vi" async defer></script>

  </head>
  <body id="page-top" data-spy="scroll" data-offset="50">
    {{-- @php
      Auth::check()?Auth::user()->trang_thai==1||Auth::user()->trang_thai==2?Auth::logout():'':'';
    @endphp --}}

  
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
      
    <!-- Optional JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="slick/slick.min.js"></script>
    <script src="js/bootstrap-rating.js"></script>
    
    <script src="https://cdn.ckeditor.com/4.8.0/standard-all/ckeditor.js"></script>
    <script src="tools/ckfinder/ckfinder.js"></script>

    <script src="js/my.js"></script>
    
    @yield('script')
    @stack('script')
    @if(session('error_login'))
    <script>
      $('#modalLogin').modal('show')
    </script>
    @endif
    @if(session('error_register'))
    <script>
      $('#modalSignup').modal('show')
    </script>
    @endif
    @if(session('error_post'))
    <script>
      $('#modalPost').modal('show')
    </script>
    @endif
    @if(session('error_changepassword'))
    <script>
      $('#modal-doimatkhau').modal('show')
    </script>
    @endif

    <script>
      $('.responsive1').slick({
          dots: true,
          speed: 500,
          infinite: false,
          slidesToShow: 5,
          slidesToScroll: 5,
          responsive: [
              {
              breakpoint: 1024,
              settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: false,
                  dots: true
              }
              },
              {
              breakpoint: 600,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
              }
              },
              {
              breakpoint: 480,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
              }
              }
          ]
      });
  </script>

    <script>
      $(document).ready(function () {
        CKEDITOR.replace('noi_dung', {
          filebrowserBrowseUrl: 'tools/ckfinder/ckfinder.html',
          filebrowserUploadUrl: 'tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
          
          toolbar: [
          { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
          { name: 'styles', items: [ 'Styles', 'Format' ] },
          { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
          { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
          { name: 'links', items: [ 'Link', 'Unlink' ] },
          { name: 'insert', items: [ 'Image', 'EmbedSemantic' ] },
          { name: 'tools', items: [ 'Maximize' ] }
          ],

          extraPlugins: 'autoembed,embedsemantic,image2,uploadimage,uploadfile',

          removePlugins: 'image'
        });

        $( '#modalPost' ).modal( {
          focus: false,
          
          // Do not show modal when innitialized.
          show: false
        } );

      });
    </script>
  
    {{-- <script>
    $(function () {
      $("div.alert").delay(4000).slideUp();
      window.onload = function(){
        setTimeout(function(e){},2000);
        $('#image-loading').fadeOut();
      }
    });
    </script> --}}
  </body>
</html>