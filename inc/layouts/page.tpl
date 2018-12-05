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
                <div id="logo">Tinna's playground</div>
                <div id="loginWrapper">{if !empty($userName)}<div class="username">Velkommen: {$userName}</div>{/if}</div>
            </div>
            <div id="menuwrapper"><ul id="primary-menu"><li><a href="#">Medlemsskab</a></li></ul></div>
        </div><!-- END HEADER -->

        <!-- MAIN CONTENT -->
        <div id="mainContent">
            {$__content}
        </div><!-- END MAIN CONTENT -->

        </div><!-- END CONTENT WRAPPER -->

        </div><!-- END MASTER WRAPPER -->
    </body>
</html>