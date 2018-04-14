var ChangePassword = function () {

    var $this = this;

    /**
     * Layout constructor
     */
    this.constructor = function () {
        this.form = $("[data-id=change_form]");
        this.registerEvents();
    };

    this.registerEvents = function () {
        this.form.find("#change_button").on('click', this.changeOnPress);
        $(document).on('keypress', function (e) {
            if (e.which === 13) {
                $this.changeOnPress(e);
            }
        });
    };

    this.changeOnPress = function (event) {
        event.preventDefault();

        var passwordOld = $this.form.find("[data-id=password_old]");
        var passwordNew = $this.form.find("[data-id=password_new]");
        var passwordRepeat = $this.form.find("[data-id=password_repeat]");
        passwordOld.closest('.form-group').removeClass('has-error');
        passwordNew.closest('.form-group').removeClass('has-error');
        passwordRepeat.closest('.form-group').removeClass('has-error');

        var error = false;
        if (passwordOld.val() === "") {
            passwordOld.closest('.form-group').addClass('has-error');
            error = true;
        }
        if (passwordNew.val() === "") {
            passwordNew.closest('.form-group').addClass('has-error');
            error = true;
        }
        if (passwordRepeat.val() === "") {
            passwordRepeat.closest('.form-group').addClass('has-error');
            error = true;
        }
        if (passwordNew.val() !== passwordRepeat.val()) {
            passwordRepeat.closest('.form-group').addClass('has-error');
            error = true;
        }

        if (error === false) {
            $this.changePassword(passwordOld, passwordNew, passwordRepeat);
        }

    };

    this.changePassword = function (passwordOld, passwordNew, passwordRepeat) {
        showLoader();
        var url = baseurl() + "/change-password";
        var requestData = {
            "passwordOld": passwordOld.val(),
            "passwordNew": passwordNew.val(),
            "passwordRepeat": passwordRepeat.val()
        };
        console.log(url);
        console.log(requestData);
        $.ajax({
            type: "POST",
            contentType: "application/json",
            url: url,
            cache: false,
            data: JSON.stringify(requestData)
        }).done(function (json) {
            var data = JSON.parse(json);
            if (data.success === true) {
                $(location).attr("href", baseurl());
            } else {
                passwordOld.closest('.form-group').addClass('has-error');
                passwordNew.closest('.form-group').addClass('has-error');
                passwordRepeat.closest('.form-group').addClass('has-error');
                $this.form.find("[data-id=error-message]").show();
            }
            hideLoader();
        });
    };

    this.constructor();
};

/**
 * Start JavaScript when document is ready.
 */
$(function () {
    new ChangePassword();
});
