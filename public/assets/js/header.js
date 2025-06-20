document.addEventListener("DOMContentLoaded", () => {
  const menuButton = document.querySelector(".menu-button");
  const mobileMenu = document.querySelector(".mobile-menu");
  const menuButtonIcon = document.querySelector(".menu-icon");

  
  
  menuButton.addEventListener("click", function () {
    mobileMenu.classList.toggle("active");
    menuButton.classList.toggle("open");
    
    if(menuButton.classList.contains("open")) {
      menuButtonIcon.src = "/whatnext/public/assets/images/icon-close.svg"
    } else {
      menuButtonIcon.src = "/whatnext/public/assets/images/icon-menu.svg"
    }
  });


  const logginBtn = document.getElementById("login-button");
  const profileContainer = document.querySelector(".profile-container");
  const profileIcon = document.getElementById("profile-icon");
  const authMobileLoggedOut = document.querySelectorAll(".auth-logged-out");
  const authMobileLoggedIn = document.querySelectorAll(".auth-logged-in");

  if (isLoggedIn) {
    logginBtn?.classList.add("hidden");
    profileContainer?.classList.remove("hidden");
    authMobileLoggedOut.forEach(el => el.classList.add("hidden"));
    authMobileLoggedIn.forEach(el => el.classList.remove("hidden"));
  }

  profileIcon.addEventListener("click", () => {
      profileContainer.classList.toggle("active");
  })
});
