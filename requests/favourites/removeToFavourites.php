<?php
if (isset($_SESSION['user_sending'])) {
    $selectInProductFavourites = selectInProductFavouritesCount();
    $len = 0;
    if ($selectInProductFavourites){
        $len = count($selectInProductFavourites);

        removeFromFavourits(POST('id'));
        responseJson([
            'text' => 'محصول با موفقیت از لیست علاقه مندی ها حذف شد',
            'type' => 'success',
            'len' => $len - 1,
            'status' => 200,
        ]);
    }
} else {
    responseJson([
        'text' => 'در حذف علاقه مندی مشکلی پیش آمده ',
        'type' => 'warning',
        'status' => 400,
    ]);
}
