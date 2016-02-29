<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
        <script src="js/vendor.js">
        </script>
        <script src="bootstrap/js/bootstrap-ui.js">
        </script>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap3.min.css" />
        <link rel="stylesheet" type="text/css" href="css/stile.css" />
        <link rel="stylesheet" href="css/barcode.css" type="text/css"/>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js">
        </script>
        <script type="text/javascript" src="js/app.js">
        </script>
        <script type="text/javascript" src="js/services/translationService.js">
        </script>
        <script type="text/javascript" src="js/services/loginService.js">
        </script>
        <script type="text/javascript" src="js/loginController.js">
        </script>
    </head>
    <body ng-app="lendinara">
        <div class="row" ng-controller="loginController">
            <div class="col-md-12 languageNavbar">
                <span class="language" ng-click="changeLanguage('en')">
                    ENGLISH
                </span>
                <span class="language" ng-click="changeLanguage('it')">
                    ITALIAN
                </span>
            </div>
            <div class="col-md-6 text-center col-md-offset-3">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{translation.LOGIN}}
                        </h3>
                    </div>
                    <div class="panel-body ">
                        <div class="row">
                            <input type="text" class="form-control" placeholder="{{translation.USERNAME}}" ng-model="user.username" />
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" placeholder="{{translation.PASSWORD}}" ng-model="user.password"/>
                        </div>
                        <div class="row text-left">
                            <button class="btn" ng-click="login(user)">
                                {{translation.GO}}
                            </button>
                        </div>
                        <!-- <div class="row alert alert-danger" ng-show"loginError">
                            {{translation.LOGIN_ERROR}}
                        </div> -->
                    </div>
                </div>
                <div class="panel panel-warning pointer" ng-click="login('demo')">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{translation.DEMO}}
                        </h3>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{translation.CONTACT}}
                        </h3>
                    </div>
                    <div class="panel-body text-left">
                    	<p>{{translation.EMAIL}}: nicolo.tresoldi@hotmail.it</p>
                    	<p>Linkedin: <a href="https://www.linkedin.com/in/nicolotresoldi">https://www.linkedin.com/in/nicolotresoldi</a></p>
                    	<p>GitHub: <a href="https://github.com/Nico-92/">https://github.com/Nico-92/</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
