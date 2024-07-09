<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application - Pokhara</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Arial', sans-serif;
        }
        .application-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 50px auto;
        }
        .application-form h2 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group label {
            font-weight: 600;
            color: #555;
        }
        .form-control, .form-control-file {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid green;
            color: green;
            display: none;
            border-radius: 5px;
        }
        .post-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .small-section-tittle h4 {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }
        .post-details ul {
            list-style: none;
            padding: 0;
        }
        .post-details ul li {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="application-form" id="applicationForm" style="display: none;">
        <h2>Job Application Form</h2>
        <form id="jobApplicationForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="resume">Resume:</label>
                <input type="file" class="form-control-file" id="resume" name="resume" required>
            </div>
            <div class="form-group">
                <label for="cover-letter">Cover Letter:</label>
                <textarea class="form-control" id="cover-letter" name="cover_letter" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn submit-btn">Submit Application</button>
        </form>
    </div>
    
    <div class="message" id="successMessage">
        Application submitted successfully!
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('applyButton').addEventListener('click', function() {
        fetch('check_login.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedIn) {
                document.getElementById('applicationForm').style.display = 'block';
            } else {
                let loginPrompt = confirm('You need to log in to apply for this job. Are you logged in?');
                if (loginPrompt) {
                    window.location.href = 'login.html';
                }
            }
        })
        .catch(error => console.error('Error:', error));
    });

    document.getElementById('jobApplicationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(this);

        fetch('apply_job.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('successMessage').style.display = 'block';
                document.getElementById('applicationForm').style.display = 'none';
            } else {
                alert('Failed to submit application. Please try again.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>


<div class="container">
    <div class="application-form">
        <h2>Job Application Form</h2>
        <form action="submit_registration.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="resume">Resume:</label>
                <input type="file" class="form-control-file" id="resume" name="resume" required>
            </div>
            <div class="form-group">
                <label for="cover-letter">Cover Letter:</label>
                <textarea class="form-control" id="cover-letter" name="cover_letter" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn submit-btn">Submit Application</button>
        </form>
    </div>
    <div class="message" id="successMessage">
            Application submitted successfully!
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


