<?php
/*
 * Menu navbar, just an unordered list
 */
?>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                {menudata}
                <li>
                    <a href="{link}"><i class="fa fa-dashboard fa-fw"></i> {name}</a>
                </li>
                {/menudata}
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>