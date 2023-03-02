<?php

if(isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $education = $_POST['education'];
  $skills = $_POST['skills'];
  $experience = $_POST['experience'];
  $age = $_POST['age'];
  $region = $_POST['region'];

  $xml = new DOMDocument('1.0', 'UTF-8');
  $xml->formatOutput = true;
  $xml->preserveWhiteSpace = false;

  if(!file_exists('aspirants.xml')) {
    $aspirants = $xml->createElement('aspirants');
    $xml->appendChild($aspirants);
  } else {
    $xml->load('aspirants.xml');
    $aspirants = $xml->getElementsByTagName('aspirants')->item(0);
  }

  $aspirant = $xml->createElement('aspirant');
  $aspirants->appendChild($aspirant);

  $name_element = $xml->createElement('name', $name);
  $aspirant->appendChild($name_element);

  $email_element = $xml->createElement('email', $email);
  $aspirant->appendChild($email_element);

  $education_element = $xml->createElement('education', $education);
  $aspirant->appendChild($education_element);

  $skills_element = $xml->createElement('skills', $skills);
  $aspirant->appendChild($skills_element);

  $experience_element = $xml->createElement('experience', $experience);
  $aspirant->appendChild($experience_element);

  $age_element = $xml->createElement('age', $age);
  $aspirant->appendChild($age_element);

  $region_element = $xml->createElement('region', $region);
  $aspirant->appendChild($region_element);

  $xml->save('aspirants.xml');
}

?>
