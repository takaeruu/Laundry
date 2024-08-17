<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $captcha_response = $_POST['g-recaptcha-response'];

    if (!$captcha_response) {
        echo "Please complete the CAPTCHA.";
    } else {
        $secret_key = "6LdYgCAqAAAAAN8SME6rILvn3TR2fxT1lqxoFIkb";

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secret_key,
            'response' => $captcha_response
        ];
        $options = [
            'http' => [
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        $result_json = json_decode($result);
        if ($result_json && $result_json->success) {
            echo "CAPTCHA is valid. Proceed with login process.";
        } else {
            echo "Failed to verify CAPTCHA. Please try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$yogi->nama_website?></title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?= base_url('vendors/typicons/typicons.css')?>">
  <link rel="stylesheet" href="<?= base_url('vendors/css/vendor.bundle.base.css')?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url('css/vertical-layout-light/style.css')?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url('images/' . $yogi->tab_icon) ?>" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>