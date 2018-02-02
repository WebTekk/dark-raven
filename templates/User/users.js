var Users = function () {

    var $this = this;

    /**
     * Events constructor
     */
    this.constructor = function() {
        this.screen = $("#target");
        this.loadUsers();
    };

    this.listUsers = function(data) {
        var template = $("#user-list").html();
        var rendered = Mustache.render(template, data);
        this.screen.html(rendered);
    };

    this.loadUsers = function() {
        showLoader();
        var url = baseurl() + "/users/load";
        $.ajax({
            type: "GET",
            contentType: "application/json",
            url: url,
            cache: false
        }).done(function (json) {
            var data = JSON.parse(json);
            $this.listUsers(data);
            hideLoader();
        });
    };

    this.constructor();
};

/**
 * Start JavaScript when document is ready.
 */
$(function () {
    new Users();
});
