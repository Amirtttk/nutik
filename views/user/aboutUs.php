<?php
$getAllaAboutUs = getAllaAboutUs();
if ($getAllaAboutUs['image']){
    $thumbnail = str_replace(PATH_UPLOADS_DIR, 'public/', $getAllaAboutUs['image']);
}
?>
<main class="my-4 xl:my-10">
    <div class="mx-2 lg:mx-10 border border-zinc-200 bg-white shadow-custom rounded-2xl px-2 py-2 lg:px-4 lg:py-4">
      <img class="rounded-lg mb-6 w-full" src="<?= $thumbnail ? "../../" . $thumbnail : '' ?>" alt="">
        <?= $getAllaAboutUs['description'] ?>
    </div>
  </main>

