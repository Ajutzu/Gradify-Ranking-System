<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradify Leaderboard</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="d-flex vh-100 justify-content-center align-items-center flex-column">
        <h1>🎉 Congratulations!</h1>
        <p class="text-muted">Here are the top 10 students in GPA ranking:</p>
        <ul id="leaderboard">
            <li>1. John Doe - 4.00 GPA</li>
            <li>2. Jane Smith - 3.95 GPA</li>
            <li>3. Alex Brown - 3.90 GPA</li>
            <!-- Add other rankings -->
        </ul>
        <button class="btn btn-lg btn-primary" id="shareBtn">Share to Social Media</button>
        <button class="btn btn-lg btn-secondary" id="secondShare">Share the Leaderboard</button>
    </div>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        const shareDataMain = {
            title: "Gradify Leaderboard",
            text: "🎉 Check out the top 10 GPA rankings in Gradify! 🌟",
            url: "https://your-school-website.com/gradify-leaderboard", // Replace with your leaderboard URL
        };

        const shareDataSecondary = {
            title: "Congratulations",
            text: `🎉 Congratulations! Here is the leaderboard for Gradify 🌟`,
            url: "https://your-school-website.com/gradify-leaderboard", // Replace with your leaderboard URL
        };

        const shareBtn = document.getElementById('shareBtn');
        const secondShareBtn = document.getElementById('secondShare');

        // First button share functionality
        shareBtn.addEventListener('click', async () => {
            if (navigator.share) {
                try {
                    await navigator.share(shareDataMain);
                    Swal.fire({
                        icon: 'success',
                        title: 'Shared successfully!',
                        text: 'Your leaderboard has been shared.',
                    });
                } catch (err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: `Error sharing: ${err.message}`,
                    });
                }
            } else {
                fallbackCopy(shareDataMain);
            }
        });

        // Second button share functionality
        secondShareBtn.addEventListener('click', async () => {
            if (navigator.share) {
                try {
                    await navigator.share(shareDataSecondary);
                    Swal.fire({
                        icon: 'success',
                        title: 'Shared successfully!',
                        text: 'The leaderboard text has been shared.',
                    });
                } catch (err) {
                    fallbackCopy(shareDataSecondary);
                }
            } else {
                fallbackCopy(shareDataSecondary);
            }
        });

        // Fallback: Copy to clipboard
        async function fallbackCopy(data) {
            const fallbackText = `${data.text}\n\nView it here: ${data.url}`;
            try {
                await navigator.clipboard.writeText(fallbackText);
                Swal.fire({
                    icon: 'success',
                    title: 'Copied to Clipboard!',
                    text: 'Share it manually on your favorite platform.',
                });
            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: `Failed to copy: ${err.message}`,
                });
            }
        }
    </script>
</body>

</html>
