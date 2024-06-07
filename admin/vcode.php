<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Authentication Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="aresources/logo.png" />
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow col-8">
            <h3 class="text-center mb-4">Verification Code</h3>
            <form id="authForm" method="POST" action="authProcessNext.php">
                <div class="form-group">
                    <label for="authInput"></label>
                    <input type="text" class="form-control" id="authInput" name="code" placeholder="Verification code" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Authenticate</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>