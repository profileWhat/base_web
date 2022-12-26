<?php
session_start();
if (!isset($_SESSION["userId"])) {
    header("location: login.php");
    exit;
}

$errorMessage = $_SESSION["errorMessage"];
$successMessage = $_SESSION["successMessage"];
$_SESSION["errorMessage"] = '';
$_SESSION["successMessage"] = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid border-opacity-10 border overflow-hidden bg-light px-4">
    <div class="g-5">
        <nav class="navbar navbar-expand-lg">
            <div>
                <a class="navbar-brand px-5">Base Web</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 px-4">
                    <li class="nav-item">
                        <a class="nav-link px-4" href="login.php">Back to authorization</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Welcome <?php echo $_SESSION["userEmail"]; ?></h2>
            <h2>Please fill some values</h2>
            <form action="../controllers/UserOpinionController.php" method="post">
                <div class="form-group my-3">
                    <label>Enter your opinion about the page</label>
                    <p class="text-danger"><?php echo $errorMessage?></p>
                    <p class="text-success"><?php echo $successMessage?></p>
                    <input type="text" name="text" class="form-control" required />
                </div>
                <div class="form-group my-3">
                    <label>Enter your opinion some more</label>
                    <textarea name="areaText" class="form-control" cols="15" rows="5"></textarea>
                </div>
                <div class="form-group my-3">
                    <label>Choose your impression of the page</label>
                    <select class="form-select" size="3" name="ddList">
                        <option value="Unforgettable" selected>Unforgettable</option>
                        <option value="Amazing">Amazing</option>
                        <option value="Unbelievably">Unbelievably</option>
                    </select>
                </div>
                <div class="form-group my-3 p-4 border">
                    <label>Choose your opinion about the page: </label>
                    <input type="radio" class="form-check-input mx-3" name="radioOpinion" value="Excellent" checked/>Excellent
                    <input type="radio" class="form-check-input mx-3" name="radioOpinion" value="Good"/>Good
                    <input type="radio" class="form-check-input mx-3" name="radioOpinion" value="Beautiful" />Beautiful
                </div>
                <div class="form-group my-3 p-4 border">
                    <label>Choose your opinion some more: </label>
                    <input type="checkbox" class="form-check-input mx-3" name="checkboxOpinion[]" value="Excellent" checked/>Excellent
                    <input type="checkbox" class="form-check-input mx-3" name="checkboxOpinion[]" value="Good"/>Good
                    <input type="checkbox" class="form-check-input mx-3" name="checkboxOpinion[]" value="Beautiful" />Beautiful
                </div>
                <div class="row justify-content-end">
                    <div class="col-6 form-group">
                        <input type="submit" name="submit" class="btn btn-primary my-4 px-5" value="Submit"/>
                    </div>
                    <div class="col-6 form-group">
                        <input type="reset" name="reset" class="btn btn-primary my-4 px-5" value="Reset"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<footer class="bg-light text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Author</h5>

                <p>
                    Romanov Vladimir
                </p>
            </div>
        </div>
    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        Code on GitHub:
        <a class="text-dark" href="https://github.com/profileWhat/base_web">MyGithub</a>
    </div>
</footer>
</body>
</html>

