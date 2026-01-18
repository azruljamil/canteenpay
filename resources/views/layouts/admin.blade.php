<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Canteen Pay System</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

</head>
<body id="page-top">
        
    @yield('content')
    
    @if (session('user_role') == 2)
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Attendee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="attendee_id" name="attendee_id">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <select class="form-control" aria-label="Default select example" name="title" id="title" required>
                                <option value="" selected>Choose</option>
                                <option value="Tan Sri">Tan Sri</option>
                                <option value="Puan Sri">Puan Sri</option>
                                <option value="Datuk Sri">Datuk Sri</option>
                                <option value="Dato' Sri">Dato' Sri</option>
                                <option value="Datin Sri">Datin Sri</option>
                                <option value="Datuk">Datuk</option>
                                <option value="Dato'">Dato'</option>
                                <option value="Datin">Datin</option>
                                <option value="H.E">H.E</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                            </select>    
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" id="company" name="company" required>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" required>
                        </div>
                        <div class="form-group"> 
                            <label for="category">Category</label>
                            <select class="form-control" aria-label="Default select example" name="category" id="category" required>
                                <option value="" selected>Choose</option>
                                <option value="Ministry">Ministry</option>        
                                <option value="Trade Association">Trade Association</option>
                                <option value="Foreign Embassy">Foreign Embassy</option>
                                <option value="Trade Promotional Organization">Trade Promotional Organization</option>
                                <option value="Government Agency">Government Agency</option>
                                <option value="Media">Media</option>
                                <option value="BOD of Matrade">BOD of Matrade</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="attend_event">Attend Event</label>
                            <select class="form-control" id="attend_event" name="attend_event" required>
                                <option value="" selected>Choose</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Attendee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="attendee_id" name="attendee_id">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <select class="form-control" aria-label="Default select example" name="title" id="title" required>
                                <option value="" selected>Choose</option>
                                <option value="Tan Sri">Tan Sri</option>
                                <option value="Puan Sri">Puan Sri</option>
                                <option value="Datuk Sri">Datuk Sri</option>
                                <option value="Dato' Sri">Dato' Sri</option>
                                <option value="Datin Sri">Datin Sri</option>
                                <option value="Datuk">Datuk</option>
                                <option value="Dato'">Dato'</option>
                                <option value="Datin">Datin</option>
                                <option value="H.E">H.E</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                            </select>    
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" id="company" name="company" required>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" required>
                        </div>
                        <div class="form-group"> 
                            <label for="category">Category</label>
                            <select class="form-control" aria-label="Default select example" name="category" id="category" required>
                                <option value="" selected>Choose</option>
                                <option value="Ministry">Ministry</option>        
                                <option value="Trade Association">Trade Association</option>
                                <option value="Foreign Embassy">Foreign Embassy</option>
                                <option value="Trade Promotional Organization">Trade Promotional Organization</option>
                                <option value="Government Agency">Government Agency</option>
                                <option value="Media">Media</option>
                                <option value="BOD of Matrade">BOD of Matrade</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="attend_event">Attend Event</label>
                            <select class="form-control" id="attend_event" name="attend_event" required>
                                <option value="" selected>Choose</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> -->

    <script>
        
        $(document).ready(function() {
            $('#attendee_table').DataTable({
            "ajax": {
            "url": "/list", // Replace with your actual API URL
            "type": "GET",
            "dataSrc": ""
            },
            dom: '<"top"lBf>rt<"bottom"ip>',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            @if (session('user_role') == 2)
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'csv',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'excel',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'pdf',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'print',
                    exportOptions: { columns: ':not(:last-child)' }
                }
            ],
            @else
            buttons: [
                {
                    extend: 'copy',
                },
                {
                    extend: 'csv',
                },
                {
                    extend: 'excel',
                },
                {
                    extend: 'pdf',
                },
                {
                    extend: 'print',
                }
            ],
            @endif
            "columns": [
                { 
                    "data": "id",
                    "render": function (data, type, row, meta) {
                    return meta.row + 1;
                    }
                },
                // { "data": "title" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "wallet_balance" },
                // { "data": "company" },
                // { "data": "designation" },
                // { "data": "industry" },
                // {
                //     "data": "created_at",
                //     "render": function (data, type, row) {
                //         var date = new Date(data);
                //         var options = { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
                //         return date.toLocaleString('en-GB', options).replace(',', '');
                //     }
                // },
                // { 
                //     "data": "attend_event",
                //     "render": function (data, type, row) {
                //         return data == 1 ? 'Yes' : (data == 0 ? 'No' : 'Yes');
                //     }
                // },
                // { 
                //     "data": "redeem_on",
                //     "render": function (data, type, row) {
                //         if (data == null) {
                //             return 'No';
                //         }
                //         else {
                //             return 'Yes';
                //         }
                //     }
                // },
                @if (session('user_role') == 2)
                {
                    "data": "Action",
                    "orderable": false,
                    "render": function (data, type, row) {
                            return "<button class='btn btn-primary' onclick='editRow(" + row.id + ")' data-id='" + row.id + "'>Edit</button> <button class='btn btn-danger' onclick='removeRow(" + row.id + ")' data-id='" + row.id + "'>Delete</button>";
                    }
                }
                @endif
            ]
            });

            $('#lucky_draw_table').DataTable({
            "ajax": {
            "url": "/attendees-lucky-draw", // Replace with your actual API URL
            "type": "GET",
            "dataSrc": ""
            },
            dom: '<"top"lBf>rt<"bottom"ip>',
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'csv',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'excel',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'pdf',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'print',
                    exportOptions: { columns: ':not(:last-child)' }
                }
            ],
            "columns": [
                { 
                    "data": "id",
                    "render": function (data, type, row, meta) {
                    return meta.row + 1;
                    }
                },
                { "data": "title" },
                { "data": "name" },
                { "data": "email" },
                { "data": "phone" },
                { "data": "company" }
            ]
            });

        });

        @if (session('user_role') == 2)

        function editRow(id) {
            $.ajax({
            url: '/attendees/' + id,
            type: 'GET',
            success: function(response) {
                $('#editModal').modal('show');
                $('#editModal #attendee_id').val(response.id);
                $('#editModal #title').val(response.title).find('option[value="' + (response.title) + '"]').attr('selected', true);;
                $('#editModal #name').val(response.name);
                $('#editModal #email').val(response.email);
                $('#editModal #phone').val(response.phone);
                $('#editModal #company').val(response.company);
                $('#editModal #designation').val(response.designation);
                $('#editModal #category').val(response.category).find('option[value="' + (response.category) + '"]').attr('selected', true);
                $('#editModal #attend_event').val(response.attend_event ?? 1).find('option[value="' + (response.attend_event ?? 1) + '"]').attr('selected', true);
            }
            });
        }

        function removeRow(id) {
            if (confirm("Are you sure you want to delete this attendee?")) {
                $.ajax({
                    url: '/delete-attendee/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#attendee_table').DataTable().ajax.reload();
                    }
                });
            }
        }

        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            var id = $('#editModal #attendee_id').val();
            $.ajax({
                url: '/update-attendee/' + id,
                type: 'PUT',
                data: $('#editForm').serialize(),
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                $('#editModal').modal('hide');
                $('#attendee_table').DataTable().ajax.reload();
                }
            });
        });
        @endif
    </script>
</body>
</html>
