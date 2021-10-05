<?php

include_once __DIR__.'/additional_routes.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

////////////////////////
Route::get('/send_test_email',  'CronController@send_test_email');
Route::get('/send_test',  'CronController@send_test');
Route::get('/',  'DashboardController@index');
//Route::get('/',  'LandpageController@index');
Route::post('/',  'LandpageController@index');
/*Route::get('/', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('/', [
  'as' => '',
  'uses' => 'Auth\LoginController@login'
]);*/

// Route::get('/passwordExpiration','Auth\PwdExpirationController@showPasswordExpirationForm');
// Route::post('/passwordExpiration','Auth\PwdExpirationController@postPasswordExpiration')->name('passwordExpiration');

Auth::routes();

Route::get('/changepassword', ['middleware'=>'check-permission:changepassword','uses'=>'HomeController@changepassword'])->name('changepassword');
Route::post('/postCredentials', ['middleware'=>'check-permission:changepassword','uses'=>'HomeController@postCredentials'])->name('postCredentials');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/setextension', ['middleware'=>'check-permission:outbound call','uses'=>'HomeController@addextension'])->name('setextension');
Route::get('/setextension', ['middleware'=>'check-permission:outbound call','uses'=>'HomeController@setextension'])->name('setextension');

//Dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/cache_clear', 'DashboardController@cache_clear');
Route::post('/dashboardGraph', 'DashboardController@dashboardGraph')->name('dashboardGraph');
//Route::get('/settings', ['middleware'=>'check-permission:settings view','uses'=>'HomeController@settings'])->name('settings');
Route::get('/settings', 'HomeController@settings')->name('settings');
Route::get('/profile_customization', 'HomeController@profile_custom_index');
Route::post('/profile_custom_list', 'HomeController@profile_custom_list');
Route::post('/update_default_fields', 'HomeController@update_default_fields'); 
Route::post('/update_custom_fields', 'HomeController@update_custom_fields');
Route::post('/show_fields', 'HomeController@show_fields'); 
Route::delete('/remove_profile_fields','HomeController@remove_profile_fields'); 
Route::post('/activate_profile_fields','HomeController@activate_profile_fields');
Route::post('/check_report_fields','HomeController@check_report_fields'); 
Route::get('/add_field_options','HomeController@add_field_options');  
Route::post('/get_all_options','HomeController@get_all_options'); 
Route::post('/save_options','HomeController@save_options');   
Route::post('/remove_field_options','HomeController@remove_field_options'); 
//Master table section
//querty type start
Route::post('search_querytype', 'QueryTypesController@search_list');
Route::resource('/query_type', 'QueryTypesController');
//Templates section
Route::resource('/templates', 'TemplatesController');
Route::post('/search_templates', 'TemplatesController@search_list');
Route::post('/search_mailcategory', 'TemplatesController@search_mailcategory')->name('search_mailcategory');
Route::post('/load_selected_template', 'TemplatesController@load_selected_template');
//Faq Categories Section
Route::resource('/faq_categories', 'FaqCategoriesController');
Route::post('/search_category', 'FaqCategoriesController@search_list');
Route::post('/get_cat_by_qtype', 'FaqCategoriesController@get_cat_by_qtype');
//Query Status Section
Route::resource('/query_status', 'QueryStatusContoller');
Route::post('/search_querystatus', 'QueryStatusContoller@search_list');
Route::post('/add_new_querystatus', 'QueryStatusContoller@add_new_querystatus');
//Customer Nature
Route::resource('/customer_nature', 'CustomerNatureController');
Route::post('/search_customernature', 'CustomerNatureController@search_list');
//Query Action
Route::resource('/query_action', 'QueryActionController');
Route::post('/search_query_action', 'QueryActionController@search_list');
//Plan section
Route::resource('/plan', 'PlansController');
Route::post('/search_plan', 'PlansController@search_list');
Route::get('/plan_duration', 'PlansController@plan_duration');
Route::post('/search_plan_duration', 'PlansController@plan_duration_search_list');
Route::get('/plan_duration_create', 'PlansController@plan_duration_create');
Route::get('/plan_duration_edit/{id}', 'PlansController@plan_duration_edit');
Route::post('/plan_duration_store', 'PlansController@plan_duration_store');
Route::post('/couponlisting', 'PlansController@couponlisting');
Route::post('/save_coupon', 'PlansController@save_coupon');
Route::get('/editpromo/{cpn_id}', 'PlansController@editpromo');
Route::post('/addpromo', 'PlansController@add_coupon');
Route::get('/add_discount_offer', 'PlansController@add_discount_offer');
/* Route::post('/add_discount_offer', 'PlansController@add_discount_offer');
Route::post('/discountofferlisting', 'PlansController@discountofferlisting');
Route::get('/editoffer/{offer_id}', 'PlansController@editoffer');
Route::post('/savediscountoffer', 'PlansController@savediscountoffer'); */
Route::delete('/remove_plan_duration','PlansController@remove_plan_duration'); 
Route::post('/activate_plan_duration','PlansController@activate_plan_duration');
//Priority section
Route::resource('/priority', 'PriorityController');
Route::post('/search_priority', 'PriorityController@search_list');
//Company meta section
Route::resource('/company_meta', 'CompanyMetaController');
Route::get('/company_meta', 'CompanyMetaController@show');

