<?php
// Load the XML file
$xml = simplexml_load_file('20010107.asgn.11.aspirant_details.xml');
if (!$xml) {
    die('Failed to load XML file');
}
function searchAspirants($xml, $criteria) {
    $results = array();

    // Convert SimpleXMLElement to DOMDocument
    $dom = dom_import_simplexml($xml)->ownerDocument;

    // Create DOMXPath object
    $xpath = new DOMXPath($dom);

    // Build XPath query string based on the criteria
    $query = '/aspirants/aspirant';

    foreach ($criteria as $key => $value) {
        if ($key === 'skills') {
            if (is_array($value)) {
                foreach ($value as $skill) {
                    if (!empty($skill)) {
                        $query .= "[skills[contains(skill, '{$skill}')]]";
                    }
                }
            } elseif (!empty($value)) {
                $query .= "[skills[contains(skill, '{$value}')]]";
            }
        } else {
            if (!empty($value)) {
                $query .= "[{$key}='{$value}']";
            }
        }
    }

    // Execute the XPath query
    $nodes = $xpath->query($query);

    // Convert DOMNodeList to array of SimpleXMLElements
    foreach ($nodes as $node) {
        $results[] = simplexml_import_dom($node);
    }

    return $results;
}




// If the form has been submitted via the POST method, search for aspirants based on the form criteria
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $criteria = array(
        'skills' => isset($_POST['skills']) && $_POST['skills'] !== '' ? $_POST['skills'] : null,
        'education' => !empty($_POST['education']) ? $_POST['education'] : null,
        'experience' => isset($_POST['experience']) && $_POST['experience'] !== '' ? $_POST['experience'] : null,
        'age' => isset($_POST['age']) && $_POST['age'] !== '' ? $_POST['age'] : null,
        'region' => isset($_POST['region']) && $_POST['region'] !== '' ? $_POST['region'] : null
      );
      
  // Search for aspirants based on the criteria
  $results = searchAspirants($xml, $criteria);
  
}

// Display the search form
?>
<!DOCTYPE html>
<html>
<head>
  <title>Search Form</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
.centered {
  text-align: center;
}
</style>
</head>
<?php
// If search results have been generated, display them as HTML
if (isset($results) && count($results) > 0) {
  echo '<div class="centered">
  <h2>Search Results</h2>
</div>';
  echo '<div class="table-responsive">';
  echo '<table class="table table-striped table-bordered table-hover">';
  echo '<thead class="thead-light">';
  echo '<tr><th>Name</th><th>Email</th><th>Skills</th><th>Education</th><th>Experience</th><th>Age</th><th>Region</th></tr>';
  echo '</thead>';
  echo '<tbody>';
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><aspirants></aspirants>');
  foreach ($results as $aspirant) {
    $aspirant_xml = $xml->addChild('aspirant');
    echo '<tr>';
    $aspirant_xml->addChild('name', $aspirant->name);
    echo '<td>' . $aspirant->name . '</td>';
    $aspirant_xml->addChild('email', $aspirant->email);
    echo '<td>' . $aspirant->email . '</td>';

    // Concatenate the skills into a string
    $skills_xml = $aspirant_xml->addChild('skills');
    $skills_str = '';
    foreach ($aspirant->skills->children() as $skill) {
        $skills_xml->addChild('skill', $skill);
        $skills_str .= $skill . ', ';
    }
    $skills_str = rtrim($skills_str, ', ');
    echo '<td>' . $skills_str . '</td>';
    $aspirant_xml->addChild('education', $aspirant->education);
    echo '<td>' . $aspirant->education . '</td>';
    $aspirant_xml->addChild('experience', $aspirant->experience);
    echo '<td>' . $aspirant->experience . '</td>';
    $aspirant_xml->addChild('age', $aspirant->age);
    echo '<td>' . $aspirant->age . '</td>';
    $aspirant_xml->addChild('region', $aspirant->region);
    echo '<td>' . $aspirant->region . '</td>';
    echo '</tr>';
  }
  $xml->asXML('20010107.asgn.11.search_results.xml');
  echo 'Number of results: ' . count($results);


  echo '</tbody>';
  echo '</table>';
  echo '<div class="text-center mt-3">';
  echo '<a href="20010107.asgn.11.search_results.xml" download="20010107.asgn.11.search_results.xml" class="btn btn-primary">Download Results as XML</a>';
  echo '</div>';
  echo '</div>';
} else {
  ?>
  <!DOCTYPE html>
<html>
<head>
  <title>Search Form</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
.centered {
  text-align: center;
  padding: 20px;
  margin: 20px 0;
}
</style>
</head>
<body>
<h1 class="centered">Search Aspirants</h1>
  <div class="container">
    <form method="post" action="/sai/20010107.asgn.11.search.php" target="_blank">
      <div class="form-group">
        <label for="skills">Skills:</label>
        <input type="text" name="skills" id="skills" class="form-control">
      </div>

      <div class="form-group">
        <label for="education">Education:</label>
        <input type="text" name="education" id="education" class="form-control">
      </div>

      <div class="form-group">
        <label for="experience">Experience:</label>
        <input type="text" name="experience" id="experience" class="form-control">
      </div>

      <div class="form-group">
        <label for="age">Age:</label>
        <input type="text" name="age" id="age" class="form-control">
      </div>

      <div class="form-group">
        <label for="region">Region:</label>
        <input type="text" name="region" id="region" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>
</body>
</html>
<?php
}
?>


