<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <span class="menu-link">
					<span class="menu-icon"><i class="fa fa-lock"></i></span>
					<span class="menu-title">Accés</span>
					<span class="menu-arrow"></span>
				</span>
    <!--end:Menu link-->


    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">

        <!--begin:Menu item gestion de POS -->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link " href="{{ route('users.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                <span class="menu-title">Utilisateurs</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item gestion des POS -->

        <!--begin:Menu item gestion de caisses -->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link " href="{{ route('roles.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                <span class="menu-title">Roles</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item gestion des caisses -->

        <!--begin:Menu item mvmts fond  -->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link " href="{{ route('permissions.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                <span class="menu-title">Permissions</span>
            </a>
            <!--end:Menu link-->
        </div>

    </div>
    <!--end:Menu sub-->
</div>
