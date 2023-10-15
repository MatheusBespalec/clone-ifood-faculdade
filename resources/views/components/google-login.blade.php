<meta name="google-signin-client_id" content="{{ config("services.google.client_id") }}">
<div id="my-signin2"></div>
<script>
    function onSuccess(googleUser) {
        console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    }
    function onFailure(error) {
        console.log(error);
    }
    function renderButton() {
        gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': "full",
            'height': 50,
            'longtitle': true,
            'theme': 'outline',
            'useOneTap': true,
            'auto_select' :true,
            'login_uri': "{{ config("services.google.redirect") }}"
        });
    }
</script>

<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
