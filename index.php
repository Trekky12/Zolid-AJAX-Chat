<?php ini_set('session.use_trans_sid', 1); session_start(); ?>
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
    
    
        
            <div class="row">
            
                <div class="md12 panel">
                    <div class="panel-header">
                    <?php if(!empty($_SESSION["LoggedIn"]) && $_SESSION["LoggedIn"] == 1 && !empty($_SESSION['username'])){ ?>
                        <i class="icon32-mailbox"></i>
                        [<span id="curchatroom">Loading..</span>] <button id="logout" class="btn btn-primary pull-right">Logout</button>
                        <div class="chatloader pull-right">
                            <img src="img/chatloader.gif" alt="">
                            Loading.. 
                        </div>
                         <?php } ?>
                    </div>
                    
                    <div class="panel-body">
                    
                      <?php if(!empty($_SESSION["LoggedIn"]) && $_SESSION["LoggedIn"] == 1 && !empty($_SESSION['username'])){ ?>
                        <!-- The actual Chat -->
                        <div id="chat_conversation" class="col-md-10 col-xs-9"></div>
                        <div class="col-md-2 col-xs-3"><ul class="list-group" id="online_users" ></ul></div>
                        <div>
                            <form id="chat_newmsg" class="row form" action="#" onsubmit="return false;">

                                <div class="col-xs-8 col-sm-8 col-md-8"> 
                                    <input name="message" type="text" class="form-control" placeholder="Your message..">
                                </div>
                                <div class="col-xs-4 col-sm-2 col-md-2" form-control>
                                    <button type="submit" class="btn btn-small btn-success form-control">Send</button>
                                </div>

                                <div class="col-xs-12 col-sm-2 col-md-2">
                                    <!-- Chat Room Selection -->
                                    <div class="dropdown pull-right">
                                        <a class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Chat Room</a>
                                        <ul id="chatroom" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                            <li><a tabindex="-1" href="#" data-room="General"><i></i> General</a></li>
                                            <li><a tabindex="-1" href="#" data-room="Help"><i></i> Help</a></li>
                                            <li><a tabindex="-1" href="#" data-room="Off Topic"><i></i> Off Topic</a></li>
                                        </ul>
                                    </div>
                                    <!-- End of Chat Room Selection -->
                                </div>


                            </form>
                        </div>
                        <!-- End of the chat -->
                        <?php }else{ ?>
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
                                            <input type="submit" name="login" value="Login" class="btn btn-primary" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
        <!-- jQuery -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                            
        <!-- Twitter Bootstrap -->
        <script type="text/javascript" src="js/bootstrap.min.js?v=332"></script>
        
        <!-- The chat -->
        <script type="text/javascript" src="js/chat.js?v=010"></script>
        <script type="text/javascript" src="js/login.js?v=001"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $(document).LoginModule({
                loginForm: '#registerForm', // The ID of the Login Form
                output : '#output',
                logout : '#logout',
                debug: false, // Show debugging information in the console
                queryurl: 'chat/livechat.user.php' // The url to the chat query php script.
            });
            
            <?php if(!empty($_SESSION["LoggedIn"]) &&$_SESSION["LoggedIn"] == 1 && !empty($_SESSION['username'])){ ?>
            $(document).obChat({
                chatBox: '#chat_conversation', // The ID of the chatbox where the messages will be shown
                msgForm: '#chat_newmsg', // The ID of the form for new chat messages
                msgMax: 0, // The max messages to display in the chat at any time, 0 = no limit.
                showLoader: true, // Show the "loader" when the script it querying for new messages or chaning room.
                debug: true, // Show debugging information in the console
                updateRate: 7500, // (milliseconds) How often the script will check for new messages. I recommend 7500 or more (7.5 sec).
                clearOnRefresh: false,
                userBox: '#online_users',
                queryurl: 'chat/livechat.processor.php' // The url to the chat query php script.
            });   
            <?php } ?>        
        });
        </script>
    </body>
</html>