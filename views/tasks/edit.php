<?php $title = 'Update Task' ?>
<?php include __DIR__ . '/../header.php'; ?>
<form action="/tasks/edit/<?php echo $task['id'] ?>" method="POST">
    <div class="form-group">
        <label for="description">TASK TEXT</label>
        <textarea class="form-control" name="description" id="description" rows="10"><?php echo htmlspecialchars($task['description']) ?></textarea>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="completed" name="completed" value="1" <?php echo $task['completed'] ? "checked" : "" ?>>
        <label class="form-check-label" for="completed"> Completed </label>
    </div>
    <button type="submit" class="btn btn-success">SAVE</button>
</form>
<?php include __DIR__ . '/../footer.php'; ?>
