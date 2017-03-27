  function onSignIn(googleUser) {
    document.getElementById("Form1").style.display = "initial";
    document.getElementById("GoogleLogin").style.display = "none";
    document.getElementById("GoogleLoguit").style.display = "initial";
    var profile = googleUser.getBasicProfile();
    var id_token = googleUser.getAuthResponse().id_token;
    document.getElementById('docent').value = profile.getName();
    document.getElementById('email').value = profile.getEmail();
}

