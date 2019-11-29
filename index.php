<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="app/assets/img/logo-fav.png">
    <title>Beagle</title>
    <link rel="stylesheet" type="text/css" href="app/assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
    <link rel="stylesheet" href="app/assets/css/app.css" type="text/css"/>
    <link rel="stylesheet" href="app/plugins/pnotify/pnotify.custom.min.css" type="text/css" />

  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="card card-border-color card-border-color-primary">
              <div class="card-header">
                  KUSSD
                  <!--<img class="logo-img" src="app/assets/img/logo-xx.png" alt="logo" width="{conf.logoWidth}" height="27">-->
                  <span class="splash-description">Entrer votre login et mot de passe svp.</span></div>
              <div class="card-body">
                 <form action="#" method="post">
                  <div class="login-form">
                    <div class="form-group">
                      <input class="form-control" id="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="password" type="password" placeholder="Password">
                    </div>
                    <div class="form-group row login-tools">
                      <div class="col-6 login-remember">
                       
                      </div>
                      <div class="col-6 login-forgot-password"><a href="pages-forgot-password.html"> Mot de passe oublié?</a></div>
                    </div>
                    <div class="form-group row login-submit">
                      <div class="col-6"><a class="btn btn-secondary btn-xl btn-signup"  data-dismiss="modal" >S'inscrire</a></div>
                      <div class="col-6"><a class="btn btn-primary btn-xl btn-signin" type="button">Se connecter</a></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="app/assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="app/assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="app/assets/js/app.js" type="text/javascript"></script>
    <script src="app/plugins/pnotify/pnotify.custom.min.js"type="text/javascript"></script>
    <script src="app/assets/js/jquery.md5.js" type="text/javascript"></script>
    <script src="auth.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//-initialize the javascript
      	//App.init();
        
        $('.btn-signin').click(function(e){
            var auth = new Auth();
            
            //e.preventDefault();
            var username = $('#username').val();;
            var password = $('#password').val();
            auth.signin(username, password);
          });
          
          
      });
      
      
    </script>
  </body>
</html>