<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1>Register Page</h1>
    <div class="container mt-4">
        <!-- <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> -->
        <form id="my-form">
            @csrf

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required value="{{ old('first_name') }}">
                @error('first_name')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}">
                @error('last_name')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
                @error('email')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required value="{{ old('password') }}">
                @error('password')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" id="mobile" name="mobile" class="form-control" required value="{{ old('mobile') }}">
                @error('mobile')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="pan_card" class="form-label">Pan Card</label>
                <input type="text" id="pan_card" name="pan_card" class="form-control" required value="{{ old('pan_card') }}">
                @error('pan_card')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" required value="{{ old('dob') }}">
                @error('dob')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-control" required value="{{ old('gender') }}">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                @error('gender')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" value="{{ old('address') }}"></textarea>
                @error('address')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" id="profile_image" name="profile_image" class="form-control" value="{{ old('profile_image') }}">
                @error('profile_image')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" id="btnSubmit">Register</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#my-form').on('submit', function(e) {
            e.preventDefault(); 

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('/register') }}', 
                type: 'POST',
                data: formData,
                processData: false, 
                contentType: false,
                success: function(response) {
                    console.log(response);
                    alert('Form submitted successfully!');
                    window.location.href = "{{ route('/index') }}"; 
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while submitting the form.');
                }
            });
        });
    });
</script>
   
</body>

</html>
