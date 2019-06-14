<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title','Dashboard') - BigDreamIndia.com</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/custom.css">
    @yield('styles')
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />

    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <script src="/vendors/js/vendor.bundle.addons.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @include('partials._navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        @include('partials._sidebar')
        <!-- partial -->
        <div class="main-panel">

            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->

            <!-- partial:../../partials/_footer.html -->
            @include('partials._footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.5/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
@include('sweetalert::alert')
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="/js/off-canvas.js"></script>
<script src="/js/misc.js"></script>
@yield('scripts')
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
@auth
    <script>
        window.fcWidget.init({
            token: "5c782f8a-ede7-4b73-a3da-9a7575018326",
            host: "https://wchat.freshchat.com",
            externalId: "{{ Auth::user()->username }}",     // user’s id unique to your system
            firstName: "{{ Auth::user()->full_name }}",              // user’s first name
            email: "{{ Auth::user()->email }}",    // user’s email address
            phone: "{{ Auth::user()->phone_number }}",            // phone number without country code
            phoneCountryCode: "+91"          // phone’s country code
        });
        window.fcWidget.user.setProperties({
            "Status": "{{ Auth::user()->status ? "Active" : "Inactive" }}",
            "Payment": "{{ Auth::user()->payment_confirmed ? "Done" : "Not Done" }}",
            "Profile": "{{ Auth::user()->is_profile_completed ? "Completed" : "Not Completed" }}",
            "Income": "₹ {{ Auth::user()->total_income }}",
            "Referred by": "{{ Auth::user()->referredby ? Auth::user()->referredby->username." (".Auth::user()->referredby->full_name.")" : "" }}"
        });
    </script>
@elseauth
    
@endauth
</body>
</html>
