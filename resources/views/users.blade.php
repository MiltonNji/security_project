@role('admin')
<h1>Registered Users</h1>

<<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach ($user->roles as $role)
                    {{ $role->name }}
                @endforeach
            </td>
            <td>
                <!-- Add the delete button here -->
                @can('delete users')
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
    <p>You are not authorized to access this page.</p>
    @endrole
