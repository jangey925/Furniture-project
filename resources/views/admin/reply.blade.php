<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Contact</title>
</head>
<body>
    <h3>Dear Customer,</h3>
    <div>
       {!! nl2br(e($messageContent)) !!}
        {{-- {!! htmlspecialchars($messageContent) !!} --}}
    </div>
    <p><strong>{{ $confirmationMessage }}</strong></p>
     
</body>
</html>