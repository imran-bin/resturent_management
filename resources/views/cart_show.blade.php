<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <title>Klassy Cafe - Restaurant HTML Template</title>
    <!--
    
TemplateMo 558 Klassy Cafe

https://templatemo.com/tm-558-klassy-cafe

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->

    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">

                        <a href="index.html" class="logo">
                            <img src="assets/images/klassy-logo.png" align="klassy cafe html template">
                        </a>

                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>


                            <li class="scroll-to-section"><a href="#menu">Menu</a></li>
                            <li class="scroll-to-section"><a href="#chefs">Chefs</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Features</a>
                                <ul>
                                    <li><a href="#">Features Page 1</a></li>
                                    <li><a href="#">Features Page 2</a></li>
                                    <li><a href="#">Features Page 3</a></li>
                                    <li><a href="#">Features Page 4</a></li>
                                </ul>
                            </li>

                            <li class="scroll-to-section"><a href="#reservation">Contact Us</a></li>
                            @if ($count > 0)
                                <li class="scroll-to-section"><a
                                        href="{{ route('user.cart.info', Auth::user()->id) }}">Cart[{{ $count }}]</a>
                                </li>
                            @else
                                <li class="scroll-to-section"><a href="#">Cart[0]</a></li>
                            @endif
                            <li>
                                @if (Route::has('login'))
                                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                        @auth
                                <li>
                                    <x-app-layout>

                                    </x-app-layout>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}"
                                        class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a></li>

                                @if (Route::has('register'))
                                    <li> <a href="{{ route('register') }}"
                                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                    </li>
                                @endif
                            @endauth
                </div>
                @endif
                </li>
                </ul>

                <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Footer Start ***** -->
    <div class="table-responsive   w-75 mx-auto">
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Food Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('user.order.confirm') }}" method="POST">
                    @csrf
                    @forelse ($data as $key => $data)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                                <input type="text" name="foodname[]" id="" value=" {{ $data->food->title }}"
                                    hidden>
                                {{ $data->food->title }}
                            </td>


                            <td>
                                <input type="text" name="quantity[]" id=""
                                    value="    {{ $data->quantity }}" hidden>
                                {{ $data->quantity }}
                            </td>
                            <td>
                                <input type="text" name="price[]" id="" value="    {{ $data->price }}"
                                    hidden>
                                {{ $data->price }}
                            </td>


                            <td>

                                <a class="btn btn-sm btn-danger"
                                    href="{{ route('user.cart.remove', $data->id) }}">Remove</a>
                            </td>
                        </tr>


                        <div align="center">
                            <button class="btn btn-primary text-danger" type="button" id="order">Order Now</button>
                        </div>

                        <div align="center " id="apear" style="display: none">
                            <div>
                                <label for="">Name</label>
                                <input type="text" name="name" id="" placeholder="name">
                            </div>
                            <div class="my-3">
                                <label for="">Phone</label>
                                <input type="number" name="phone" id="" placeholder="phone">
                            </div>
                            <div>
                                <label for="">Address</label>
                                <input type="text" name="address" id="" placeholder="address">
                            </div>
                            <div>
                                <input class="btn btn-sm btn-success mt-3 text-danger" type="submit" name=""
                                    id="" value="Order confirm">
                                <button class="btn btn-danger" type="button" id="close">Close</button>
                            </div>
                            <div>

                            </div>

                        </div>

                    @empty
                        <h1>No Data Found</h1>
                    @endforelse


            </tbody>

        </table>
    </div>


    </form>

    <script>
        $("#order").click(
            function() {
                $("#apear").show();
                $("#order").hide();
            }
        );
        $("#close").click(function() {
            $("#apear").hide();
            $("#order").show();

        });
    </script>


    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script>
        $(function() {
            var selectedClass = "";
            $("p").click(function() {
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("." + selectedClass).fadeOut();
                setTimeout(function() {
                    $("." + selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);

            });
        });
    </script>
</body>

</html>
