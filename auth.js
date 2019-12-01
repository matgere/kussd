;(function ($) {

    Auth = function (options) {
        // constructor
        var construct = function (options) {
            $.extend(options);
        };

        this.signin = function (username,password) {
            if(username!=='' && password!==''){
            $.ajax({
                type: "POST",
                url: "backend/src/bo/user/UserController.php",
                data: {
                    login: username,
                    password: $.md5(password),
                    ACTION: 'SIGN_IN'
                },
                success: function(data) {
                    data=$.parseJSON(data);
                    if(data.rc===1){
                        var form = document.createElement("form");
                        var  login = document.createElement("input");
                        var  pass = document.createElement("input");
                        form.action = "cookies.php";
                        form.method = "post";
                        login.name = "login";
                        login.type = "hidden";
                        login.value = username;
                        pass.name = "password";
                        pass.type = "hidden";
                        pass.value = $.md5(password);
                        form.appendChild(login);
                        form.appendChild(pass);
                        document.body.appendChild(form);
                        form.submit();   
                    }else if(data.rc===0){
                        new PNotify({type: 'info', title: 'Authentification', text: 'Ce compte est desactivé. Veuillez contacter votre administrateur.'});
                        
                    }else{
                          new PNotify({type: 'error', title: 'Authentification', text: 'Login ou mot de passe incorrect.'});
                      }
                   
                },
                error: function(data) {
                    new PNotify({type: 'error', title: 'Authentification', text: 'Erreur de connexion.'});

                    return false;
                }
            });
            }
            else{
               new PNotify({type: 'error', title: 'Authentification', text: 'Login ou mot de passe vide.'});
            }
        };
        
        return construct(options);
    };
}(jQuery));

