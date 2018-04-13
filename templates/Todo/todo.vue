<div id="todo">
    <ol>
        <li v-for="todo in todos" class="todo-element" data-toggle="modal" v-bind:data-target="'#modal' + todo.id">
            <p class="col-md-10 col-sm-8">{{ todo.text }}</p>
            <p class="col-md-2 col-sm-4">{{ todo.dodate }}</p>
        </li>
    </ol>

    <!--Edit model-->
    <div v-for="todo in todos" v-bind:id="'modal' + todo.id" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit todo</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-addon" id="todo-text-input">Todo</span>
                        <input type="text" class="form-control" placeholder="Todo" aria-describedby="todo"
                               v-bind:value="todo.text">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="todo-dodate-input">Do date</span>
                        <input type="text" class="form-control" placeholder="Do date" aria-describedby="dodate"
                               v-bind:value="todo.dodate">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
