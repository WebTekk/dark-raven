class Events {

    /**
     * Events constructor
     */
    constructor() {
        this.screen = $("#target");
        this.loadEvents();
    };

    listEvents(data) {
        let template = $("#event-list").html();
        let rendered = Mustache.render(template, data);
        this.screen.html(rendered);
    };

    loadEvents() {
        let $this = this;
        let url = baseurl() + "events/load";
        $.ajax({
            type: "GET",
            contentType: "application/json",
            url: url,
            cache: false
        }).done(function (data) {
            console.log(data);
            $this.listEvents(data);
        });
    };
}

/**
 * Start JavaScript when document is ready.
 */
$(function () {
    new Events();
});
