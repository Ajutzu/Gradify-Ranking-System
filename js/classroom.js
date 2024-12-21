function shareToFB() {
    const achievementText = encodeURIComponent("🎓 Proud to share that I'm ranked #1 with a GPA of 2.5 in my class at Gradify! 🌟 #AcademicExcellence #StudentLife");
    const url = `https://www.facebook.com/sharer/sharer.php?u=${window.location.href}&quote=${achievementText}`;
    window.open(url, '_blank', 'width=600,height=400');
}