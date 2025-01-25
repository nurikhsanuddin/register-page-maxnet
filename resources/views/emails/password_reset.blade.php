<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
      max-width: 150px;
      display: block;
      margin: 0 auto 20px;
    }

    h2 {
      color: #333333;
      text-align: center;
    }

    p {
      color: #666666;
      line-height: 1.6;
    }

    .reset-link {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
      text-align: center;
    }

    .reset-link:hover {
      background-color: #45a049;
    }

    .nb-text {
      margin-top: 20px;
      font-size: 0.9em;
      color: #999999;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container">
    <img src="https://maxnetplus.id/img/logo.png" alt="Maxnet Logo" class="logo">
    <h2>Password Reset</h2>
    <p style="text-align: center;">Click the link below to reset your password:</p>
    <p style="text-align: center;"><a class="reset-link" href="{{ $resetLink }}">Reset Password</a></p>
    <p class="nb-text">NB: If you did not request this password reset, please ignore this link or contact Maxnet
      Customer Service at 08991306262.</p>
  </div>
</body>

</html>