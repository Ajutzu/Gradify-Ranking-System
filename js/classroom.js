document.querySelectorAll('.share-btn').forEach(button => {
    button.addEventListener("click", function () {
        const classroom = this.getAttribute('data-classroom-id');
        const url = `http://localhost:3000/guest/guest.php?id=${classroom}`;
        
        if (navigator.share) {
            navigator.share({
                text: "Check out this classroom leaderboard",
                url: url,
                title: "GPA Ranking"
            }).catch(error => console.error("Sharing failed", error));
        } else {
            navigator.clipboard.writeText(url).then(() => {
                alert("URL copied to clipboard!");
            }).catch(error => console.error("Clipboard write failed", error));
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var params = new URLSearchParams(window.location.search);
    var value = params.get('output');

    if (value == 'success') {
        Swal.fire({
            icon: 'success',
            title: 'GPA Calculated!',
            html: '<div class="text-center">You have successfully calculate your GPA.</div>',
        });
    } else if (value == 'error') {
        Swal.fire({
            icon: 'error',
            title: 'Something Went Wrong',
            html: '<div class="text-center">An error occurred while processing your request. Please try again later.</div>',
        });
    }
});
