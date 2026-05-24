<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Kazipoa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1A6EFF;
            --secondary: #0D1B2A;
            --bg: #F0F4FB;
            --white: #ffffff;
            --error: #F03E3E;
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
        }
        .login-card {
            background: var(--white);
            padding: 40px;
            border-radius: 24px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            text-align: center;
        }
        .logo-small {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, #6C63FF 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            font-weight: 900;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(26,110,255,0.3);
        }
        h2 {
            font-size: 24px;
            color: var(--secondary);
            margin-bottom: 8px;
            font-weight: 900;
        }
        p {
            color: #607D8B;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #607D8B;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1.5px solid #E6EAF2;
            font-family: inherit;
            font-size: 15px;
            box-sizing: border-box;
            transition: all 0.3s;
            background-color: #F8FAFD;
        }
        input:focus {
            outline: none;
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(26,110,255,0.1);
        }
        .btn-login {
            width: 100%;
            background-color: var(--primary);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgba(26,110,255,0.2);
        }
        .btn-login:hover {
            background-color: #0F4FCC;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26,110,255,0.3);
        }
        .error-msg {
            color: var(--error);
            font-size: 13px;
            margin-bottom: 15px;
            text-align: left;
            background: #FFF0F0;
            padding: 10px;
            border-radius: 8px;
            border-left: 3px solid var(--error);
        }
        .footer-text {
            margin-top: 25px;
            font-size: 13px;
            color: #A0AEC0;
        }
        .footer-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-small">K</div>
        <h2>Welcome Back</h2>
        <p>Login to your Kazipoa admin account</p>

        @if($errors->any())
            <div class="error-msg">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email', 'admin@kazipoa.com') }}" required placeholder="admin@kazipoa.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">Login to Dashboard</button>
        </form>

        <div class="footer-text">
            Don't have an account? <a href="#">Contact Support</a>
        </div>
    </div>
</body>
</html>
