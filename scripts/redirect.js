jQuery(function () {
    const signInCreateRedirectFlags = [
        "Create a new Guestbook account",
        "Sign in now",
        "Go to Home Page",
    ];
    const signInCreateRedirect = $("._redirect");
    signInCreateRedirect.on("click", function () {
        switch (signInCreateRedirect.text().trim()) {
            case signInCreateRedirectFlags[0]:
                window.location.href =
                    "http://localhost/refactoredGuestbookForKlaas/create_account";
                break;
            case signInCreateRedirectFlags[1]:
                window.location.href =
                    "http://localhost/refactoredGuestbookForKlaas/sign_in";
                break;
            case signInCreateRedirectFlags[2]:
                window.location.href =
                    "http://localhost/refactoredGuestbookForKlaas/";
                break;
            default:
        }
    });
});
