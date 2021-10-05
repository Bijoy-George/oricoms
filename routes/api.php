<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Chat API
Route::post('chat_api', 'ApiChat@chat_api');
Route::post('update_chat_time','ApiChat@update_chat_time');
Route::post('save_chat_logs', 'ApiChat@save_chat_logs');
Route::post('send_message','ApiChat@send_message');
Route::post('update_chat_count','ApiChat@update_chat_count');
Route::post('push_customer_name','ApiChat@push_customer_name');
Route::post('updatecreate_chatfb_count','ApiChat@updatecreate_chatfb_count');
Route::post('chatfileupload','ApiChat@chat_file_upload');
Route::post('save_ticket', 'ChatTicketsController@save_ticket');
Route::post('chat_transcript','ApiChat@chat_transcript');
Route::post('getAutoReplyCategory','ApiChat@get_auto_reply_category');
Route::post('getAutoReplies','ApiChat@get_auto_replies');
Route::post('getFaqReplies','ApiChat@get_faq_replies');
Route::post('insert_abandonedcalls', 'ApiCallcenter@insert_abandonedcalls');
Route::post('lead_api', 'ApiCommon@new_lead');  
// Feedback API
Route::post('feedback_api', 'ApiCommon@feedback_details'); 
Route::post('feedback_insertion', 'ApiCommon@common_feedback_insertion');

// Survey Api
Route::post('survey_insertion', 'ApiCommon@common_survey_insertion');

// Sendgrid Response Api
Route::post('save_email_response', 'ApiCommon@save_email_response'); 

// Dashboard API 
Route::post('lead_line_graph_api','API\DashboardApiController@leads_line_chart'); 
Route::post('lead_source_week','API\DashboardApiController@lead_source_week'); 
Route::post('query_category_week','API\DashboardApiController@query_category_week');
Route::post('general_enquiry_pie_chart','API\DashboardApiController@general_enquiry_pie_chart'); 
Route::post('helpdesk_summary','API\DashboardApiController@helpdesk_summary');
Route::post('agentwise_helpdesk_summary','API\DashboardApiController@agentwise_helpdesk_summary');
Route::post('escalation_summary','API\DashboardApiController@escalation_summary'); 
Route::post('survey_graph', 'API\DashboardApiController@survey_details');
Route::post('feedback_statistics', 'API\DashboardApiController@feedback_statistics');
Route::post('feedback_rating', 'API\DashboardApiController@feedback_rating');   

Route::post('trending_query', 'API\DashboardApiController@trending_query');   
Route::post('reg_by_country_time', 'API\DashboardApiController@reg_by_country_time');
Route::post('daily_followup', 'API\DashboardApiController@daily_followup');
Route::post('lead_source_conversion','API\DashboardApiController@lead_source_conversion');

// Mobile App APIs
Route::post('user_login', 'ApiMobile@user_login');   
Route::post('company-listing', 'ApiMobile@company_listing');  
Route::post('/leadlist', 'ApiMobile@search_leadlist');
Route::post('/profile', 'ApiMobile@view_profile');
Route::post('/save_profile', 'ApiMobile@save_profile');

Route::post('/get_card_credentials', 'ApiPBX@get_card_credentials');
Route::post('todays_performance','API\DashboardApiController@todays_performance');
Route::post('agent_performance','API\DashboardApiController@agent_performance');
