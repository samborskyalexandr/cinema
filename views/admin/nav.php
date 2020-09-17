<nav class="navbar navbar-expand-md navbar-dark bg-info mb-5">
    <a class="navbar-brand" href="/">Homepage</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="create.php">Add new movie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Movie's list</a>
            </li>
        </ul>
    </div>
</nav>

<?php
include_once '..\..\App\DB\Connection.php';
