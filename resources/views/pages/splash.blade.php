<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Kazipoa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1A6EFF;
            --secondary: #0D1B2A;
            --accent: #FF6B35;
            --white: #ffffff;
            --bg: #F0F4FB;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito Sans', sans-serif;
            background-color: var(--bg);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .splash-container {
            text-align: center;
            animation: fadeIn 1s ease-out;
        }
        .logo-box {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary) 0%, #6C63FF 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            font-weight: 900;
            margin: 0 auto 24px;
            box-shadow: 0 10px 30px rgba(26,110,255,0.4);
            animation: bounce 2s infinite ease-in-out;
        }
        h1 {
            font-size: 36px;
            color: var(--secondary);
            margin-bottom: 8px;
            font-weight: 900;
        }
        p {
            color: #607D8B;
            font-size: 18px;
            margin-bottom: 40px;
        }
        .btn-start {
            background-color: var(--primary);
            color: white;
            padding: 16px 48px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            transition: all 0.3s;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(26,110,255,0.3);
        }
        .btn-start:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(26,110,255,0.4);
            background-color: #0F4FCC;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .features {
            display: flex;
            gap: 20px;
            margin-top: 60px;
            justify-content: center;
        }
        .feature-item {
            background: white;
            padding: 20px;
            border-radius: 16px;
            width: 150px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .feature-item i {
            font-size: 24px;
            color: var(--primary);
            margin-bottom: 10px;
        }
        .feature-item div {
            font-size: 14px;
            font-weight: 700;
            color: var(--secondary);
        }
    </style>
</head>
<body>
    <div class="splash-container">
        <div class="logo-box">K</div>
        <h1>Kazipoa</h1>
        <p>Smart Service Marketplace System</p>
        
        <a href="{{ route('login') }}" class="btn-start">Get Started <i class="fa fa-arrow-right"></i></a>

        <div class="features">
            <div class="feature-item">
                <i class="fa fa-calendar-check"></i>
                <div>Easy Booking</div>
            </div>
            <div class="feature-item">
                <i class="fa fa-bolt"></i>
                <div>KaziLive</div>
            </div>
            <div class="feature-item">
                <i class="fa fa-shield-check"></i>
                <div>Verified Pros</div>
            </div>
        </div>
    </div>
</body>
</html>
