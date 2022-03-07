<!DOCTYPE html>
<html>
  <head>
    <title>0. login-page</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="/plugin/resources/css/axure_rp_page.css" type="text/css" rel="stylesheet"/>
    <link href="/plugin/data/styles.css" type="text/css" rel="stylesheet"/>
    <link href="/plugin/files/0__login-page/styles.css" type="text/css" rel="stylesheet"/>
    <script src="/plugin/resources/scripts/jquery-3.2.1.min.js"></script>
    <script src="/plugin/resources/scripts/axure/axQuery.js"></script>
    <script src="/plugin/resources/scripts/axure/globals.js"></script>
    <script src="/plugin/resources/scripts/axutils.js"></script>
    <script src="/plugin/resources/scripts/axure/annotation.js"></script>
    <script src="/plugin/resources/scripts/axure/axQuery.std.js"></script>
    <script src="/plugin/resources/scripts/axure/doc.js"></script>
    <script src="/plugin/resources/scripts/messagecenter.js"></script>
    <script src="/plugin/resources/scripts/axure/events.js"></script>
    <script src="/plugin/resources/scripts/axure/recording.js"></script>
    <script src="/plugin/resources/scripts/axure/action.js"></script>
    <script src="/plugin/resources/scripts/axure/expr.js"></script>
    <script src="/plugin/resources/scripts/axure/geometry.js"></script>
    <script src="/plugin/resources/scripts/axure/flyout.js"></script>
    <script src="/plugin/resources/scripts/axure/model.js"></script>
    <script src="/plugin/resources/scripts/axure/repeater.js"></script>
    <script src="/plugin/resources/scripts/axure/sto.js"></script>
    <script src="/plugin/resources/scripts/axure/utils.temp.js"></script>
    <script src="/plugin/resources/scripts/axure/variables.js"></script>
    <script src="/plugin/resources/scripts/axure/drag.js"></script>
    <script src="/plugin/resources/scripts/axure/move.js"></script>
    <script src="/plugin/resources/scripts/axure/visibility.js"></script>
    <script src="/plugin/resources/scripts/axure/style.js"></script>
    <script src="/plugin/resources/scripts/axure/adaptive.js"></script>
    <script src="/plugin/resources/scripts/axure/tree.js"></script>
    <script src="/plugin/resources/scripts/axure/init.temp.js"></script>
    <script src="/plugin/resources/scripts/axure/legacy.js"></script>
    <script src="/plugin/resources/scripts/axure/viewer.js"></script>
    <script src="/plugin/resources/scripts/axure/math.js"></script>
    <script src="/plugin/resources/scripts/axure/jquery.nicescroll.min.js"></script>
    <script src="/plugin/data/document.js"></script>
    <script src="/plugin/files/0__login-page/data.js"></script>
    <script type="text/javascript">
      $axure.utils.getTransparentGifPath = function() { return '/plugin/resources/images/transparent.gif'; };
      $axure.utils.getOtherPath = function() { return '/plugin/resources/Other.html'; };
      $axure.utils.getReloadPath = function() { return '/plugin/resources/reload.html'; };
    </script>
  </head>
  <body>
    <div id="base" class="">

      <!-- background-box (Rectangle) -->
      <div id="u0" class="ax_default box_3" data-label="background-box">
        <div id="u0_div" class=""></div>
        <div id="u0_text" class="text " style="display:none; visibility: hidden">
          <p></p>
        </div>
      </div>

      <!-- box (Rectangle) -->
      <div id="u1" class="ax_default box_3" data-label="box">
        <div id="u1_div" class=""></div>
        <div id="u1_text" class="text " style="display:none; visibility: hidden">
          <p></p>
        </div>
      </div>

      <!-- logo-img (Image) -->
      <div id="u2" class="ax_default image" data-label="logo-img">
        <img id="u2_img" class="img " src="/plugin/images/0__login-page/logo-img_u2.png"/>
        <div id="u2_text" class="text " style="display:none; visibility: hidden">
          <p></p>
        </div>
      </div>

      <form action="{{ route('login') }}" method="POST">
        @csrf @method('POST')
        <!-- username-textfield (Text Field) -->
        <div id="u3" class="ax_default text_field" data-label="username-textfield">
          <div id="u3_div" class=""></div>
          <input id="u3_input" type="text" value="" name="email" class="u3_input"/>
        </div>

        <!-- login-button (Rectangle) -->
        <div id="u4" class="ax_default primary_button" data-label="login-button">
          <div id="u4_div" class=""></div>
          <div id="u4_text" class="text">
            <a href="#" target="_blank" onclick="document.getElementById('login_submit').click()"><p><span>LOGIN</span></p></a>
        </div>
        </div>
        <button type="submit" id="login_submit" hidden></button>

        <!-- password-textfield (Text Field) -->
        <div id="u5" class="ax_default text_field" data-label="password-textfield">
          <div id="u5_div" class=""></div>
          <input id="u5_input" type="password" name="password" value="" class="u5_input"/>
        </div>
      </form>

      <!-- lupapassword-button (Rectangle) -->
      <div id="u6" class="ax_default label" data-label="lupapassword-button">
        <div id="u6_div" class=""></div>
        <div id="u6_text" class="text">
          <a href="{{ route('lupa-password') }}">
              <p><span>Lupa password?</span></p>
          </a>
        </div>
      </div>
    </div>
    <script src="/plugin/resources/scripts/axure/ios.js"></script>
  </body>
</html>
