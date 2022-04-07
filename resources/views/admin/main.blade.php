<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.header')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.nav')

        @include('admin.sidebar')

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    @yield('content')

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- ./wrapper -->

    @include('admin.footer')
</body>

</html>
