// Feedback
function showFeedback()
{
    var feedbackForm = document.getElementById("Feedback");
    // if (feedbackForm.style.display === "none") {
        feedbackForm.style.display = "block";
    // }
}

// Toast
var x = document.getElementById("snackbar");
setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

// PWA
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('<?php echo _Root ?>static/js/service-worker.js').then(function(reg){
    }).catch(function(err) {
    console.log("Failed to register service-worker.js: ", err)
    });
}

//Cookies Use 
const cookieContainer =document.querySelector(".cookie-container");
const cookieButton=document.querySelector("button.cookie-btn");
cookieButton.addEventListener("click",()=>{
    cookieContainer.classList.remove("active");
    localStorage.setItem("cookieBannerDisplaye","true")
})
setTimeout(() => {
if(!localStorage.getItem("cookieBannerDisplaye"))
        cookieContainer.classList.add("active")
},1000);