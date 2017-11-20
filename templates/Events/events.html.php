<?php $this->layout('view::Layout/layout.html.php'); ?>

<?php $this->start('assets');
echo $this->assets(['view::Events/events.js'], ['inline' => false]);
echo $this->assets(['view::Events/events.css'], ['inline' => false]);
$this->stop(); ?>

<?php $this->start('title');
echo $this->wh("page");
$this->stop(); ?>

<h1>Events</h1>

<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Location</th>
    </tr>
    </thead>
    <tbody id="target"></tbody>
</table>

<script id="event-list" type="text/html">
    {{#events}}
    <tr data-id="{{id}}">
        <td>{{name}}</td>
        <td>{{date}}</td>
        <td>{{location}}</td>
    </tr>
    {{/events}}
</script>
