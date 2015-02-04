<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Chat</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Global CSS -->
        <link href="css/bootstrap.min.css?v=332" rel="stylesheet" type="text/css">

        <!-- Chat Css -->
        <link href="css/chat.css?v=010" rel="stylesheet" type="text/css">

        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <?php if (!empty($_SESSION["LoggedIn"]) && $_SESSION["LoggedIn"] == 1 && !empty($_SESSION['username'])) { ?>
                <div class="row">

                    <div class="md12 panel">

                        <div class="panel-header">
                            <span>Create User</span>
                        </div>

                        <div class="panel-body">
                            <div class="col-md-12">
                                <div id="output" class="alert" role="alert"></div>
                                <form method="post" class="form-horizontal" id="registerForm">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Password:</label>
                                        <div class="controls">
                                            <input type="password" class="form-control"  name="password" id="password" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="submit" name="save" value="Create" class="btn btn-primary" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>

                </div>

            <?php } ?>
        </div>

        <!-- jQuery -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        <!-- Twitter Bootstrap -->
        <script type="text/javascript" src="js/bootstrap.min.js?v=332"></script>

        <!-- The chat -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('input[name=\'save\']').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: 'chat/livechat.user.php',
                        type: 'POST',
                        data: $('#registerForm').serialize() + '&register=true',
                        dataType: "json",
                        success: function(reply) {

                            if (reply.status == true) {
                                $('#registerForm').trigger("reset");
                                $('#output').addClass('alert-success');
                                $('#output').html('Successful inserted User');
                            } else {
                                $('#output').addClass('alert-danger');
                                $('#output').html('Error inserting User');
                            }

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            //debug(xhr.responseText);
                            //debug('error getting username');
                        }
                    });
                });
            });
        </script>

    </body>
</html>