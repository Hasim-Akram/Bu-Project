<ul class="nav navbar-nav side-nav"  style="margin-top:20px;">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
						<?php
						if($odr->IsRoleCreate() == 1){
							echo "<a href='index.php?id=manage_user_new_role'><i class='fa fa-database'></i> Role</a>";
						}else{
							echo " ";
						}
						?>
                    </li>
					<li>
                        <?php
						if($odr->IsUserAccess() == 1){
							?>
							<a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-users"></i> User <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="demo1" class="collapse">
								
								<?php
								if($odr->IsUserInsert() != 0)
								{
									echo "<li><a href='index.php?id=manage_user_add_new'><i class='glyphicon glyphicon-user'></i> New User</a></li>";
								}

								if($odr->IsUserList() != 0)
								{
									echo "<li><a href='index.php?id=manage'><i class='glyphicon glyphicon-user'></i> View User</a></li>";
								}
								?>
								
							</ul>
							<?php
						}else{
							echo " ";
						}
						?>
						
                    </li>
					<li>
						<?php
						if($odr->IsDataAccess() == 1){
							?>
							<a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-edit"></i> Data <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="demo2" class="collapse">
								
								<?php
								if($odr->IsDataList() != 0)
								{
									echo "<li><a href='index.php?id=data'><i class='glyphicon glyphicon-tasks'></i> View Data (Example)</a></li>";
								}

								if($odr->IsOrderSubmit() != 0)
								{
									echo "<li><a href='index.php?id=sample_order_collection'><i class='glyphicon glyphicon-envelope'></i> Order Collection (Temporary)</a></li>";
								}
								
								if($odr->IsOrderReportView() != 0)
								{
									echo "<li><a href='index.php?id=sample_order_report'><i class='glyphicon glyphicon-th'></i> Sales Forecast Report</a></li>";
									echo "<li><a href='#'><i class='glyphicon glyphicon-list-alt'></i> Actual Stock Report</a></li>";
								}
								
								?>
							
								<!--
								<li><a href='index.php?id=territory_officer'>Territory Officer</a></li>
								-->
								
							</ul>
							<?php
						}else{
							echo " ";
						}
						?>
                    </li>

					<li><a href='index.php?id=area_house_territory'><i class='fa fa-bicycle'></i> Terrirory Area</a></li>
                    <li>
						<?php
						if($odr->IsAuditAccess() == 1){
							echo "<a href='index.php?id=audit'><i class='fa fa-fw fa-desktop'></i> Audit Log </a>";

						}else{
							echo " ";
						}
						?>
                    </li>
                </ul>
