<!DOCTYPE html>
<html>
<head>
    <title>Enquiry Received</title>
</head>
<body>
    <h1>Enquiry Details</h1>
    
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>From:</strong> {{ $data['from'] }}</p>
    <p><strong>To:</strong> {{ $data['to'] }}</p>
    <p><strong>Number of People:</strong> {{ $data['number-of-people'] }}</p>
    <p><strong>Vehicle Type:</strong> {{ $data['vehicle-type'] }}</p>
    <p><strong>Start Date:</strong> {{ $data['start-date'] }}</p>
    <p><strong>End Date:</strong> {{ $data['end-date'] }}</p>
    <p><strong>Message:</strong> {{ $data['message'] }}</p>
    
    <p>Thank you for your enquiry. We will get back to you shortly.</p>
</body>
</html>