Route::get('/channel_gateway', 'CompanyMetaController@channel_gateway');
Route::post('/search_company_meta', 'CompanyMetaController@search_list');
Route::post('/remove_mail_server', 'CompanyMetaController@remove_mail_server');
//Lead Source Types
Route::resource('/lead_source_type', 'LeadSourceTypeController');
Route::post('/search_leadsourcetype', 'LeadSourceTypeController@search_list');
//Lead Sources
Route::resource('/lead_sources', 'LeadSourceController');
Route::get('/lead_sources/{lead_sources_type}/create','LeadSourceController@create');
Route::get('/lead_sources/{lead_source_id}/edit/{lead_source_type_id}','LeadSourceController@edit');
Route::post('/search_leadsource', 'LeadSourceController@search_list');
Route::post('/lead_source_dropdown_list', 'LeadSourceController@lead_source_dropdown_list');
//Master table section end//

// profile section start//
Route::get('/leadlist', 'CustomerProfileController@listing')->name('leadlist');
Route::post('/search_leadlist', 'CustomerProfileController@search_leadlist')->name('search_leadlist');
Route::get('/pipeline', 'CustomerProfileController@pipeline')->name('pipeline');
Route::post('/search_pipelinelist', 'CustomerProfileController@search_pipelinelist')->name('search_pipelinelist');
Route::get('/profile', 'CustomerProfileController@index')->name('profile');
Route::get('/profile/{mobile}', 'CustomerProfileController@index')->name('profile');
Route::get('/profile/{mobile}/{profile_id}', 'CustomerProfileController@index')->name('profile');
Route::get('/profile/{mobile}/{profile_id}/{survey_id}', 'CustomerProfileController@index')->name('profile');
Route::get('/profile/{mobile}/{profile_id}/{survey_id}/{query_type_id}', 'CustomerProfileController@index')->name('profile');
Route::get('/profile/{mobile}/{profile_id}/{survey_id}/{query_type_id}/{call_id}', 'CustomerProfileController@index')->name('profile');
Route::get('/profile/{mobile}/{profile_id}/{survey_id}/{query_type_id}/{call_id}/{doc_no}', 'CustomerProfileController@index')->name('profile');
Route::get('/profile/{mobile}/{profile_id}/{survey_id}/{query_type_id}/{call_id}/{doc_no}/{emailid}', 'CustomerProfileController@index')->name('profile');
Route::get('/profile/{mobile}/{profile_id}/{survey_id}/{query_type_id}/{call_id}/{doc_no}/{emailid}/{pro_status}', 'CustomerProfileController@index')->name('profile');
Route::post('/view_profile','CustomerProfileController@view_profile'); 
Route::post('/view_profile/{pro_status}','CustomerProfileController@view_profile'); 
Route::post('/save_profile','CustomerProfileController@save_profile'); 
Route::post('/search_profile','CustomerProfileController@search_profile');  
Route::post('/get_profile_header','CustomerProfileController@get_profile_header'); 
Route::post('/fetch_customer_fields','CustomerProfileController@fetch_customer_fields'); 
Route::post('/survey_in_profile','CustomerProfileController@survey_in_profile'); 
Route::post('chathistory_listing','CustomerProfileController@chathistory_listing');
Route::post('more_profile_fields','CustomerProfileController@more_profile_fields'); 
Route::post('upload_profile_files','CustomerProfileController@upload_profile_files');
Route::post('/get_profile_by_email','CustomerProfileController@get_profile_by_email'); 
// profile section end//
Route::get('/test', 'CustomerProfileController@getUsers')->name('test');
Route::get('/getCmpChannel', 'CompanyMetaController@getCmpChannel');

// faq section //
Route::resource('faqs', 'FaqController');
Route::post('delfaq', 'FaqController@destroy');
Route::post('search_faqlist', 'FaqController@search_list');
Route::post('add_faq', 'FaqController@add_faq');
Route::post('/faqAutocomplete', 'FaqController@faqAutocomplete');

