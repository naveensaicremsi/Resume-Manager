<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="login_details";
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }
    else
    {
    $sql="SELECT * FROM `student` WHERE `email` LIKE '$email' AND `password` LIKE '$pass'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        echo '<div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Success!</h4>
        <p>You are logged in successfully</p>
    </div>';
    $xml = simplexml_load_file('20010107.asgn.11.aspirant_details.xml');
    if (!$xml) {
        die('Failed to load XML file');
    }
    function searchAspirants($xml, $email) {
        $results = array();
    
        // Convert SimpleXMLElement to DOMDocument
        $dom = dom_import_simplexml($xml)->ownerDocument;
    
        // Create DOMXPath object
        $xpath = new DOMXPath($dom);
    
        // Build XPath query string based on the email
        $query = "/aspirants/aspirant[email='{$email}']";
    
        // Execute the XPath query
        $nodes = $xpath->query($query);
    
        // Loop through the matching nodes and create an array of results
        foreach ($nodes as $node) {
            $result = array();
            foreach ($node->childNodes as $childNode) {
                if ($childNode->nodeType === XML_ELEMENT_NODE) {
                    $result[$childNode->nodeName] = $childNode->nodeValue;
                }
            }
            $results[] = $result;
        }
    
        // Return the results
        return $results;
    }
    $results = searchAspirants($xml, $email);
    if (isset($results) && count($results) > 0) {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><aspirants></aspirants>');
        foreach ($results as $aspirant) {
            $aspirant_xml = $xml->addChild('aspirant');
            $aspirant_xml->addChild('name', $aspirant['name']);
            $aspirant_xml->addChild('email', $aspirant['email']);
            if (!empty($aspirant->skills)) {
                if (is_string($aspirant->skills)) {
                    $skills = json_decode($aspirant->skills);
                    foreach ($skills as $skill) {
                        $skills_xml->addChild('skill', $skill);
                    }
                } else {
                    foreach ($aspirant->skills->children() as $skill) {
                        $skills_xml->addChild('skill', $skill);
                    }
                }
            }            
            $aspirant_xml->addChild('education', $aspirant['education']);
            $aspirant_xml->addChild('experience', $aspirant['experience']);
            $aspirant_xml->addChild('age', $aspirant['age']);
            $aspirant_xml->addChild('region', $aspirant['region']);
        }
        $xml->asXML('20010107.asgn.11.user.xml');
        echo '<div class="text-center mt-3">';
        echo '<a href="20010107.asgn.11.user.xml" download="20010107.asgn.11.user.xml" class="btn btn-primary">Download XML</a>';
        echo '</div>';
    }
    }
    else
    {
        echo '<div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
        <div class="mr-3">
            <strong>Warning!</strong> Please enter correct email and password.
        </div>
            <a href="20010107.asgn.11.userlogin1.php" class="btn btn-primary">Login Again</a>
    </div>';
    
    }
    }
}
else
{     
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			background-image: url('https://images.unsplash.com/photo-1485827404703-89b55fcc595a');
			background-size: cover;
			background-position: center;
		}
	</style>
</head>
<body>

<div class="container my-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header bg-primary text-white text-center">
					<h3>Resume Manager</h3>
				</div>
				<div class="card-body">
					<form action="/sai/20010107.asgn.11.userlogin1.php" method="post">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" name="email" required autocomplete="on">
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" id="password" name="password" required autocomplete="on">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			background-image: url('https://images.unsplash.com/photo-1485827404703-89b55fcc595a');
			background-size: cover;
			background-position: center;
		}
	</style>
</head>
<body>  
</body>
</html>
