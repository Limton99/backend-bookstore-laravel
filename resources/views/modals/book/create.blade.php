<div class="modal fade" id="createBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="/books/store" enctype="multipart/form-data">
            @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить книгу</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Название</label>
                        <input type="text" class="form-control" id="recipient-name" name="title">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Описание:</label>
                        <textarea class="form-control" id="message-text" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Цена</label>
                        <input type="text" class="form-control" id="recipient-name" name="price">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Количество</label>
                        <input type="text" class="form-control" id="recipient-name" name="count">
                    </div>
                    <div class="form-group">
                        <label for="sel1">Select list:</label>
                        <select multiple class="form-control" id="sel2" name="category_id[]">
                            @foreach($categories as $category)
                                <option value={{$category->id}}>{{$category->name}}</option>
                            @endforeach
                        </select>


                    </div>
                    <div class="form-group">
                        <label for="sel2">Эксклюзив</label>
                        <select class="form-control" id="sel2" name="exclusive">
                            <option value=1>Да</option>
                            <option value=0>Нет</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sel3">Популярный</label>
                        <select class="form-control" id="sel3" name="popular">
                            <option value=1>Да</option>
                            <option value=0>Нет</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sel4">Новый</label>
                        <select class="form-control" id="sel4" name="new">
                            <option value=1>Да</option>
                            <option value=0>Нет</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Название</label>

                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>