// Enquiry section //
Route::resource('enquiry', 'EnquiryFollowupController');
Route::post('enquiry/create', 'EnquiryFollowupController@create');
Route::post('get_category', 'EnquiryFollowupController@get_category');
Route::post('check_query_type', 'EnquiryFollowupController@check_query_type');
Route::post('get_query_status', 'EnquiryFollowupController@get_query_status');
Route::post('get_users_by_role', 'EnquiryFollowupController@get_users_by_role');
Route::post('helpdesk_listing', 'EnquiryFollowupController@helpdesk_listing');
Route::post('email_sms_listing', 'EnquiryFollowupController@email_sms_listing');
Route::post('officer_email_sms_listing', 'EnquiryFollowupController@officer_email_sms_listing');
Route::post('followup_listing', 'EnquiryFollowupController@followup_listing');
Route::post('update_helpdesk', 'EnquiryFollowupController@update_helpdesk');
Route::post('update_followup', 'EnquiryFollowupController@update_followup');
Route::post('get_helpdesk_history', 'EnquiryFollowupController@get_helpdesk_history');
Route::post('get_followup_history', 'EnquiryFollowupController@get_followup_history');
Route::post('helpdesk_reopen', 'EnquiryFollowupController@helpdesk_reopen');
Route::post('get_sub_category', 'EnquiryFollowupController@get_sub_category');
Route::post('get_institution', 'EnquiryFollowupController@get_institution');
Route::post('get_nature_of_call', 'EnquiryFollowupController@get_nature_of_call');
Route::post('get_measure_taken', 'EnquiryFollowupController@get_measure_taken');
Route::post('get_call_from', 'EnquiryFollowupController@get_call_from');
Route::post('get_agent_list', 'EnquiryFollowupController@get_agent_list');
Route::post('assign_agents', 'EnquiryFollowupController@assign_agents');
Route::post('curl_test','EnquiryFollowupController@curl_test');
Route::post('get_status_measure', 'EnquiryFollowupController@get_status_measure');
// group section start//
Route::resource('groups', 'GroupController');
Route::post('groups/search', 'GroupController@search_list')->name('groups/search');
Route::post('groups/{group}/contacts_search', 'GroupContactsController@search_list');
Route::get('groups/{group}/lead_import', 'GroupContactsController@lead_index');
Route::post('group_lead_search', 'CustomerProfileController@search_leadlist')->name('group_lead_search');
Route::post('/groups/{group}/add_leads', 'GroupContactsController@add_leads');
Route::get('group_customer_batch_import', 'CronController@group_customer_batch_import');
Route::get('groups/{group}/excel_import', 'GroupContactsController@excel_index');
Route::post('groups/{group}/map_excel_fields', 'GroupContactsController@map_excel_fields');
Route::post('groups/dropdown', 'GroupController@dropdown');
Route::post('groups/{group}/start_excel_import', 'GroupContactsController@create_excel_import_batch');
Route::post('/contacts_import_failed_report', 'GroupContactsController@contacts_import_failed_report');
Route::post('/show_imported_excel_list', 'GroupContactsController@show_imported_excel_list');
Route::get('/download_contact_import_failure_report/{file_name}', 'GroupContactsController@download_contact_import_failure_report');
Route::delete('group_contacts/{group}/delete', 'GroupContactsController@destroy');
Route::post('/batch_groups', 'GroupController@batch_groups');
Route::post('/batch_channels', 'CampaignController@batch_channels');
Route::post('/channel_communication_status', 'CampaignController@channel_communication_status');
// group section end//

// campaign section start//
Route::post('campaigns/search', 'CampaignController@search_list')->name('campaigns/search');
Route::resource('campaigns', 'CampaignController');
Route::post('campaign_meta', 'CampaignController@store_campaign_metadata');
Route::get('process_campaign_email_batches', 'CronController@process_campaign_email_batches');
Route::post('email_send_status_count', 'CampaignController@email_send_status_count');
Route::post('show_batch_efficiency_stats', 'CampaignController@show_batch_efficiency_stats');
Route::post('/email_batch_report', 'CampaignController@email_batch_report');
Route::get('/download_email_batch_report/{file_name}', 'CampaignController@download_email_batch_report');
Route::post('sms_send_status_count', 'CampaignController@sms_send_status_count');
Route::post('/sms_batch_report', 'CampaignController@sms_batch_report');
Route::post('/push_batch_report', 'CampaignController@push_batch_report');
Route::get('/process_campaign_sms_batches', 'CronController@process_campaign_sms_batches');
Route::get('/download_sms_batch_report/{file_name}', 'CampaignController@download_sms_batch_report');
Route::get('/download_push_batch_report/{file_name}', 'CampaignController@download_push_batch_report');
Route::post('autodial_called_status_count', 'CampaignController@autodial_called_status_count');
Route::post('/autodial_batch_report', 'CampaignController@autodial_batch_report');
Route::get('/download_autodial_batch_report/{file_name}', 'CampaignController@download_autodial_batch_report');
Route::post('manualcall_status_count', 'CampaignController@manualcall_status_count');
Route::post('/push_send_status_count', 'CampaignController@push_send_status_count');
Route::post('/manualcall_batch_report', 'CampaignController@manualcall_batch_report');
Route::get('/download_manualcall_batch_report/{file_name}', 'CampaignController@download_manualcall_batch_report');
Route::get('/campaigns/{campaign}/reassign', 'CampaignController@reassign_index');
Route::post('/campaigns/{campaign}/contact_list_search', 'CampaignController@contact_list_search');
Route::post('/campaigns/{campaign}/reassign', 'CampaignController@reassign_contacts');
Route::get('/reassign_campaign_contacts', 'CronController@reassign_campaign_contacts');
// campaign section end//

