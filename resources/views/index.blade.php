<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- TailwindCSS (optional for extra styling) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->

   
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">Hari Na Das</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/list">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @if(session('message'))
    <div class="alert alert-success" role="alert">
 {{session('message')}}
</div>
    @endif
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center fw-bold">Manual Entry</h4>
            </div>
            <div class="card-body">

            <form action="manually_form" method="post" enctype="multipart/form-data">
                    @csrf
                   <label for="Topic" class="form-label fw-bold">Topic Name</label>
                   <input type="text" name="topic" id="topic"  class="form-control">
                   <label for="link" class="form-label fw-bold">Youtube Link</label>
                   <input type="text" name="link" id="link"  class="form-control">
                   <label for="category" class="form-label fw-bold">Video Category</label>
                   <select name="category" id="category"  class="form-control">
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                    <option value="unlisted">Unlisted</option>
                   </select>
                   <label for="speaker" class="form-label fw-bold">Speaker Name</label>
                   <input type="text" id="speaker" name="speaker"  class="form-control">
                   <label for="sharing_person" class="form-label fw-bold">Experience sharing person</label>
                   <input type="text" id="sharing_person" name="sharing_person"  class="form-control">
                   <label for="prabodh_swami" class="form-label fw-bold">Prabodh swami</label>
                   <select name="prabodh_swami" id="prabodh_swami"  class="form-control">
                    <option value="available">Available</option>
                    <option value="not_available">No Available</option>
                    <option value="goshthi">Goshthi</option>
                   </select>
                   <label for="date" class="form-label fw-bold">Date</label>
                   <input type="date" id="date" name="date"  class="form-control">
                   <label for="file" class="form-label fw-bold">File</label>
                   <input type="file" id="file" name="file"  class="form-control">
                   <br>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
<br><br><br>

                <a href="https://docs.google.com/spreadsheets/d/1wxJDcbfZnruTG3ZuWl8LYW8EpqDZK48a/edit?usp=drive_link&ouid=109161218020310229957&rtpof=true&sd=true" target="_blank "><button  class="btn btn-primary">Sample Excel File</button></a><br><br>
                <form action="excel" method="post"  enctype="multipart/form-data">
                    @csrf
                    <label for="excel">Upload Excel</label>
                    <input type="file" name="excel" id="excel" required><br><br>
                    <button type="submit" class="btn btn-primary">
                       Submit Excel
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>