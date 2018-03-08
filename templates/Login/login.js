var Login = function () {

	var $this = this;

	/**
	 * Layout constructor
	 */
	this.constructor = function () {
		this.form = $("[data-id=login_form]");
		this.registerEvents();
	};

	this.registerEvents = function () {
		this.form.find("#login_button").on('click', this.loginOnPress);
		$(document).on('keypress', function (e) {
			if (e.which === 13) {
				$this.loginOnPress(e);
			}
		});
	};

	this.loginOnPress = function (event) {
		event.preventDefault();

		var username = $this.form.find("[data-id=username]");
		var password = $this.form.find("[data-id=password]");
		username.closest('.form-group').removeClass('has-error');
		password.closest('.form-group').removeClass('has-error');

		if (username.val() !== "" && password.val() !== "") {
			$this.sendLogin(username, password);
		}
		if (username.val() === "") {
			username.closest('.form-group').addClass('has-error');
		}
		if (password.val() === "") {
			password.closest('.form-group').addClass('has-error');
		}
	};

	this.sendLogin = function (username, password) {
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
			if (data.success === true) {
				$(location).attr("href", baseurl());
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
	new Login();
});
