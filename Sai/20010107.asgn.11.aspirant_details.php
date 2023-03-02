<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $skills = $_POST['skills'] ?? [];
    $education = $_POST['education'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $age = $_POST['age'] ?? '';
    $region = $_POST['region'] ?? '';

    // Load existing XML document or create a new one
    $xml = file_exists('20010107.asgn.11.aspirant_details.xml') ? simplexml_load_file('20010107.asgn.11.aspirant_details.xml') : new SimpleXMLElement('<aspirants></aspirants>');
    
    // Append new aspirant to the XML document
    $aspirant = $xml->addChild('aspirant');
    $aspirant->addChild('name', $name);
    $aspirant->addChild('email', $email);
    $skillsElement = $aspirant->addChild('skills');
    foreach ($skills as $skill) {
        $skillsElement->addChild('skill', $skill);
    }
    $aspirant->addChild('education', $education);
    $aspirant->addChild('experience', $experience);
    $aspirant->addChild('age', $age);
    $aspirant->addChild('region', $region);
    $xml->asXML('20010107.asgn.11.aspirant_details.xml');
    $newAspirant = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="20010107.asgn.11.styles.xsl" ?><aspirants></aspirants>');
    $aspirant = $newAspirant->addChild('aspirant');
    $aspirant->addChild('name', $name);
    $aspirant->addChild('email', $email);
    $skillsElement = $aspirant->addChild('skills');
    foreach ($skills as $skill) {
        $skillsElement->addChild('skill', $skill);
    }
    $aspirant->addChild('education', $education);
    $aspirant->addChild('experience', $experience);
    $aspirant->addChild('age', $age);
    $aspirant->addChild('region', $region);
    $newAspirant->asXML('20010107.asgn.11.new_aspirant_details.xml');
    echo '
    <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Success!</h4>
    <p>Your details have been submitted successfully.</p>
    <p><a href="20010107.asgn.11.new_aspirant_details.xml" download>Download XML file</a></p>
    </div>
    ';
} 
else
{
  echo '
  <!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload Details</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</style>
</head>
<body>
  <div class="container mt-4">
  <h2>Aspirant Details</h2>
  <form action="/sai/20010107.asgn.11.aspirant_details.php" method="post">
    <!-- Form fields go here -->
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter your name" required name="name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter your email" required name="email">
    </div>
    <div class="form-group">
    <label for="skills">Skills:</label>
    <div>
      <div class="form-check">
          <input class="form-check-input" type="checkbox" id="webdev" name="skills[]" value="Web Development">
          <label class="form-check-label" for="webdev">Web Development</label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="checkbox" id="mobiledev" name="skills[]" value="Mobile Development">
          <label class="form-check-label" for="mobiledev">Mobile Development</label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="checkbox" id="datasci" name="skills[]" value="Data Science">
          <label class="form-check-label" for="datasci">Data Science</label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="checkbox" id="uiux" name="skills[]" value="UI/UX Design">
          <label class="form-check-label" for="uiux">UI/UX Design</label>
      </div>
      </div>
    </div>
      <div class="form-group">
      <label for="education">Education Qualification:</label>
      <select class="form-control" id="education" name="education">
          <option>MTech</option>
          <option>BTech</option>
          <option>BBA</option>
          <option>BA</option>
          <option>Others</option>
      </select>
      </div>

      <div class="form-group">
        <label for="experience">Experience:</label>
        <input type="number" class="form-control" id="experience" placeholder="Enter your experience in years" name="experience" required>
      </div>
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" class="form-control" id="age" placeholder="Enter your age" required name="age" required>
      </div>
      <div class="form-group">
        <label for="region">Region:</label>
        <select class="form-control" id="region" name="region" required>
          <option>North</option>
          <option>South</option>
          <option>East</option>
          <option>West</option>
          <option>Others</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
</body>
</html>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Upload Details</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</style>
</head>
  <body></body>
  </html>