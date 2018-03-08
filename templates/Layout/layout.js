var Layout = function () {

	var $this = this;

	/**
	 * Layout constructor
	 */
	this.constructor = function () {
		this.registerEvents();
	};

	this.registerEvents = function () {
		$("#navbar-collapse").find('[data-id=logout_link]').on('click', this.logoutOnPress);
	};

	this.logoutOnPress = function () {
		showLoader();
		var url = baseurl() + "/logout";
		$.ajax({
			type: "GET",
			contentType: "application/json",
			url: url,
			cache: false
		}).done(function (json) {
			var data = JSON.parse(json);
			if (data.logout === true) {
				hideLoader();
				$(location).attr("href", baseurl());
			}
		});
	};

	this.constructor();
};

/**
 * Start JavaScript when document is ready.
 */
$(function () {
	new Layout();
});
