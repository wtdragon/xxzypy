<!DOCTYPE html>
<html lang="en">

	<head>
		@include('backend.includes.head')
	</head>

<body>

    <div id="wrapper">

		@include('backend.includes.header')

        <div id="page-wrapper">

            <div class="container-fluid">
            
            	<!-- Header page -->
            	@include('backend.includes.header-page')
            	<!-- ./ header page -->

		        <!-- Content -->
		        @yield('content')
		        <!-- ./ content -->
		        
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    {{ HTML::script('js/jquery-1.11.0.js') }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('js/bootstrap.min.js') }}

    @yield('scripts')

</body>

</html>
