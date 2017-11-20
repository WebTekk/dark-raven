app = {};
if (!app.events) {
    app.events = {};
}

// Main class
app.events.Index = function () {

    /** @var app.events.Index */
    var $this = this;

    this.screen = null;

    /**
     * Initial function
     */
    this.init = function () {
        $this.screen = $("#target");
        $this.loadEvents();
    };

    this.loadEvents = function () {
        var url = baseurl() + "events/load";
        $.ajax({
            type: "GET",
            contentType: "application/json",
            url: url,
            cache: false
        }).done(function (data) {
            console.log(data);
        });
    };

    this.init();
};

/**
 * Start JavaScript when document is ready.
 */
$(function () {
    new app.events.Index();
});
