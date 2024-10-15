<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <script>
        window.onload = function() {
            // Create a form dynamically
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "YOUR_API_ENDPOINT"; // Replace with your API endpoint

            // Add CSRF Token (if necessary)
            var csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token"; // Replace with your actual CSRF token name
            csrfToken.value = "YOUR_CSRF_TOKEN"; // Replace with actual CSRF token value
            form.appendChild(csrfToken);

            // Add verification token
            var tokenInput = document.createElement("input");
            tokenInput.type = "hidden";
            tokenInput.name = "token";
            tokenInput.value = "{{ $token }}"; // Replace with the token passed from the email
            form.appendChild(tokenInput);

            // Append form to body and submit
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</head>
<body>
    <p>Please wait while we verify your email...</p>
</body>
</html>
