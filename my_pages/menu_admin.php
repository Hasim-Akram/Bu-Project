<ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="index.php">University</a>
                        <a href="wsdindex.html#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="wsdindex.html#" class="profile-mini">
                            <img src="assets/images/users/avatar.jpg" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="assets/images/users/avatar.jpg" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $user_data->full_name; ?></div>
                                <div class="profile-data-title">Admin</div>
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="active">
                        <a href="index.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
                    </li>                    
                    <li class="xn-openable00">
                        <a href="index.php?id=department"><span class="fa fa-files-o"></span> <span class="xn-text">Department</span></a>
                        
                    </li>
                    <li class="xn-openable00">
                        <a href="index.php?id=batch"><span class="fa fa-file-text-o"></span> <span class="xn-text">Batchs</span></a>
                        
                    </li>

                    <li class="xn-openable00">
                        <a href="index.php?id=course"><span class="fa fa-file-text-o"></span> <span class="xn-text">Courses</span></a>
                        
                    </li>

                    <li class="xn-openable">
                        <a href="wsdindex.html#"><span class="fa fa-cogs"></span> <span class="xn-text">Students</span></a>                        
                        <ul>
                            <li><a href="index.php?id=student_list"><span class="fa fa-heart"></span> Students List</a></li>                            
                            <li><a href="index.php?id=student_new"><span class="fa fa-cogs"></span> Add New Student</a></li>
                        </ul>
                    </li>                    
                    <li class="xn-openable">
                        <a href="wsdindex.html#"><span class="fa fa-pencil"></span> <span class="xn-text">Teachers</span></a>
                        <ul>
                            <li><a href="index.php?id=teacher_list"><span class="fa fa-text-width"></span> Teachers List</a></li>
                            <li><a href="index.php?id=teacher_new"><span class="fa fa-floppy-o"></span> Add New Teacher </a></li>
                        </ul>
                    </li>

                     <li class="xn-openable00">
                        <a href="index.php?id=admin_view_result"><span class="fa fa-file-text-o"></span> <span class="xn-text">Result Sheet</span></a>
                        
                    </li>

                </ul>