//Role management starts
Route::resource('/roles', 'RoleController');
Route::post('/search_rolelist', ['middleware'=>'check-permission:role management','uses'=>'RoleController@search_list']);

//Package management starts
Route::resource('/packages', 'PackagePermissionController');
Route::post('/search_packagelist', 'PackagePermissionController@search_list');

//Permission management starts
Route::resource('/permissions', 'PermissionController');
Route::post('/search_permissionslist', 'PermissionController@search_list');

//User management
Route::resource('/userDetails', 'UserManagementController');
Route::post('/search_cus', ['middleware'=>'check-permission:user management','uses'=>'UserManagementController@search_cus']);
Route::get('/editCustomerRole/{customerid}', ['middleware'=>'check-permission:user management','uses'=>'UserManagementController@editCustomerRole']);
Route::post('/customerRoleStore', ['middleware'=>'check-permission:user management','uses'=>'UserManagementController@customerRoleStore']);
Route::get('/userchangepswd/{userid}', ['middleware'=>'check-permission:user management','uses'=>'UserManagementController@userchangepswd'])->name('userchangepswd');
Route::post('/savepassword', ['middleware'=>'check-permission:user management','uses'=>'UserManagementController@savepassword'])->name('savepassword');
Route::post('/to_inactivate_user', ['middleware'=>'check-permission:user management','uses'=>'UserManagementController@to_inactivate_user']);
Route::post('/to_activate_user', ['middleware'=>'check-permission:user management','uses'=>'UserManagementController@to_activate_user']);

// question section //
Route::resource('/questions', 'QuestionController');
Route::post('/search_questionlist',['middleware'=>'check-permission:question management','uses'=>'QuestionController@search_list']);

// Feedback section //

Route::resource('/feedback', 'FeedbackController');
Route::post('/search_feedbacklist',['middleware'=>'check-permission:feedback settings','uses'=>'FeedbackController@search_list']);
Route::post('/get_feedback_form',['middleware'=>'check-permission:feedback settings','uses'=>'FeedbackController@get_feedback_form']);
Route::post('/feedback_status_form',['middleware'=>'check-permission:feedback settings','uses'=>'FeedbackController@feedback_status_form']); 
Route::get('/feedbackform/{randomcode}','FeedbackController@feedbackform'); 
Route::get('/feedback_report', 'FeedbackController@report_index');
Route::post('/report_feedbacklist','FeedbackController@report_list');
Route::post('/more_feedback_det','FeedbackController@more_feedback_det'); 
Route::post('/delete_fb_question', 'FeedbackController@delete_fb_question'); 
Route::post('/export_fb_report', 'FeedbackController@export_fb_report'); 
Route::get('/download_fbreport/{path}', 'FeedbackController@download_fbreport'); 
Route::get('/download_fbreport/{path}/{type}', 'FeedbackController@download_fbreport'); 
// Email Fetch Starts //
Route::get('/emailfetch', 'EmailFetchController@emailfetch');
Route::get('/emailfetchlist', 'EmailFetchController@listing')->name('emailfetchlist');
Route::get('/emailfetchlist/{read}', 'EmailFetchController@listing')->name('email_display');
Route::get('/emailfetchlist/{read}/{unread}', 'EmailFetchController@listing')->name('email_display');
Route::get('/emailfetchlist/{read}/{unread}/{answered}', 'EmailFetchController@listing')->name('email_display');
Route::post('/mail_count_dashboard', ['middleware'=>'check-permission:emailfetch','uses'=>'EmailFetchController@mail_count_dashboard']);
Route::post('/search_emailfetchlist', ['middleware'=>'check-permission:emailfetch','uses'=>'EmailFetchController@search_emailfetchlist'])->name('search_emailfetchlist');
Route::post('/load_mail_thread', 'EmailFetchController@thread_details');
Route::post('/load_mail_template', 'EmailFetchController@load_mail_template');
Route::post('/load_sms_template', 'EmailFetchController@load_sms_template');
Route::post('/load_push_template', 'EmailFetchController@load_push_template');
Route::post('/search_mailcategory', 'TemplatesController@search_mailcategory')->name('search_mailcategory');
Route::post('/search_smscategory', 'TemplatesController@search_smscategory')->name('search_smscategory');
Route::post('/search_pushcategory', 'TemplatesController@search_pushcategory')->name('search_pushcategory');
Route::post('/load_selected_template', 'TemplatesController@load_selected_template');
Route::post('/load_selected_sms_template', 'TemplatesController@load_selected_sms_template');
Route::post('/load_selected_push_template', 'TemplatesController@load_selected_push_template');
Route::post('/compose_mail_template', 'TemplatesController@compose_mail_template');
Route::post('/mail_attachment_upload', 'TemplatesController@mail_attachment_upload');
Route::post('/mail_attachment_upload_profile', 'TemplatesController@mail_attachment_upload_profile');
Route::get('/download_attachment/{fileid}', 'EmailFetchController@download_attachment');
// batch process section start//
Route::resource('batch_process', 'BatchProcessController');

