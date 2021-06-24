<?php

return [
	// Global Moderator Email
	'gme' => 'moderator@mail.com',

	// Items
	// kind, type, union, item	

	// String langs
	'name_len'      => [ 'min'=>2,  'max'=>30  ],
	'desc_len'      => [ 'min'=>10, 'max'=>300 ],
	'pref_len'      => [ 'min'=>1,  'max'=>4   ],
	'code_len'      => [ 'min'=>2,  'max'=>15  ],
	'passwd_len'    => [ 'min'=>6,  'max'=>20  ],

	// Paginations
	'admin_paginate'        => 20,
	'access_table_paginate' => 10,
	'ajax_paginate'         => 20,

	// Form
	'desc_rows'      => 6,
	'meta_desc_rows' => 2,

	// Show Date Format
	'db-date-format'     => 'YYYY-MM-DD',
	'carbon-date-format' => 'Y-m-d H:i:s',
	'date_interval_vals' => [1,2,3,4,5,6,7,8,9,10],
	// Date Format for select
	'date-formats-src' => [
		'format' => ['dmy', 'mdy', 'ydm', 'ymd'],
		'separator' => ['-', '/'],
	],
	// Date Format results
	'date-formats' => [
		'dmy-' => ['crb'=>'d-m-Y H:i', 'mjs'=>'DD-MM-YY HH:mm'],
		'dmy/' => ['crb'=>'d/m/Y H:i', 'mjs'=>'DD/MM/YY HH:mm'],
		// mdy-
		// ydm-
		// ymd-
		// mdy/
		// ydm/
		// ymd/
		// ---
	],

	// Indexes 
	'temp_index'   => 't-',
	'remote_index' => 'r-',

	// Images
	'image_types' => [ 'jpeg','jpg','png' ],
	'file_types'  => [ 'txt', 'doc', 'docx', 'pdf' ],
	
	// Sizes
	'logo_size'           => ['width'=>250, 'height'=>250],
	'thumb_size'          => ['width'=>150, 'height'=>150],
	'max_image_weigth'    => 5000,
	'max_file_weigth'     => 50000,

	// Permissions List For Moderator Only
	'perms_moderator_only' => [ 'show_admin', 'crud_admin' ],
	'roles_moderator_only' => [ 'moderator', 'admin' ],

	// Remove Gup 
	// Remove All Soft Deleted Items After 
	'remove_items_after_days'   => 150, 

	// Moderator Access To Some Class Rooms
	// 0-all,1-only item room without user rooms, 2-with user personal room
	'moderator_chat_room_acces' => 0,

	// Status Codes For Any Items
	'item_prepared_status' => [
		'plain' => 0,
		'ready' => 100,
		// 1,2,3 ... - номер законченого шага в форме
	],
    'item_mutable_status' => [
    	'mutable'         => 100,
    	'immutable_props' => 70,
    	'immutable_info'  => 30,
    	'immutable'       => 0,
    ],
    'item_deletable_status' => [
    	'deletable'         => 100,
    	'undeletable_force' => 50,
    	'undeletable'       => 0,
    ],

	// Item Creating Steps
	'form_steps' => [
		'permissions' => ['main'],
		'roles'       => ['main', 'allows'],
	],

	// Allows Keys With Default Value
    'allows' => [
    	'roles' => [ 
            'bind' => [
        		[ 'ikey'=>'permissions', 'allow' => true ],
        		[ 'ikey'=>'users',       'allow' => true ],
        		[ 'ikey'=>'unions',      'allow' => true ],
            ],
            'add' => [],
    	],
    ],

];