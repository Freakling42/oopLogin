<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Home</title>
        <link rel="stylesheet" href="inc/assests/css/style.css" type="text/css" media="screen" title="no title" charset="utf-8" />
    </head>
    <body>
        <!-- MASTER WRAPPER -->
        <div id="masterWrapper">

        <!-- CONTENT WRAPPER -->
        <div id="contentWrapper">

        <!-- HEADER -->
        <div id="header">
            <div id="headerElements">
                <div id="logo"><a href="index.php">Tinna's playground</a></div>
                <div id="loginWrapper">{if !empty($userName)}<div class="username">Velkommen: {$userName}</div><form action="member.php" method="post"><input id="logOutBtn" type="submit" name="log_out" value="log ud"></form>{/if}</div>
            </div>
            <div id="menuwrapper"><ul id="primary-menu"><li><a href="member.php">Medlemsskab</a></li></ul></div>
            <span style="clear:both;"></span>
        </div><!-- END HEADER -->

        <!-- MAIN CONTENT -->
        <div id="mainContent">
            {$__content}
        </div><!-- END MAIN CONTENT -->

        </div><!-- END CONTENT WRAPPER -->

        </div><!-- END MASTER WRAPPER -->
    </body>
</html>