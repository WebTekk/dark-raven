var Users = function () {

    var $this = this;

    /**
     * Events constructor
     */
    this.constructor = function () {
        this.screen = $('#target');
        this.loadUsers();
    };

    /**
     * Register events
     */
    this.registerEvents = function () {
        $('#target').find('[data-name=role]').on('click', $this.roleOnPress);
        var dropdownMenu = $('#dropdown-menu');
        dropdownMenu.find('.dropdown-menu').on('click', 'li p', function () {
            dropdownMenu.find('button[data-name=select-role-button]').text($(this).text());
            dropdownMenu.find('button[data-name=select-role-button]').val($(this).text());
        });
        $('#confirm-role').on('click', $this.confirmRoleOnPress);
    };

    this.confirmRoleOnPress = function () {
        var modal = $('#role-modal');
        var id = modal.find('input[type=hidden]').val();
        var role = modal.find('button[data-name=select-role-button]').val();
        console.log(role + id);
        if (role === "") {
            return;
        }
        var roleName = modal.find('p[data-value=' + role + ']').data('name');
        console.log(roleName);
        showLoader();
        var requestData = {
            'id': id,
            'role': roleName
        };
        var url = baseurl() + '/users/role';
        $.ajax({
            type: 'PUT',
            contentType: 'application/json',
            url: url,
            cache: false,
            data: JSON.stringify(requestData)
        }).done(function (json) {
            var data = JSON.parse(json);
            hideLoader();
        });
    };

    this.roleOnPress = function (event) {
        var userId = event.target.id;
        $('#role-modal').find('input[type=hidden]').val(userId);
    };

    this.listUsers = function (data) {
        var template = $('#user-list').html();
        var rendered = Mustache.render(template, data);
        this.screen.html(rendered);
    };

    this.loadUsers = function () {
        showLoader();
        var url = baseurl() + '/users/load';
        $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: url,
            cache: false
        }).done(function (json) {
            var data = JSON.parse(json);
            $this.listUsers(data);
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
