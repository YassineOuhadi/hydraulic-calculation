<!--position:fixed;top:0;width:100%;-->
<nav class="top_nav">
			<i class='bx bx-menu toggle-sidebar'></i>
			
            <!--<form action="#">
				<div class="form-group" id="search">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</form>-->
            
			<!--
            <a href="#" class="nav-link">
				<i class='bx bxs-bell icon'></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon'></i>
				<span class="badge">8</span>
			</a>
            -->
            <div style="position:absolute;right:15px;">
			<span class="divider"></span>
			<div class="profile">
				<img src="../Dashboard/images/<?php echo $account->image;?>" alt="">
				<ul class="profile-link">
					<!--
                    <li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
                    -->
					<li style="cursor:pointer;"><a id="logout"><i class='bx bxs-log-out-circle'></i> Se déconnecter</a></li>
				</ul>
			</div>
            </div>
</nav>