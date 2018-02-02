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

        // var username = $this.form.find("[data-id=username]");
        // var email = $this.form.find("[data-id=email]");
        // var first_name = $this.form.find("[data-id=first_name]");
        // var last_name = $this.form.find("[data-id=last_name]");
        // var password = $this.form.find("[data-id=password]");
        // var repeat_password = $this.form.find("[data-id=repeat_password]");
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
    };

    this.sendRegister = function (username, password) {
        showLoader();
        var url = baseurl() + "/login";
        var requestData = {"username": username.val(), "password": password.val()};
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
                username.closest('.form-group').addClass('has-error');
                password.closest('.form-group').addClass('has-error');
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
