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
            <tr>
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
                    <form method="POST" id='delete-form-{{ $user->id }}'
                        action="{{ route('user.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" data-user-id="{{ $user->id }}"
                            class="btn btn-danger delete-btn">delete</button>
                    </form>
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
                        $('#delete-form-' + userId).submit();
                    }
                });
            });
        });
    $(document).ready(function() {
        $('.download-btn').click(function() {
            var userId = $(this).data('user-id');
            window.location.href = '/users/' + userId + '/download-pdf';
        });
    });
    </script>
@endsection
