$(function () {
    $("#contactForm").find('textarea,input,select').jqBootstrapValidation({
        preventSubmit: !0,
        submitError: function (t, e, s) { },
        submitSuccess: function (t, e) {
            e.preventDefault(), e.stopPropagation();

            grecaptcha.execute('6Ld3Cx4sAAAAAM5kv7OTxQxMHMFuVweziAMgMJrE', { action: 'submit' }).then(function (token) {
                $("#token").val(token);

                $.ajax({
                    url: "/mail/contact.php",
                    type: "POST",
                    data: t.serialize(),
                    cache: !1,
                    success: function (res) {
                        const response = JSON.parse(res);
                        if (response.code == 200) {
                            $("#success").html("<div class='alert alert-success alert-dismissible fade show'><span>Your message has been sent! </span><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"),
                                $("#contactForm").trigger("reset");
                        } else {
                            $("#success").html("<div class='alert alert-danger alert-dismissible fade show'>Sorry, verification failed. Please try again later!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"),
                                $("#contactForm").trigger("reset");
                        }
                    },
                    error: function () {
                        $("#success").html("<div class='alert alert-danger alert-dismissible fade show'>Sorry, it seems that my mail server is not responding. Please try again later!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"),
                            $("#contactForm").trigger("reset");
                    },
                });
            });
        },
        filter: function () {
            return $(this).is(":visible");
        },
    });
});
