<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <title>File Successfully Uploaded</title>
</head>

<body style="border: solid black 1px; text-align: center;">
    <header style="border: solid black 1px; min-width: 100%;">
        <div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; min-width: 100%;">
                <a class="navbar-brand" href="#">CS3337</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Upload</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div>
            <h1 class = "bg-success" style="text-align: center; padding: 1em; padding-top: 2.5em;">Congratulations Your
                File Has Been Uploaded!</h1>
        </div>
    </header>
    <main style="text-align: center; min-width: 50%; margin-right:200px; margin-left:200px;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><h3>Information regarding your upload:</h3></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" >name: <?= esc($uploaded_fileinfo->getBasename()) ?></li>
                <li class="list-group-item" >size: <?= esc($uploaded_fileinfo->getSizeByUnit('kb')) ?> KB</li>
                <li class="list-group-item" >extension: <?= esc($uploaded_fileinfo->guessExtension()) ?></li>
            </ul>
            <div class="card-body">
                <p><?= anchor('upload', 'Upload Another File!') ?></p>
                <button><a href = "/media">To Media Page</a></button>
            </div>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>
