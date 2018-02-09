var Register = function () {

    var $this = this;

    /**
     * Layout constructor
     */
    this.constructor = function () {
        this.form = $("[data-id=register_form]");
        this.registerEvents();
    };

    this.registerEvents = function () {
        this.form.find("#register_button").on('click', this.registerOnPress);
    };

    this.registerOnPress = function (event) {
        event.preventDefault();

        var userData = {
            'username': $this.form.find("[data-id=username]"),
            'email': $this.form.find("[data-id=email]"),
            'first_name': $this.form.find("[data-id=first_name]"),
            'last_name': $this.form.find("[data-id=last_name]"),
            'password': $this.form.find("[data-id=password]"),
            'repeat_password': $this.form.find("[data-id=repeat_password]")
        };
        userData.username.closest('.form-group').removeClass('has-error');
        userData.password.closest('.form-group').removeClass('has-error');

        if (userData.username.val() !== "" && userData.password.val() !== "") {
            $this.sendRegister(userData.username, userData.password);
        }
        if (userData.username.val() === "") {
            userData.username.closest('.form-group').addClass('has-error');
        }
        if (userData.password.val() === "") {
            userData.password.closest('.form-group').addClass('has-error');
        }

        this.sendRegister(userData);
    };

    this.sendRegister = function (userData) {
        showLoader();
        var url = baseurl() + "/register";
        var requestData = {"user": userData};
        $.ajax({
            type: "POST",
            contentType: "application/json",
            url: url,
            cache: false,
            data: JSON.stringify(requestData)
        }).done(function (json) {
            var data = JSON.parse(json);
            if(data.success === true) {
                $( location ).attr("href", baseurl());
            } else {
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
    new Register();
});
