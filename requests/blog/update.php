<?php 

$validate_fields = validator([
    'title' => 'required',
]);
if ($validate_fields['status']) {
    $table = 'blog';
    $fields = [
        'title' => $_POST['title'],
        'reading_time' => $_POST['reading_time'],
        'description' => $_POST['description'],
        'blog_categories_id' => $_POST['blog_categories_id'],
        'author' => $_POST['author'],
        'label' => $_POST['label'],
        'slug' => $_POST['slug'],
    ];
    $keywords = $_POST['keywords'];
    $keywordsArray = explode(',', $keywords);

    $seoData = [
        'title' => $_POST['title'],
        'keywords' => $keywordsArray,
        'seo_description' => $_POST['seo_description'],
        'canonical' => $_POST['canonical'] ?: '',
    ];

    $fields['seo'] = json_encode($seoData);

    $dbError = '';
    if (updateRecordToDatabase($table, $fields, POST('id'), 'id')) {
        responseJson([
            'text' => 'ویرایش اطلاعات مقاله با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);
       
    } else {
        responseJson([
            'text' => 'در ویرایش اطلاعات مقاله مشکلی پیش آمده است',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
    }
} else {
    responseJson([
        'text' => 'فلید ها را به درستی پر کنید',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}