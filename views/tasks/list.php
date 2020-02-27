<?php include __DIR__ . '/../header.php'; ?>
<?php
$sorts = [
    'user' => 'Name',
    'email' => 'E-mail',
    'completed' => 'Status'
];
?>
<div class="pb-4">
    <?php
    if (isset($sorts) && isset($paging)) {
        foreach ($sorts as $key => $value) {
            $link = $paging['base_uri'] . '/1/' . $key . '/' . ($key === $paging['order'] && $paging['direction'] === 'asc' ? 'desc' : 'asc');
            $btn_class = $key === $paging['order'] ? 'primary' : 'light';
            $arrow = $paging['direction'] === 'asc' ? 'up' : 'down';

            echo '<a class="btn btn-' . $btn_class . '" href="' . $link . '">';
            echo $value . ' &nbsp;';

            if ($paging['order'] === $key) {
                echo '<i class="fas fa-sort-' . $arrow . '"></i> ';
            }

            echo '</a> &nbsp;';
        }
    }
    ?>
</div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
    <?php foreach ($tasks as $task): ?>
        <div class="col mb-6">
            <div class="card h-100 w-100" style="width: 18rem; color: black">
                <div class="card-body">

                    <p class="card-text"><small class="text-muted">User <b><?php echo htmlspecialchars($task['user']) ?></b> (<?php echo htmlspecialchars($task['email']) ?>)</small></p>
                    <p class="card-text"><?php echo htmlspecialchars($task['description']) ?></p>
                    <?php if ($task['updated']): ?>
                        <p class="card-text"><small class="btn-success"><i>Admin updated</i></small></p>
                    <?php endif ?>

                    <p class="card-text"><small class="text-muted"><?php echo $task['completed'] ? 'Completed' : 'not yet' ?></small></p>

                    <?php if (\Session::isAuth()): ?>
                        <a href="/tasks/edit/<?php echo $task['id'] ?>" class="btn btn-success">Update</a>
                    <?php endif ?>

                </div>
            </div>
        </div>
    <?php endforeach ?>
    <?php if (!count($tasks)): ?>
    <div class="pl-3">List is empty relax</div>
    <?php endif ?>
</div>
<?php if (isset($count_all) && isset($paging)): ?>
    <?php
    $count_pages = ceil($count_all / $paging['per_page']);
    ?>
    <?php if ($count_pages > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">
                <?php
                for ($i = 1; $i <= $count_pages; $i++):
                    $link = $paging['base_uri'] . '/' . $i . '/' . $paging['order'] . '/' . $paging['direction']; ?>

                    <li class="page-item <?php echo $i == $paging['page'] ? 'active' : '' ?> " style="margin-top: 50px">
                        <a class="page-link" href="<?php echo $link ?>"><?php echo $i ?></a>
                    </li>

                <?php endfor ?>
            </ul>
        </nav>
    <?php endif ?>
<?php endif ?>

<?php include __DIR__ . '/../footer.php'; ?>
