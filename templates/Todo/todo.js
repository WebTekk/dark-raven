var Todo = function () {

    var $this = this;

    /**
     * Users constructor
     */
    this.constructor = function () {
        var todo = new Vue({
            el: '#todo',
            data: {
                showModal: false,
                todos: [
                    {
                        id: 1,
                        text: 'Learn JavaScript',
                        dodate: '13.04.2018'
                    },
                    {
                        id: 2,
                        text: 'Learn Vue',
                        dodate: '13.04.2018'
                    },
                    {
                        id: 3,
                        text: 'Build something awesome',
                        dodate: '13.04.2018'
                    }
                ]
            }
        });
    };

    this.constructor();
};

/**
 * Start JavaScript when document is ready.
 */
$(function () {
    new Todo();
});
