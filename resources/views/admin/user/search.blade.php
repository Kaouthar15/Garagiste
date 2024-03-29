<table class="table table-striped">
    @include('layouts.partials.messages')
    <thead>
        <tr>
            <th>
                Username
            </th>

            <th>
                Phone Number
            </th>
            <th>
                Email
            </th>
            <th>
                State
            </th>
            <th>
            </th>
            <th>
            </th>
            <th>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>

                {{-- <td>{{ ++$i }}</td>  --}}
                <td class="py-1">
                    {{ $user->username }}
                </td>
                <td>
                    {{ $user->phoneNumber }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    @if ($user->isClient && $user->isMechanic)
                        Both
                    @elseif($user->isClient)
                        Client
                    @elseif($user->isMechanic)
                        Mechanic
                    @endif
                </td>
                <td>
                    <a class="btn btn-secondary" href="{{ route('user.edit', $user->id) }}">edit</a>
                </td>
                <td>
                    <a class="btn btn-success" href="{{ route('admin.details', $user->id) }}">show</a>
                </td>
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
    </script>
@endsection
