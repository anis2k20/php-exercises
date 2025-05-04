<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
       
            <a href="/notes" class="mb-4 hover:underline text-blue-500">Go Back...</a>
           <p>
                <?= $note['body'] ?>
            </p>

            <form method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <button class="text-red-500 mt-6 hover:underline">Delete</a>
            </form>

    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>