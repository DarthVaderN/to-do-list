<?php $title = 'ADD TASK' ?>
<?php include __DIR__ . '/../header.php'; ?>


<form action="/tasks/create" method="POST">
    <div class="form-group">
        <label for="user">Name</label>
        <input type="text" class="form-control" name="user" id="user">
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" name="email" id="email">
    </div>
    <div class="form-group">
        <label for="description">TASK TEXT</label>
        <textarea class="form-control" name="description" id="description" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-success">CREATE</button>
</form>

<?php include __DIR__ . '/../footer.php'; ?>
