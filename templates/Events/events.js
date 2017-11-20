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
        alert('hi');
    };

    this.init();
};

/**
 * Start JavaScript when document is ready.
 */
$(function () {
    new app.events.Index();
});
