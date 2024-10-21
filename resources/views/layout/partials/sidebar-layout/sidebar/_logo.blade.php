<!--begin::Logo-->
<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
    <!--begin::Logo image-->
    <a href="/">
        <img alt="Logo" src="{{ asset(config('setup.logo_main','assets/media/logos/default-dark.png')) }}"
             class="h-25px app-sidebar-logo-default"/>
        <img alt="Logo" src="{{ asset(config('setup.logo_sm','assets/media/logos/default-dark.png')) }}"
             class="h-20px app-sidebar-logo-minimize"/>
    </a>
    <div id="kt_app_sidebar_toggle"
         class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
         data-kt-toggle="true" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
        {!! getIcon('double-left', 'fs-2 rotate-180') !!}
    </div>
    <script type="text/javascript">
        var sidebar_toggle = document.getElementById("kt_app_sidebar_toggle");  // Get the sidebar toggle button element
        if ("{{ Cookie::get('sidebar_minimize_state') }}" === "on") {
            document.body.setAttribute("data-kt-app-sidebar-minimize", "on");  // Set the 'data-kt-app-sidebar-minimize' attribute for the body tag
            sidebar_toggle.setAttribute("data-kt-toggle-state", "active");  // Set the 'data-kt-toggle-state' attribute for the sidebar toggle button
            sidebar_toggle.classList.add("active");  // Add the 'active' class to the sidebar toggle button
        }
    </script>
    <!--end::Sidebar toggle-->
</div>
<!--end::Logo-->
