var Register = function () {

    var $this = this;

    /**
     * Register constructor
     */
    this.constructor = function () {
        this.form = $("[data-id=register_form]");
        this.registerEvents();
    };

    /**
     * Register events
     */
    this.registerEvents = function () {
        this.form.find("#register_button").on('click', this.registerOnPress);
        $(document).on('keypress', function(e) {
            if (e.which === 13) {
                $this.registerOnPress(e);
            }
        });
    };

    /**
     * Init register event
     *
     * @param event
     */
    this.registerOnPress = function (event) {
        event.preventDefault();

        var userDataFields = {
            'username': $this.form.find("[data-id=username]"),
            'email': $this.form.find("[data-id=email]"),
            'first_name': $this.form.find("[data-id=first_name]"),
            'last_name': $this.form.find("[data-id=last_name]"),
            'password': $this.form.find("[data-id=password]"),
            'repeat_password': $this.form.find("[data-id=repeat_password]")
        };

        $this.resetValidation(userDataFields);

        var userData = $this.getValueFromFields(userDataFields);

        if ($this.validateForm(userData, userDataFields)) {
            $this.sendRegister(userData, userDataFields);
        }
    };

    /**
     * Validate registration form
     *
     * @param userData
     * @param userDataFields
     * @returns {boolean}
     */
    this.validateForm = function (userData, userDataFields) {
        var valid = true;
        for (var key in userData) {
            if (userData[key] === "") {
                valid = false;
                userDataFields[key].closest('.form-group').addClass('has-error');
                userDataFields[key].closest('.form-group').find('p').text('Please verify your input');
            }
        }
        if (userData.password !== userData.repeat_password && userData.password !== "") {
            valid = false;
            userDataFields.password.closest('.form-group').addClass('has-error');
            userDataFields.password.closest('.form-group').find('p').text('Passwords doesn\'t match');
            userDataFields.repeat_password.closest('.form-group').addClass('has-error');
        }
        return valid;
    };

    /**
     * Get Value from input fields
     *
     * @param userDataFields
     * @returns {{}}
     */
    this.getValueFromFields = function (userDataFields) {
        var userData = {};
        for (var key in userDataFields) {
            userData[key] = userDataFields[key].val();
        }
        return userData;
    };

    /**
     * Reset validation
     *
     * @param userDataFields
     */
    this.resetValidation = function (userDataFields) {
        for (var key in userDataFields) {
            userDataFields[key].closest('.form-group').removeClass('has-error');
            userDataFields[key].closest('.form-group').find('p').text('');
        }
    };

    /**
     * Clear form
     *
     * @param userDataFields
     */
    this.clearForm = function (userDataFields) {
        for (var key in userDataFields) {
            userDataFields[key].val('');
        }
    };

    /**
     * Send registration
     *
     * @param userData
     * @param userDataFields
     */
    this.sendRegister = function (userData, userDataFields) {
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
            if (data.success === true) {
                $this.resetValidation(userDataFields);
                $this.clearForm(userDataFields);
                notif({
                    msg: "User added",
                    type: "success",
                    position: "center"
                });
                $( location ).attr("href", baseurl());
            } else {
                $this.form.find("[data-id=error-message]").show();
                for (var key in data.errors){
                    userDataFields[key].closest('.form-group').addClass('has-error');
                    userDataFields[key].closest('.form-group').find('p').text(data.errors[key]);
                }
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