// group section end//

//followup section//
Route::resource('followups', 'FollowupController');
Route::post('/followup_search', 'FollowupController@search_list');
Route::post('/followup_download_history','FileController@download_history');
Route::post('/exportDatafollowups', 'FileController@exportDatahelpdesks');
Route::get('/download_followuphistory/{path}','FileController@download_helpdeskhistory'); 
Route::post('/export_followups', 'FollowupController@export');
Route::get('/download_followup_report/{file_name}', 'FollowupController@download_followup_report');
Route::get('/todayfollowup', 'FollowupController@todayfollowup');


//helpdesk section//
Route::resource('helpdesk', 'HelpdeskController');
Route::post('/helpdesk_search', 'HelpdeskController@search_list');
//Route::post('/get_helpdesk', 'HelpdeskController@get_helpdesk');
Route::post('/enquiry_listing', 'HelpdeskController@enquiry_listing');
Route::post('/download_history','FileController@download_history');
Route::post('/exportDatahelpdesks', 'FileController@exportDatahelpdesks');
Route::get('/download_helpdeskhistory/{path}','FileController@download_helpdeskhistory');
Route::post('/export_helpdesk', 'HelpdeskController@export');
Route::post('/export_disha_helpdesk', 'HelpdeskController@export_disha');
Route::post('/export_ehealth_helpdesk', 'HelpdeskController@export_ehealth');
Route::get('/download_helpdesk_report/{file_name}', 'HelpdeskController@download_helpdesk_report');
Route::post('/export_ehealth_task','HelpdeskController@export_ehealth_task');

Route::get('/tasks','HelpdeskController@taskslist')->name('tasks');
Route::post('/taskslist_search','HelpdeskController@taskslist_search');

// Survey section //

Route::resource('/survey', 'SurveyController');
Route::post('/search_surveylist','SurveyController@search_list');
Route::post('/add_more_questions','SurveyController@add_more_questions');
Route::get('/surveyform/{randomcode}','SurveyController@surveyform');
Route::get('sending_feedback_notification', 'CronController@sending_feedback_notification'); 
Route::get('/survey_report', 'SurveyController@report_index');
Route::post('/report_surveylist','SurveyController@report_list');
Route::get('/more_survey_det/{bid}/{sdate}/{edate}/{cid}/{target}/{response_count}/{sid}/','SurveyController@more_survey_det');
Route::post('/export_survey_report','SurveyController@export_survey_report'); 
Route::get('/download_report/{path}','SurveyController@download_report'); 
Route::post('/survey_customer_report','SurveyController@survey_customer_report'); 

Route::get('/download_survey_report2/{path}','SurveyController@download_survey_report2'); 
Route::post('/get_campaign_batch','SurveyController@get_campaign_batch');  
// INTIMATIONS

Route::resource('/intimation_settings', 'IntimationsController');
Route::get('/intimation/{id}', 'IntimationsController@inti_create');
Route::get('/get_daily_escalate_intimations', 'IntimationsController@get_daily_escalate_intimations');
Route::get('/get_weekly_escalate_intimations', 'IntimationsController@get_weekly_escalate_intimations');
Route::get('/get_monthly_escalate_intimations', 'IntimationsController@get_monthly_escalate_intimations');
Route::get('/going_to_expire_escalate_deadline', 'IntimationsController@going_to_expire_escalate_deadline');
Route::get('/escalate_deadline_expired', 'IntimationsController@escalate_deadline_expired');

Route::get('/get_daily_employee_work_intimations', 'CronController@get_daily_employee_work_intimations');
Route::get('/get_monthly_employee_work_intimations', 'CronController@get_monthly_employee_work_intimations');


//AUTO PROCESS

Route::get('/automated_process_expiry', 'CronController@automated_process_expiry');
Route::get('/automated_process_action', 'CronController@automated_process_action');
Route::get('/automated_process_batching', 'CronController@automated_process_batching');
Route::get('/automated_process_expiry_batching', 'CronController@automated_process_expiry_batching');

Route::get('/automated_process_expiry_customer', 'CronController@automated_process_expiry_customer');
Route::get('/automated_process_action_customer', 'CronController@automated_process_action_customer');
Route::get('/automated_process_batching_customer', 'CronController@automated_process_batching_customer');
Route::get('/automated_process_expiry_batching_customer', 'CronController@automated_process_expiry_batching_customer');

Route::post('search_sales_automation', 'SalesAutomationController@search_list');
Route::resource('/sales_automation', 'SalesAutomationController');

