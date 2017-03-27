  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var id_token = googleUser.getAuthResponse().id_token;
    console.log(profile.getName());
    document.getElementById('docent').value = profile.getName();
    document.getElementById('email').value = profile.getEmail();
    console.log(profile.getImageUrl());
    console.log(profile.getEmail()); // This is null if the 'email' scope is not present.
    console.log(id_token);
    console.log('sign in succes');
  
}

