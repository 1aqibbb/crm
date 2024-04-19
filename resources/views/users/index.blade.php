@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts() }}


    <script>

        const showTable = () => {
            window.LaravelDataTables["user-table"].draw();
        }

        $('body').on('click', '.deleteUser', function() {
            var id = $(this).data('user-id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: "@lang('messages.sweetAlertTitle')",
                text: "@lang('messages.recoverRecord')",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "@lang('Confirm Delete')",
                cancelButtonText: "@lang('Cancel')",
                customClass: {
                    confirmButton: 'btn btn-primary mr-3',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{ route('users.destroy', ':id') }}";
                    url = url.replace(':id', id);
                    var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'Delete',
                        url: url,
                        data: {
                            '_token': token
                        },
                        success: function(response) {
                            if (response.message == "User deleted successfully") {
                                Swal.fire({
                                    title: "@lang('messages.success')",
                                    text: "@lang('messages.userDeleted')",
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                // Remove the row from the DataTable
                                window.LaravelDataTables["user-table"].row(row).remove().draw(false);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });


    </script>
@endpush
