<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h1>Login</h1>
<div class="form-container">
        <form >
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="text" name="mobile" class="form-control" id="mobile">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="button" class="btn btn-primary" id="login">Login</button>
        </form>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#login").on('click', function(){
      
            const mobile = $("#mobile").val();
            const password = $("#password").val();
            
            console.log("hey ram"); // Debugging

            $.ajax({
                url: '/login',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    mobile: mobile,
                    password: password
                }),
                success: function(response){
                    alert('Login successfully...');
                    console.log(response);
                    localStorage.setItem('api_token',response.token);
                    window.location.href = "/";
                },
                error: function(xhr, status, error){
                    alert('Error: ' + xhr.responseText);
                }
            });
        
        });
    });
</script>

</body>
</html>