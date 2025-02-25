<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">User Profile</h1>
        <a href="{{ route('/register') }}" class="btn btn-success mb-3">Add New User</a>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Pan Card</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user) 
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                    <img src="{{ asset('storage/'.$user->profile_image) }}" alt="User Image" width="50" height="50" class="rounded-circle">
                    </td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>

                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>{{ $user->pan_card }}</td>
                    <td>
                        <a href="{{ route('edit-user', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('delete-user', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-profile-form" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <!-- Form fields -->
                        <div class="mb-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mobile:</label>
                            <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">PAN Card:</label>
                            <input type="text" name="pan_card" class="form-control" value="{{ $user->pan_card }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth:</label>
                            <input type="date" name="dob" class="form-control" value="{{ $user->dob }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender:</label>
                            <select name="gender" class="form-select">
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address:</label>
                            <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Image:</label>
                            @if($user->profile_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" width="100">
                                </div>
                            @endif
                            <input type="file" name="profile_image" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

</body>

</html>
