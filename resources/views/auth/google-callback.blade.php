<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Logging in...</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Notify the parent window that the Google login is complete.
        if (window.opener && typeof window.opener.afterGoogleLogin === 'function') {
            window.opener.afterGoogleLogin();
        }
        // Close the popup window.
        window.close();
    </script>
    
</body>
</html>