Route::post('search_sales_automation_customer', 'SalesAutomationCustomerController@search_list');
Route::resource('/sales_automation_customer', 'SalesAutomationCustomerController');

// ENTIRE CHAT HISTORY SECTION PAGE FROM PROFILE >> CHAT HISTORY >> VIEW ALL
Route::get('/chat_reports/{customerid}','ApiChat@chat_reports_listing');
Route::post('/search_chat_history','ApiChat@search_list');
Route::post('/export_chat_report','ApiChat@export_chat_report');
Route::get('/download_chatreport/{path}', 'ApiChat@download_chatreport');

//company registration

Route::resource('registration', 'Auth\CompanyRegisterController');

// NOTIFICATIONS
Route::post('/get_notifications','NotificationsController@get_notifications');
Route::post('/update_unreadcount','NotificationsController@update_unreadcount');
Route::post('/read_notification_status','NotificationsController@read_notification_status');
Route::post('search_notifications', 'NotificationsController@search_list');

Route::resource('/notifications', 'NotificationsController');

/*Route::get('importExportView', 'ImportExportController@importExport');
Route::get('downloadExcel/{type}', 'ImportExportController@downloadExcel');
Route::post('import', 'ImportExportController@import')->name('import');*/

Route::get('/ccavRequestHandler','paymentController@ccavRequestHandler');
Route::get('/update_payment','paymentController@update_subscription_details');
//Route::get('/ccavResponseHandler','paymentController@ccavResponseHandler1');
//Route::post('/ccavResponseHandler','paymentController@ccavResponseHandler');
Route::post('/update_payment','paymentController@update_subscription_details');
Route::get('/checkout/{months}/{plan}/{amount}/{company_id}/{percent_off}/{off_amt}/{coup_amt}/{coupon}', 'paymentController@index')->name('payment');
Route::post('/add_to_cart', 'Auth\CompanyRegisterController@addtocart');
Route::post('/nxt_subscribtion', 'paymentController@order_summary');
Route::post('/choose_subcr_period', 'Auth\CompanyRegisterController@choose_subcr_period');
Route::post('/upgraded_subscription', 'paymentController@upgraded_subscription');
Route::get('expiration_status_updation', 'CronController@expiration_status_updation'); 
Route::post('/dismiss_pop_sbcr_exp', 'DashboardController@dismiss_pop_sbcr_exp'); 



//autodial schedule

Route::get('/autodial_schedules', 'CronController@autodial_schedules');
Route::get('/process_campaign_autodial_batches', 'CronController@process_campaign_autodial_batches');
Route::get('/process_campaign_push_batches', 'CronController@process_campaign_push_batches');
Route::get('/process_campaign_manual_call_batches', 'CronController@process_campaign_manual_call_batches');
Route::get('/campaign_push_messages', 'CronController@campaign_push_messages');
Route::get('/send_sms', 'CronController@send_sms');
Route::get('/send_email', 'CronController@send_email');
Route::get('/get_daily_send_email', 'CronController@get_daily_send_email');

// chat-agent report
Route::get('/agent_chat_reports', 'ReportController@index')->name('Agent Chat Report');
Route::post('/agentchatreportresult','ReportController@fetch_agent_chat_report');
Route::post('/fetch_feedback_rating','ReportController@fetch_feedback_rating');
//Route::get('/agent_chat_reports','ApiChat@agent_chat_reports_listing');


//outbound call
Route::get('/outboundcall', 'OutboundcallFollowup@listing');
Route::post('/outboundcall_followup_list','OutboundcallFollowup@outboundcall_followup_list');
Route::get('/agent_calllist', 'OutboundcallFollowup@agent_followups');
Route::post('/agent_followups_list','OutboundcallFollowup@agent_followups_list');
Route::get('/outboundcalls_batchwise_insertion', 'CronController@outboundcalls_batchwise_insertion');

Route::get('/unattendedcall','UnattendedCallController@listing');
Route::post('/list_unattended_calls','UnattendedCallController@search_unattended_calls');
Route::post('/change_unattended_call_status', ['middleware'=>'check-permission:view unattended calls','uses'=>'UnattendedCallController@change_unattended_call_status']);
Route::post('/unattended_call_batch_process', ['middleware'=>'check-permission:view unattended calls','uses'=>'UnattendedCallController@unattended_call_batch_process']);
Route::get('/unattended_calls_batchwise_insertion','UnattendedCallController@unattended_calls_batchwise_insertion');

//Call center API session 
Route::get('/push_custom_voicebroadcast_list', 'ApiCallcenter@push_custom_voicebroadcast_list');
//Priority section
Route::resource('/tab', 'TabController');
Route::post('/search_tab', 'TabController@search_list');

// Chat Configuration
Route::get('/chat_configuration','ChatConfigurationController@index');
Route::post('/search_leadsource_chat', 'ChatConfigurationController@search_list');
Route::post('/generate_random_key_for_chat','ChatConfigurationController@generate_random_key_for_chat');
Route::post('/reset_chat_count', 'HomeController@reset_chat_count');

