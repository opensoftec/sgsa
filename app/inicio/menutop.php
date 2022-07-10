<nav class="navbar navbar-blue navbar-fixed-top" role="navigation" style="background: #3f51b5">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <div class="left_col">
            <div class="col-lg-12">
                <div class="col-lg-3" >
                </div>
            </div>
        </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><a href="../inicio/admin.php"><span class="glyphicon glyphicon-home"></span> NANOSH-CELL</a></li>
<!--            <li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Calendar</a></li>              -->
        </ul>

        <ul class="nav navbar-nav navbar-right" style="margin-right:1%">
<!--            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                        class="glyphicon glyphicon-envelope"></span>Inbox <span class="label label-info">32</span>
                </a>-->
                <ul class="dropdown-menu">
                    <li><a href="#"><span class="label label-warning">4:00 AM</span>Favourites Snippet</a></li>
                    <li><a href="#"><span class="label label-warning">4:30 AM</span>Email marketing</a></li>
                    <li><a href="#"><span class="label label-warning">5:00 AM</span>Subscriber focused email
                            design</a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="text-center"> View All</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                        class="glyphicon glyphicon-user"></span> <?= ucwords($user->nombre) ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
<!--                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>-->
                    <li class="divider"></li>
                    <li><a href="../inicio/login.php"><span class="glyphicon glyphicon-off"></span>Salir</a></li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>