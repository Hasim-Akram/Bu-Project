<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="wsdindex.html#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->                    
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="wsdindex.html#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Settings </a></li>
                            <li><a href="wsdindex.html#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out </a></li>
                        </ul>                        
                    </li> 
                    <!-- END POWER OFF -->                    
                    
                    
                    <!-- LANG BAR -->
                    <li class="xn-icon-button pull-right">
                        <a href="wsdindex.html#"> <?php echo $user_data->full_name; ?> </a>
                        <ul class="xn-drop-left xn-drop-white animated zoomIn">
                            <li><a href="#"><span class="flag flag-bd"></span> My Profile </a></li>
                            <!-- <li><a href="#"><span class="flag flag-gb"></span> My Profile </a></li> -->
                            <!-- 
                            <li><a href="#"><span class="flag flag-de"></span> Deutsch</a></li>
                            <li><a href="#"><span class="flag flag-cn"></span> Chinese</a></li> 
                        -->
                        </ul>                        
                    </li> 
                    <!-- END LANG BAR -->
                </ul>




<!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->