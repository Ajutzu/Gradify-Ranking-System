const shareDataMain = {
    title: "Gradify Leaderboard",
    text: "🎉 Check out the top 10 GPA rankings in Gradify! 🌟",
    url: "https://your-school-website.com/gradify-leaderboard",
};

const shareDataSecondary = {
    title: "Congratiolations",
    text: `🎉 Congrationalis 🌟`,
    url: "https://your-school-website.com/gradify-leaderboard", 
}

let shareBtn = document.getElementById('shareBtn');
let secondShareBtn = document.getElementById('secondShare');

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
        // Fallback: Copy to clipboard
        const fallbackText = `${shareDataMain.text}\n\nView it here: ${shareDataMain.url}`;
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
});

secondShareBtn.addEventListener('click', async () => {
    const fallbackText = `${shareDataSecondary.text}\n\nView it here: ${shareDataSecondary.url}`;
    // Fallback: Copy to clipboard
    try {
        await navigator.clipboard.writeText(fallbackText);
        Swal.fire({
            icon: 'success',
            title: 'Copied to Clipboard!',
            text: 'Share the leaderboard text manually.',
        });
    } catch (err) {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: `Failed to copy: ${err.message}`,
        });
    }
});