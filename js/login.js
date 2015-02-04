(function($) {
    'use strict';

    $.fn.extend({
        LoginModule: function(options) {
            var settings = {
                loginForm: '',
                output: '',
                logout : '',
                queryurl: ''

            };
            options = $.extend(settings, options);

            function debug(msg) {
                if (options.debug && typeof console === "object") {
                    console.log(msg);
                }
            }

            function login() {
                $.ajax({
                    url: options.queryurl,
                    type: 'POST',
                    data: $(options.loginForm).serialize() + '&login=true',
                    dataType: "json",
                    success: function(reply) {

                        if (reply.LoggedIn == true) {
                            window.location.href = "index.php";
                            $(options.output).addClass('alert-success');
                            $(options.output).html('Successful logged In');
                        } else {
                            $(options.output).addClass('alert-danger');
                            $(options.output).html('Error login');
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        debug(xhr.responseText);
                        debug('error at login');
                    }
                });
            }
            
            function logout() {
                $.ajax({
                    url: options.queryurl,
                    type: 'POST',
                    data: 'logout=true',
                    dataType: "json",
                    success: function(reply) {

                        if (reply.LoggedIn == false) {
                            window.location.href = "index.php";
                            $(options.output).addClass('alert-success');
                            $(options.output).html('Successful logged Out');
                        } else {
                            $(options.output).addClass('alert-danger');
                            $(options.output).html('Error logout');
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        debug(xhr.responseText);
                        debug('error at login');
                    }
                });
            }


            function init() {
                debug('Login Module Initiated.');
            }

            $(document).ready(function() {

                $(options.loginForm + ' input[name=\'login\']').click(function(e) {
                    e.preventDefault();
                    login();
                });
                
                 $(options.logout).click(function(e) {
                    e.preventDefault();
                    logout();
                });
                
            });
        }
    });
}(jQuery));