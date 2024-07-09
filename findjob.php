<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Job in Pokhara</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        .search-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .search-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 700;
            transition: background-color 0.5s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="search-box">
        <h2>Find Job </h2>
        <form id="jobSearchForm" onsubmit="handleFormSubmit(event)">
            <div class="form-group">
                <input type="text" id="jobTitle" class="form-control" placeholder="Job Title or keyword" required>
            </div>
            <div class="form-group">
                <input type="text" id="jobType" class="form-control" placeholder="Type of Job (e.g., Full-time, Part-time)" required>
            </div>
            <div class="form-group">
                <textarea id="jobDescription" class="form-control" rows="3" placeholder="Job Description" required></textarea>
            </div>
            <div class="form-group">
                <select name="location" id="location" class="form-control" required>
                    <option value="Pokhara">Pokhara</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Find Job</button>
                <a href="job_details.php">Find job</a>
            </div>
        </form>
    </div>
</div>

<script>
    function handleFormSubmit(event) {
        event.preventDefault(); // Prevent default form submission
        
        // Get the values entered by the user
        var jobTitle = document.getElementById("jobTitle").value;
        var jobType = document.getElementById("jobType").value;
        var jobDescription = document.getElementById("jobDescription").value;
        var location = document.getElementById("location").value;
        
        // Construct the URL with query parameters
        var url = 'https://www.jobsnepal.com/search?q=' + encodeURIComponent(jobTitle)
                  + '&type=' + encodeURIComponent(jobType)
                  + '&description=' + encodeURIComponent(jobDescription)
                  + '&location=' + encodeURIComponent(location);
        
        // Redirect to the constructed URL
        window.location.href = url;
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
