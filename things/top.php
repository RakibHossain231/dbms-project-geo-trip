<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geo Trips</title>
    <!-- tailwind link  -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- daisy ui cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- playfair font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <!-- favicon -->
    <link rel="icon" href="resources/airplane.png" type="image/x-icon">
    <style>
        .header-font {
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: bolder;
        }

        @keyframes softBlink {
            0% {
                opacity: 1;
            }

            25% {
                opacity: 0.6;
            }

            50% {
                opacity: 0.3;
            }

            75% {
                opacity: 0.6;
            }

            100% {
                opacity: 1;
            }
        }

        .blink {
            animation: softBlink 2s ease-in-out infinite;
        }
    </style>
</head>