<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* General styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Container styles */
.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
}

/* Heading styles */
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Form group styles */
.form-group {
    margin-bottom: 20px;
}

/* Label styles */
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

/* Input and textarea styles */
.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

/* Input focus styles */
.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color: #007BFF;
    outline: none;
}

/* Button styles */
button {
    width: 100%;
    padding: 15px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Button hover effect */
button:hover {
    background-color: #0056b3;
}

/* Result styles */
.result {
    margin-top: 20px;
    padding: 15px;
    background-color: #e9f7ef;
    border-left: 5px solid #28a745;
    border-radius: 5px;
    display: none;
    color: #155724;
}

.result h3 {
    margin-top: 0;
    margin-bottom: 10px;
}

</style>

<body>
    <div class="container">
        <h2>Post a Job</h2>
        <form id="jobForm">
            <div class="form-group">
                <label for="jobTitle">Job Title:</label>
                <input type="text" id="jobTitle" name="jobTitle" required>
            </div>
            <div class="form-group">
                <label for="companyName">Company Name:</label>
                <input type="text" id="companyName" name="companyName" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="jobType">Job Type:</label>
                <select id="jobType" name="jobType" required>
                    <option value="">Select Job Type</option>
                    <option value="Full-Time">Full-Time</option>
                    <option value="Part-Time">Part-Time</option>
                    <option value="Contract">Contract</option>
                    <option value="Temporary">Temporary</option>
                    <option value="Internship">Internship</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="Open">Open</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jobDescription">Job Description:</label>
                <textarea id="jobDescription" name="jobDescription" rows="4" required></textarea>
            </div>
            <button type="submit">Submit</button>
            
            
        </form>
        <div id="result" class="result"></div>
    </div>
    <script src="script.js">

    
    document.getElementById('jobForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const jobTitle = document.getElementById('jobTitle').value;
    const companyName = document.getElementById('companyName').value;
    const location = document.getElementById('location').value;
    const jobType = document.getElementById('jobType').value;
    const status = document.getElementById('status').value;
    const jobDescription = document.getElementById('jobDescription').value;

    const jobData = {
        jobTitle,
        companyName,
        location,
        jobType,
        status,
        jobDescription
    };

    // Example POST request to save data to the backend
    fetch('https://example.com/api/jobs', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jobData)
    })
    .then(response => response.json())
    .then(data => {
        // Display success message
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = `
            <h3>Job Posted Successfully!</h3>
            <p><strong>Job Title:</strong> ${jobTitle}</p>
            <p><strong>Company Name:</strong> ${companyName}</p>
            <p><strong>Location:</strong> ${location}</p>
            <p><strong>Job Type:</strong> ${jobType}</p>
            <p><strong>Status:</strong> ${status}</p>
            <p><strong>Job Description:</strong> ${jobDescription}</p>
        `;
        resultDiv.style.display = 'block';

        // Clear the form
        document.getElementById('jobForm').reset();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error posting the job. Please try again.');
    });
});
</script>
</body>

</html>