// contry state district relations


Route::post('/get_location','CustomerProfileController@get_location');
Route::post('/get_localbody','CustomerProfileController@get_localbody'); 
Route::post('/get_panchayath_details','CustomerProfileController@get_panchayath_details');
Route::post('/get_officer_details','CustomerProfileController@get_officer_details');
Route::post('/get_call_url','CustomerProfileController@get_call_url');


Route::get('leadlist/excel_import', 'ExcelImportController@excel_index');
Route::post('leadlist/map_excel_fields', 'ExcelImportController@map_excel_fields');
Route::post('groups/start_excel_import', 'ExcelImportController@create_excel_import_batch');

Route::post('/get_panchayath','CustomerProfileController@get_panchayath');
Route::post('/get_block_panchayath','CustomerProfileController@get_block_panchayath'); 

// TEST Routs
Route::get('file_upload_form','TestController@temp_fun'); 
Route::post('file_upload','TestController@temp_fun1'); 

//Chat Auto Reply Custom Categories Section
Route::resource('/auto_reply_categories', 'AutoReplyCategoriesController');
Route::post('/search_autoreply_category', 'AutoReplyCategoriesController@search_list');

//Chat Auto Replies Section
Route::resource('/chat_auto_reply','ChatAutoReplyController');
Route::post('/search_autoreplylist', 'ChatAutoReplyController@search_list');

// IMPORT CUSTOMERS
Route::get('import_customers', 'CustomerProfileController@import_customer_index');
Route::post('import_customer_select_fields', 'CustomerProfileController@import_customer_select_fields');
Route::post('import_customer_table', 'CustomerProfileController@import_customer_table');
Route::post('customer_excel_import_batch', 'CustomerProfileController@customer_excel_import_batch');

//Email & SMS Response Section
Route::get('save_email_response', 'ApiCommon@save_email_response');
Route::post('save_email_response', 'ApiCommon@save_email_response');

/* Start routes for supply offices module */
//Faq Categories Section
Route::resource('/supply_offices', 'SupplyOfficesController');
Route::post('/search_supply_offices', 'SupplyOfficesController@search_list');
Route::post('/get_taluk_supply_office', 'SupplyOfficesController@get_taluk_supply_office');
//Query Status Section
/* end routes for supply offices module */
//report section

Route::get('/escalation_report', 'ReportController@escalation_report');
Route::post('/escalation_view_reports', 'ReportController@escalation_view_reports');

//supply card start
Route::post('search_supply_card', 'SupplyCardController@search_list');
Route::resource('/supply_card', 'SupplyCardController');

Route::post('update_profile_status', 'CustomerProfileController@update_profile_status');
Route::post('/get_email_sms_detail', 'CustomerProfileController@get_email_sms_detail');
Route::post('/get_sms_details', 'CustomerProfileController@get_sms_details');
Route::post('/export_leads','CustomerProfileController@exportleads');
Route::post('/export_disha_leads','CustomerProfileController@export_disha_leads');
Route::post('/export_leads_with_helpdesk','CustomerProfileController@export_leads_with_helpdesk');
Route::get('/download_leadlist_report/{file_name}', 'CustomerProfileController@download_leadlist_report');
Route::post('pauseBatch', 'CampaignController@pause_batch');
Route::post('resumeBatch', 'CampaignController@resume_batch');

/// Stage and stage history
Route::post('/get_auto_process_status', 'SalesAutomationCustomerController@get_auto_process_status');
Route::get('/customer_stage_history/{id}/{cmpny_id}', 'SalesAutomationCustomerController@customer_stage_history');
Route::post('/stage_history', 'SalesAutomationCustomerController@stage_history');

//Project
Route::resource('/projects', 'ProjectController');
Route::post('/search_projects', 'ProjectController@search_list');

Route::get('/project_intimations', 'ProjectIntimationsController@show');
Route::post('/project_intimations', 'ProjectIntimationsController@store');

Route::post('/export_projectlist','ProjectController@export_projectlist');
Route::get('/download_project_report/{file_name}', 'ProjectController@download_project_report');

//Project management master Task
Route::resource('/pm_master', 'ProjectManagementMaster');
Route::post('/search_pm_master', 'ProjectManagementMaster@search_list');

//Project Task
Route::resource('/project_task_pm', 'ProjectTaskController');
Route::post('/search_project_tasks', 'ProjectTaskController@search_list');
Route::post('/get_project_members', 'ProjectTaskController@get_project_members');

Route::get('/view_details', 'ProjectTaskController@view_working_details');
Route::post('/employees_work','ProjectTaskController@employees_work');

Route::post('/export_projecthours','ProjectTaskController@export_projecthours');
Route::get('/download_project_task_report/{file_name}', 'ProjectTaskController@download_project_task_report');

