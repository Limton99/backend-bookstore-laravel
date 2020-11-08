<!doctype html>
<html lang="en">
<head>
    @include('parts.head')
    <title>Admin Panel</title>
</head>
<body>

<div class="wrapper d-flex align-items-stretch">
    @include('parts.header')


    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            @if(Auth::check())
                <div class="dropdown" style="margin-right: 30px">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('logout')}}">Logout</a>

                    </div>
                </div>
                @endif
        </nav>

        <br>
        @yield('content')
     </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script>


    // $(document).ready(function() {
    //     /**
    //      * for showing edit item popup
    //      */
    //
    //     $(document).on('click', "#edit-item", function() {
    //         $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
    //
    //         var options = {
    //             'backdrop': 'static'
    //         };
    //         $('#updateBook').modal(options)
    //     })
    //
    //     // on modal show
    //     $('#updateBook').on('show.bs.modal', function() {
    //         var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
    //         var row = el.closest(".data-row");
    //
    //         // get the data
    //         var id = el.data('item-id');
    //         var name = row.children(".title").text();
    //         var description = row.children(".description").text();
    //
    //         // fill the data in the input fields
    //         $("#modal-input-id").val(id);
    //         $("#modal-input-title").val(name);
    //         $("#modal-input-description").val(description);
    //
    //     })
    //
    //     // on modal hide
    //     $('#updateBook').on('hide.bs.modal', function() {
    //         $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    //         $("#updateBook").trigger("reset");
    //     })
    // })

</script>
</body>
</html>
