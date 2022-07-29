<!-- TOPBAR COMPONENT -->

<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
	<div class="navbar-wrapper">
		<div class="navbar-container content">
			<div class="collapse navbar-collapse show" id="navbar-mobile">
				<ul class="nav navbar-nav mr-auto float-left">
					<li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
				</ul>
				<ul class="nav navbar-nav float-right">
					<li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"> <span class="avatar avatar-online"><img src="<?= BASE_THEME ?>adm/app-assets/images/portrait/small/user.png" alt="avatar"></span></a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="arrow_box_right">
								<a class="dropdown-item" href="#"><span class="avatar avatar-online"><img src="<?= BASE_THEME ?>adm/app-assets/images/portrait/small/user.png" alt="avatar"><span class="user-name text-bold-700 ml-1"><?= $userLogin; ?></span></span></a>
								<!-- <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="user-profile.html"><i class="ft-user"></i> Edit Profile</a>
                                    <a class="dropdown-item" href="email-application.html"><i class="ft-mail"></i> My Inbox</a>
                                    <a class="dropdown-item" href="project-summary.html"><i class="ft-check-square"></i> Task</a>
                                    <a class="dropdown-item" href="chat-application.html"><i class="ft-message-square"></i> Chats</a> -->
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= BASE_URL . 'auth/logout' ?>"><i class="ft-power"></i> Logout</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>