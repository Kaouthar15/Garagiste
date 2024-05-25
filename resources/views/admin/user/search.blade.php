<table class="table table-striped">
    @include('layouts.partials.messages')
    <thead>
        <tr>
            <th>Download</th>
            <th>Username</th>
            <th>Phone Number</th>
            <th>State</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-warning">Import User Data </button>
                <a class="btn btn-primary float-end" href="{{ route('users.export') }}">Export User Data</a>
            </form>
        </tr>
        @foreach ($users as $user)
            <tr id="user-row-{{ $user->id }}">
                <td>
                    <i class="fa fa-download download-btn" href="{{ route('users.download-pdf', ['user' => $user->id]) }}"  data-user-id="{{ $user->id }}" style="font-size:30px; cursor: pointer;"></i>
                </td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->phoneNumber }}</td>
                <td>
                    @if ($user->isClient && $user->isMechanic)
                        Both
                    @elseif($user->isClient)
                        Client
                    @elseif($user->isMechanic)
                        Mechanic
                    @endif
                </td>
                <td><a class="btn btn-secondary" href="{{ route('user.edit', $user->id) }}">edit</a></td>
                <td><a class="btn btn-success" href="{{ route('admin.details', $user->id) }}">show</a></td>
                <td>
                    <button type="button" data-user-id="{{ $user->id }}" class="btn btn-danger delete-btn">delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{!! $users->links() !!}

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function(event) {
                event.preventDefault();
                var userId = $(this).data('user-id');
                var row = $('#user-row-' + userId);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('user') }}/' + userId,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                if(response.success) {
                                    row.remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'User has been deleted.',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was an error deleting the user.',
                                        'error'
                                    );
                                }
                            },
                            error: function(response) {
                                Swal.fire(
                                    'Error!',
                                    'There was an error deleting the user.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
            $('.download-btn').click(function() {
                var userId = $(this).data('user-id');
                window.location.href = '/users/' + userId + '/download-pdf';
            });
        });
    </script>
@endsection
