<?php
/**
 * Localized data
 *
 * @copyright   Copyright (C) 2013 XXXXX
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

Dict::Add('FA IR', 'Persian', 'Persian', array(
	// Dictionary entries go here
    'Menu:ComMgmt'=>'مدیریت ارتباطات',


    //buttons
    'Class:Comment/Stimulus:ev_close' => 'بستن',
    'Class:Comment/Stimulus:ev_reject' => 'ابطال',
    'Class:Comment/Stimulus:ev_accept' => 'تایید',

    //fieldsets
    'Comment:baseinfo'=>'اطلاعات عمومی',
    'Comment:date'=>'تاریخ ها',
    'Comment:more'=>'اطلاعات بیشتر',
    'Comment:commentinfo'=>'اطلاعات شکایت',
    'Comment:details'=>'جزئیات شکایت',


    //portal captions
    'Brick:Portal:QuickNewComment:Title'=>'نظر جدید',
    'Brick:Portal:QuickNewComment:Title+'=>'ثبت پیشنهاد یا انتقاد',
    'Brick:Portal:Comment:Title'=>'نظرات',
    'Brick:Portal:Comment:Title+'=>'نظرات ثبت شده',

    //fields
    'Class:Comment' => 'نظر',
    'Class:Comment/Attribute:org_id' => 'سازمان',
	'Class:Comment/Attribute:org_id+' => '',
	'Class:Comment/Attribute:org_name' => 'نام سازمان',
	'Class:Comment/Attribute:org_name+' => '',
	'Class:Comment/Attribute:caller_id' => 'ثبت کننده',
	'Class:Comment/Attribute:caller_id+' => '',
	'Class:Comment/Attribute:caller_name' => 'نام ثبت کننده',
	'Class:Comment/Attribute:caller_name+' => '',
	'Class:Comment/Attribute:team_id' => 'تیم',
	'Class:Comment/Attribute:team_id+' => '',
	'Class:Comment/Attribute:team_name' => 'نام تیم',
	'Class:Comment/Attribute:team_name+' => '',
	'Class:Comment/Attribute:agent_id' => 'کارشناس',
	'Class:Comment/Attribute:agent_id+' => '',
	'Class:Comment/Attribute:agent_name' => 'نام کارشناس',
	'Class:Comment/Attribute:agent_name+' => '',
	'Class:Comment/Attribute:start_date' => 'تاریخ شروع',
	'Class:Comment/Attribute:service_id' => 'سرویس',
	'Class:Comment/Attribute:service_id+' => '',
	'Class:Comment/Attribute:service_name' => 'نام سرویس',
	'Class:Comment/Attribute:service_name+' => '',
	'Class:Comment/Attribute:comment-text' => 'متن نظر',
	'Class:Comment/Attribute:comment-text+' => '',
	'Class:Comment/Attribute:comment_type' => 'نوع نظر',
	'Class:Comment/Attribute:comment_type+' => '',
    'Class:Comment/Attribute:comment' => 'نظر',
	'Class:Comment/Attribute:comment+' => 'نظر',
    'Class:Comment/Attribute:ticket-id' => 'تیکت مربوطه',
	'Class:Comment/Attribute:ticket-id+' => 'تیکت مربوطه',
    
	//Menus
	'Menu:NewComment'=>'نظر جدید',
	'Menu:NewComment+'=>'نظر جدید',
	'Menu:SearchComments'=>'جستجوی نظرات',
	'Menu:SearchComments+'=>'جستجوی نظرات',

	//values
	'Class:Comment/Attribute:comment_type/Value:1' => 'انتقاد',
	'Class:Comment/Attribute:comment_type/Value:2' => 'پیشنهاد',



));
?>
