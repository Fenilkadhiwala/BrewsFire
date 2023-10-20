

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f1f1f1;
    }

    .formContainer {
        box-shadow: 4px 8px 16px #d7d7d7;
        margin: 15px auto; /* Updated margin value */
        padding: 20px;
        border-radius: 0px 0px 4px 4px;
    }

    input {
        box-shadow: none !important;
        outline: none;
    }

    #formHeading {
        background: #63cd9c;
        margin: -20px;
        border-radius: 4px 4px 0px 0px;
    }
</style>

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>
    <link rel="icon" type="image" href="fi1.png">
    <title>Brews Fire | Sign up</title>
    
</head>

<body>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-lg-6 mx-auto">
                    <div class="formContainer">
                        <h2 class="p-2 text-center mb-4 h4" id="formHeading">Sign Up</h2>
                        <form  method="post" action="register.php">
                            <div class="form-group mt-3">
                                <label class="mb-2" for="uname">Username  <span style="color: red;">*</span></label>
                                <input class="form-control" id="username" name="uname" type="text"
                                    placeholder="username" required />
                            </div>

                            <div class="form-group mt-3">
                                <label class="mb-2" for="uname">Email  <span style="color: red;">*</span></label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="email" required />
                            </div>

                            <div class="form-group mt-3">
                                <label class="mb-2" for="uname">Contact Number  <span style="color: red;">*</span></label>
                                <input class="form-control" id="contact" name="contact" type="text"
                                    placeholder="contact number" required />
                            </div>

                            <div class="form-group mt-3">
                                <label class="mb-2" for="psw">Create Password  <span style="color: red;">*</span></label>
                                <input class="form-control" id="password" name="psw" placeholder="password"
                                    type="password" required />
                            </div>

                            <div class="form-group mt-3">
                                <label class="mb-2" for="psw">Confirm Password  <span style="color: red;">*</span></label>
                                <input class="form-control" id="cpassword" name="psw" placeholder="confirm password"
                                    type="password" required />
                            </div>

                            <div class="form-group mt-1">
                               <a href="login.php">Back to login?</a>
                            </div>

                            <button id="submit" name="register" class="btn btn-success btn-lg w-100 mt-4">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   

    
</body>

</html>

<script>
    let btn = document.getElementById('submit');

    btn.addEventListener("click", (event) => {
        let username = document.getElementById("username").value;
        let email = document.getElementById("email").value;
        let contact = document.getElementById("contact").value;
        let password = document.getElementById("password").value;
        let cpassword = document.getElementById("cpassword").value;

        if (username === "" || email === "" || contact === "" || password === "" || cpassword === "") {
            alert("Please fill in all the required fields.");
            event.preventDefault();
        } else if (contact.length !== 10) {
            alert("Contact number should be 10 digits.");
            event.preventDefault();
        }
        else if(password!=cpassword)
        {
            alert("Password And Confirm Password Should Match")
            event.preventDefault()
        }
    });
</script>
