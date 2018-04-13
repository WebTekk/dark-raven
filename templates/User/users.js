var Users = function () {

    var $this = this;

    /**
     * Users constructor
     */
    this.constructor = function () {
        this.screen = $('#target');
        this.loadAll();
    };

    /**
     * Register events
     */
    this.registerEvents = function () {

    };

    /**
     * List all users
     * @param data Users
     */
    this.renderData = function (data) {
        var userTemplate = $('#user-list').html();
        var userRendered = Mustache.render(userTemplate, data);
        this.screen.html(userRendered);
    };

    /**
     * Load users
     */
    this.loadAll = function () {
        showLoader();
        var url = baseurl() + '/users/load';
        $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: url,
            cache: false
        }).done(function (json) {
            var data = JSON.parse(json);
            $this.renderData(data);
            hideLoader();
            $this.registerEvents();
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
