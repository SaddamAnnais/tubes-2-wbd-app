<?php
function getImage($imageUrl, $authToken)
{
  $options = [
      'http' => [
          'header' => "Authorization: Bearer $authToken"
      ]
  ];
  
  $context = stream_context_create($options);
  $imageData = file_get_contents($imageUrl, false, $context);
  $imageBase64 = base64_encode($imageData);
  $imageSrc = 'data:image/jpeg;base64,' . $imageBase64;
  echo $imageSrc;
}
?>