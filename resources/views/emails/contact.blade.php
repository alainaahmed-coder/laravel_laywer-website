<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .card { background: #ffffff; padding: 20px; border-radius: 8px; border-left: 5px solid #d39e25; }
        h2 { color: #0c1821; }
        .field { margin-bottom: 10px; font-size: 14px; color: #333; }
        .message-box { background: #f9f9f9; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px; color: #111; }
    </style>
</head>
<body>
    <div class="card">
        <h2>New Client Query Received - LegalEase</h2>
        <div class="field"><strong>Client Name:</strong> {{ $formData['name'] }}</div>
        <div class="field"><strong>Client Email:</strong> {{ $formData['email'] }}</div>
        <div class="field"><strong>Subject:</strong> {{ $formData['subject'] }}</div>

        <div class="message-box">
            <strong>Message / Legal Inquiry:</strong><br>
            <p>{{ $formData['message'] }}</p>
        </div>
    </div>
</body>
</html>
