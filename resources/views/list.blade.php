<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
  
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.3/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function searchTable() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.querySelectorAll("#userTable tr");
            
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
        function openShareModal(id) {
            document.getElementById("shareModal").style.display = "block";
            document.getElementById("shareForm").action = "/share/" + id;
        }

        function closeShareModal() {
            document.getElementById("shareModal").style.display = "none";
        }
    </script>
</head>
<body class="bg-gray-50">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">Hari Na Das</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if(session('message'))
    <div class="alert alert-success" role="alert">
 {{session('message')}}
</div>
    @endif
    <div class="container mx-auto py-6">
        <div class="bg-blue-500 text-white p-4 mb-6 text-center font-bold text-2xl rounded-lg shadow">
           List
        </div>

        <div class="flex items-center justify-between mb-6 px-4">
            <div class="text-lg font-medium text-gray-700">
                Total Video <span id="totalSubmissions" class="text-blue-600 font-bold">{{$count}}</span>
            </div>
            <!-- Button to Download Excel -->
            <a href="/dowload" class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-green-600">
                Download Excel
            </a>
        </div>
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search..." class="p-2 border border-gray-300 rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto bg-white shadow-lg rounded-lg border border-gray-200">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="py-3 px-6 text-center">Sr.No.</th>
                        <th class="py-3 px-6 text-center">Date</th>
                        <th class="py-3 px-6 text-center">Topic</th>
                        <th class="py-3 px-6 text-center">Link</th>
                        <th class="py-3 px-6 text-center">Category</th>
                        <th class="py-3 px-6 text-center">Speaker</th>
                        <th class="py-3 px-6 text-center">Experience Sharing Person</th>
                        <th class="py-3 px-6 text-center">Prabodh Swami</th>
                        <th class="py-3 px-6 text-center">File</th>
                        <th class="py-3 px-6 text-center">Share</th>
                        <th class="py-3 px-6 text-center">Operation</th>
                        
                    </tr>
                </thead>
                <tbody id="userTable" class="text-gray-700">
                    <?php
                    $num=1;
                    ?>
                    @foreach($datas as $data)
                  
                    <tr style="background-color: #b3d9ff;">
                    <td class="py-3 px-6 text-center border-b border-gray-200">{{$num++}}</td>
                    <td class="py-3 px-6 text-center border-b border-gray-200">{{$data->date}}</td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">{{$data->topic?$data->topic:'-'}}</td>
                       <td> <a href="{{$data->link}}" target="_blank " class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-green-600">Youtube</a></td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">{{$data->category?$data->category:'-'}}</td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">{{$data->speaker?$data->speaker:'-'}}</td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">{{$data->experience_sharing?$data->experience_sharing:'-'}}</td>
                        <td class="py-3 px-6 text-center border-b border-gray-200">{{$data->prabodh_swami?$data->prabodh_swami:'-'}}</td>
                        @if($data->file)
                        <td><a href="assets/{{$data->file}}" target="_blank " class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-green-600">File</a></td>
                        @else
                        <td class="py-3 px-6 text-center border-b border-gray-200"><form action="{{'file/'.$data->id}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" onchange="this.form.submit()" required  class="form-control">
                        </form></td>
                        @endif
                       <td> <a onclick="openShareModal({{$data->id}})" class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-green-600">Share</a></td>
                       <td> <a href="{{'/delete/'.$data->id}}" class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg shadow hover:bg-green-600">Delete</a></td>
                        
                    </tr>
                  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="shareModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Enter Phone Number</h2>
            <form id="shareForm" method="post">
                @csrf
                <input type="text" name="phone" required class="border p-2 w-full mb-4" placeholder="Enter phone number">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
                <button type="button" onclick="closeShareModal()" class="bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>
