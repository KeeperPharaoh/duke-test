<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <form class="login-form">
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword">
            </div>

            <button type="submit" class="btn btn-primary" id="loginSubmitBtn">Submit</button>
            <div class="mb-3">
                <a href="#registration" id="register">Register</a>
{{--                <a href="#saveCheck" id="login">Save Check</a>--}}
            </div>
        </form>
    </div>

    <div class="row">
        <form class="register-form">
            <div class="mb-3">
                <label for="registerEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="registerEmail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="registerName">
            </div>
            <div class="mb-3">
                <label for="resiterPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="registerPassword">
            </div>

            <button type="submit" class="btn btn-primary" id="registerSubmitBtn">Submit</button>
            <div class="mb-3">
                <a href="#login" id="login">Login</a>
                <a href="#saveCheck" id="login">Save Check</a>
            </div>
        </form>
    </div>

    <div class="row" id="savePage">

        <form>
            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file"  id="checkFile">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="uploadCheckBtn">Save</button>
            </div>
        </form>
    </div>
    <div class="row" id="checksPage">

    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination">


        </ul>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="./app.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</html>
