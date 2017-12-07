var Events = function () {

    var $this = this;

    /**
     * Events constructor
     */
    this.constructor = function() {
        this.screen = $("#target");
        this.loadEvents();
    };

    this.listEvents = function(data) {
        let template = $("#event-list").html();
        let rendered = Mustache.render(template, data);
        this.screen.html(rendered);
    };

    this.loadEvents = function() {
        showLoader();
        let url = baseurl() + "/events/load";
        $.ajax({
            type: "GET",
            contentType: "application/json",
            url: url,
            cache: false
        }).done(function (data) {
            console.log(data);
            $this.listEvents(data);
            hideLoader();
        });
    };

    this.constructor();
};

/**
 * Start JavaScript when document is ready.
 */
$(function () {
    new Events();
});
