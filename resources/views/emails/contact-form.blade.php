<!DOCTYPE html>
<html>
<head>
    <title>Contact Us Form Data</title>
</head>
<body>
    <h1>New Enquiry from Contact Form</h1>
    
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Message:</strong> {{ $data['message'] }}</p>
    
    <p>Thank you for your enquiry. We will get back to you shortly.</p>
</body>
</html>
