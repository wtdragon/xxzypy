<?php

return array(
/**
 * Model title
 *
 * @type string
 */
'title' => 'articles',

/**
 * The singular name of your model
 *
 * @type string
 */
'single' => 'article',

/**
 * The class name of the Eloquent model that this config represents
 *
 * @type string
 */
'model' => 'Article',

/**
 * The columns array
 *
 * @type array
 */
'columns' => array(
    'title' => array(
        'title' => '标题'
    ),
    'image' => array(
        'title' => '图片',
        'output' => '<img src="/uploads/homepagesliders/resize/(:value)" height="100" />',
    )
),
/**
 * The edit fields array
 *
 * @type array
 */
'edit_fields' => array(
    'title' => array(
        'title' => '标题',
        'type' => 'text'
    ),
    'body' => array(
        'title' => '内容',
        'type' => 'text'
    )
)
);
