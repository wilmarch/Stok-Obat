<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ucfirst(AppSettings::get('app_name', 'App')) }} - {{ ucfirst($title ?? '') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="@if (!empty(AppSettings::get('logo'))) {{ asset('storage/' . AppSettings::get('favicon')) }} @else{{ asset('assets/img/favicon.png') }} @endif">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">

    <!-- Snackbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/snackbar/snackbar.min.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
    <!-- Datatables css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/DataTables/datatables.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <!-- page css -->
    @stack('page-css')

</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="/" class="logo">
                    <img src="@if (!empty(AppSettings::get('logo'))) {{ asset('storage/' . AppSettings::get('logo')) }} @else{{ asset('assets/img/logo.png') }} @endif"
                        alt="Logo">
                </a>
            </div>
            <!-- /Logo -->
            
        </div>
        <!-- /Header -->
        <!-- Sidebar -->
        {{-- @include('includes.sidebar') --}}
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="/"><i class="fa-solid fa-file"></i><span>List Obat</span></a>
                        </li>
                        <li>
                            <a href="/dokter" ><i class="fa-solid fa-user"></i> <span>Karyawan</span> </a>
                        </li>
                        {{-- li for login --}}
                        <li>
                            <a href="/dashboard"><i class="fa-solid fa-user"></i> <span>Login Admin</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <!-- Products -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <h3>Selamat Datang di Stok Obat Doccure!</h3>
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
								@if($product->exists())
								<tr>
									<td>
										<h2 class="table-avatar">
											@if(!empty($product->purchase->image))
											<span class="avatar avatar-sm mr-2">
												<img class="avatar-img" src="{{asset('storage/purchases/'.$product->purchase->image)}}" alt="product image">
											</span>
											@endif
											{{$product->purchase->name}}
										</h2>
									</td>
									<td>{{$product->purchase->category->name}}</td>
									<td>{{AppSettings::get('app_currency', 'Rp')}}{{$product->price}}
									</td>
									<td>{{$product->purchase->quantity}}</td>
									<td>
									{{date_format(date_create($product->purchase->expiry_date),"d M, Y")}}</span>										
									</td>
								</tr>
								@endif
							@endforeach
							
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Products -->
        </div>
        <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
</body>
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Slimscroll JS -->
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Snackbar Js -->
<script src="{{ asset('assets/plugins/snackbar/snackbar.min.js') }}"></script>

<!-- Toastr Js -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/datatables-customizer.js') }}"></script>
<script src="https://kit.fontawesome.com/34b256c15e.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    });
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch (type) {
            case 'info':
                Snackbar.show({
                    text: "{{ Session::get('message') }}",
                    actionTextColor: '#fff',
                    backgroundColor: '#2196f3'
                });
                break;

            case 'warning':
                Snackbar.show({
                    text: "{{ Session::get('message') }}",
                    pos: 'top-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#e2a03f'
                });
                break;

            case 'success':
                Snackbar.show({
                    text: "{{ Session::get('message') }}",
                    pos: 'top-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#8dbf42'
                });
                break;

            case 'danger':
                Snackbar.show({
                    text: "{{ Session::get('message') }}",
                    pos: 'top-right',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a'
                });
                break;
        }
    @endif
</script>
<!-- Datatables js -->
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<!-- page js -->
@stack('page-js')

</html>
