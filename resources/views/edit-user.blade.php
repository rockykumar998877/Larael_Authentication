<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit User Profile</h1>
        <form id="edit-profile-form" enctype="multipart/form-data" class="p-4 border rounded bg-light">
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
                <a href="{{ route('/index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#edit-profile-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('update-user', $user->id) }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Profile updated successfully!');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = 'Validation errors:\n';
                            $.each(errors, function(key, value) {
                                errorMessage += value + '\n';
                            });
                            alert(errorMessage);
                        } else {
                            alert('An error occurred while updating the profile.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