//Tracker
Route::resource('/tracker', 'TrackerController', ['except' => ['create']]);
Route::post('/search_tracker', 'TrackerController@search_list');

Route::get('/tracker_list', 'TrackerController@tracker_index');
Route::post('/search_tracker_list', 'TrackerController@tracker_search_list');

Route::get('/tracker_data/edit/{id}', 'TrackerController@tracker_data_edit');
Route::get('/tracker/create/{id}', 'TrackerController@create');

Route::get('/tracker_history_index', 'TrackerController@tracker_history_index');
Route::post('/tracker_history_details','TrackerController@tracker_history_details');
Route::get('/tracker_history_details','TrackerController@tracker_history_details');
Route::post('/export_trackerhours','TrackerController@export_trackerhours');
Route::get('/download_tracker_report/{file_name}', 'TrackerController@download_tracker_report');


Route::post('/check_mail_server_connection', 'CompanyMetaController@check_mail_server_connection');
Route::post('/export_taskslist','ProjectTaskController@export_taskslist');
Route::get('/download_projecttask_report/{file_name}', 'ProjectTaskController@download_projecttask_report');
Route::post('/tasks_graph', 'TrackerController@tasks_graph');
Route::post('/get_task_list', 'TrackerController@get_task_list');
Route::post('/export_trackerlog', 'TrackerController@export_trackerlog');
Route::get('/download_task_log_report/{file_name}', 'TrackerController@download_task_log_report');


//server management
Route::resource('/server','ServerController');
Route::post('/search_server', 'ServerController@search_list');
Route::get('/service_edit/{id}', 'ServerController@serviceedit');
Route::post('/server_service', 'ServerController@server_service');
Route::post('/service_edit', 'ServerController@service_edit');
Route::get('/server_details1/{id}', 'ServerController@server_deatials');
Route::post('/server_details_list', 'ServerController@server_details_list');
Route::get('/server_resource_alert', 'ServerController@resource_alert');
Route::delete('/service_resource_delete/{id}','ServerController@service_resource_delete');

Route::resource('/services','ServiceController');
Route::post('/search_service', 'ServiceController@search_list');
Route::post('/export_server_report', 'ServerController@export_server_report');
Route::get('/download_server_report/{file_name}', 'ServerController@download_server_report');
Route::post('/server_qamonitoring','ServerController@server_qamonitoring');

//Route::post('/server_monitoring', 'ServerController@server_monitoring');

// company_details
Route::resource('/company','CompanyListController');
Route::post('/search_company','CompanyListController@search_list');
// Route::post('/compy_details/{id}','CompanyListController@update');

Route::post('/server_monitoring', 'ServerController@server_monitoring');
Route::get('/server_reports','ServerController@server_reports');
Route::get('/test_export','ServerController@test_export');
Route::get('/server_monitor','ServerController@server_monitor');

// userstories

Route::resource('/userstory','UserstoryController');
Route::post('/search_userstory','UserstoryController@search_list');
Route::get('/addUserstoryTask/{id}', ['uses'=>'UserstoryController@addUserstoryTask']);
Route::post('/taskstore', 'UserstoryController@taskstore');
Route::get('/taskstore', 'UserstoryController@taskstore');
Route::get('/scrumboard', ['uses'=>'UserstoryController@scrumboard']);
Route::post('/scrumboardview', ['uses'=>'UserstoryController@scrumboardview']);
Route::get('/taskList/{id}', ['uses'=>'UserstoryController@taskList']);
Route::get('/taskedit/{task_id}/{userstory_id}', ['uses'=>'UserstoryController@taskedit']);
Route::post('/search_task', ['uses'=>'UserstoryController@search_task']);
Route::get('taskList/addUserstoryTask/{id}', ['uses'=>'UserstoryController@addUserstoryTask']);

//Customer Response
Route::resource('/customer_response', 'CustomerResponseController');
Route::post('/search_customer_response', 'CustomerResponseController@search_list');
Route::post('/get_customer_response', 'CustomerResponseController@get_customer_response');

Route::post('/get_doctors_list','CustomerProfileController@get_doctors_list');
Route::post('/get_call_url_doctor','CustomerProfileController@get_call_url_doctor');

Route::post('/get_major_details','CustomerProfileController@get_major_details');
Route::post('/get_call_url_major','CustomerProfileController@get_call_url_major');

//Institution Section
Route::resource('/institution', 'InstitutionController');
Route::post('/search_institution', 'InstitutionController@search_list');
Route::get('/krishi_sms', 'CustomerProfileController@krishi_sms');

Route::get('/followups_notification', 'CronController@followups_notification');

//Mail Library Test 26-10-2020
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');
Route::get('email-test','MailController@send_email');
Route::get('/email_report', 'ReportController@report_email');
Route::post('/search_email_reports','ReportController@search_email_reports');
Route::post('/get_email_sms_detail_report','ReportController@getEmailSmsDetail');
//Mail Library Test 26-10-2020

