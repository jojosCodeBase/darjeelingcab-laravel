<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
</head>
<body>
    <h1>Thank You for Your Enquiry</h1>
    <p>Dear {{ $name }},</p>
    <p>Thank you for reaching out to us. We have received your enquiry with the following details:</p>
    
    <h2>Enquiry Details</h2>
    <ul>
        <li><strong>From:</strong> {{ $from }}</li>
        <li><strong>To:</strong> {{ $to }}</li>
        <li><strong>Number of People:</strong> {{ $numberOfPeople }}</li>
        <li><strong>Vehicle Type:</strong> {{ $vehicleType }}</li>
        <li><strong>Start Date:</strong> {{ $startDate }}</li>
        <li><strong>End Date:</strong> {{ $endDate }}</li>
        <li><strong>Message:</strong> {{ $custom_message }}</li>
    </ul>

    <p>Our customer executive will contact you soon to assist you further. If you have any further questions, feel free to reply to this email.</p>

    <h2>Contact Information</h2>
    <p>Here are our contact details:</p>
    <ul>
        <li><strong>Phone:</strong> 9339342603 / 8967386612 / 7478459652</li>
        <li><strong>Email:</strong> <a href="mailto:info@darjeelingcab.in">info@darjeelingcab.in</a></li>
        <li><strong>Address:</strong> Peshok, Peshok Tea Garden, Rangli Rangliot, Darjeeling, West Bengal - 734312</li>
    </ul>

    <p>Best regards,<br>Darjeeling Cab</p>
</body>
</html>
