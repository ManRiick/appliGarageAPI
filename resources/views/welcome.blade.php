<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur l'API d'appliGarage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 60px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 40px 30px;
            text-align: center;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        p {
            color: #555;
            margin-bottom: 30px;
        }
        .info {
            background: #eaf6fb;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin-bottom: 20px;
            color: #2980b9;
        }
        .routes {
            text-align: left;
            margin: 0 auto;
            display: inline-block;
        }
        .routes li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur l'API d'appliGarage</h1>
        <p>
            Cette API permet de gérer les services de votre garage.<br>
            
        </p>
        <p style="margin-top: 40px; color: #aaa; font-size: 0.9em;">
            &copy; {{ date('Y') }} GarageAPI.
        </p>
    </div>
</body>
</html>