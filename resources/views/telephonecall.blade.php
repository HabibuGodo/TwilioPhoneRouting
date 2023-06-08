<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Phone Call Button</title>
</head>
<body>
  <div class="container mt-5">
    <h1>Phone Call Button</h1>
    <p>Click the button below to make a phone call:</p>
    <button class="btn btn-primary"><a href="/phone/calling" style="color:white"> Call</a></button>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  {{-- <script>
    // Function to handle the button click event
    function makePhoneCall() {
      // Implement your Twilio device connection logic here
      // For example, you can use Twilio Client JavaScript SDK to make a phone call
      // or trigger a server-side endpoint to initiate the call

      // Replace the following line with your own logic
      console.log('Making phone call...');
    }

    // Attach click event listener to the button
    const callButton = document.getElementById('callButton');
    callButton.addEventListener('click', makePhoneCall);
  </script> --}}
</body>
</html>
