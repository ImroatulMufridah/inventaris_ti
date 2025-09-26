<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP Error</title>
    <style type="text/css">
        body {
            background: #fff;
            color: #333;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #d9534f;
        }

        .container {
            margin: 40px auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #eee;
            background: #fafafa;
        }

        .message {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>PHP Error</h1>
        <div class="message">
            <p><?php echo isset($message) ? $message : 'An error occurred.'; ?></p>
            <p><?php echo isset($severity) ? 'Severity: ' . $severity : ''; ?></p>
            <p><?php echo isset($filepath) ? 'File: ' . $filepath : ''; ?></p>
            <p><?php echo isset($line) ? 'Line: ' . $line : ''; ?></p>
        </div>
    </div>
</body>

</html>