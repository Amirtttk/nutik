<?php
if ($_POST['selectId']){

    $selectProductInCareqoryId = selectProductInCareqoryId($_POST['selectId']);
    if ($selectProductInCareqoryId){
        $itemsCart =returnItemBlog($selectProductInCareqoryId);
        responseJson([
            'text' => 'دسته بندی با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
            "itemsCart" => $itemsCart,
        ]);
    }

}else{
    $selectProductInCareqoryIdIsNull = selectProductInCareqoryIdIsNull();
    if ($selectProductInCareqoryIdIsNull){
        $itemsCart =returnItemBlog($selectProductInCareqoryIdIsNull);
        responseJson([
            'text' => 'دسته بندی با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
            "itemsCart" => $itemsCart,
        ]);

    }
}

