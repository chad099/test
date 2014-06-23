<?php

Route::group(array('prefix' => 'social'),function() {

        // Call this route once the user has successfully logged in via FB account.
        Route::get('/fb','ViralTees\Controller\HomeController@loginSocialFb');

        // Call this route once the user has successfully logged in via their Google account.
        Route::get('/google','ViralTees\Controller\HomeController@loginSocialGoogle');
    });
Route::post('fbshare','ViralTees\Controller\client\ClientCampaignController@PostToFacebook');
Route::get('/', 'ViralTees\Controller\HomeController@index');
Route::get('/loginbeta', 'ViralTees\Controller\HomeController@login'); // Original Link
Route::get('/login', 'ViralTees\Controller\customer\CustomerCampaignController@beta'); // Beta Link
Route::post('/login', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@validate'));
Route::get('/register', 'ViralTees\Controller\customer\CustomerCampaignController@beta'); // Original Link 
/*Route::get('/register', 'ViralTees\Controller\HomeController@user_register'); // Beta Link - uncomment after beta*/
Route::post('/subscribe', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\customer\CustomerCampaignController@betaSubscribe'));
Route::post('/register', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@register'));
Route::post('/register/check-public-name', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@checkPublicName'));
Route::get('/forgot-password', 'ViralTees\Controller\HomeController@forgot_password');
Route::get('/password-reset/{token}', 'ViralTees\Controller\HomeController@resetForm');
Route::post('/password-reset', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@reset'));
Route::post('/password-reset/{token}/save', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@saveNewPassword'));
Route::get('/activate/{code}', 'ViralTees\Controller\HomeController@activate');
Route::post('/validate', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@validate'));
Route::post('/authenticated', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@postValidate'));
Route::get('/logout', 'ViralTees\Controller\HomeController@logout');
Route::post('/auth', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@auth'));
Route::get('/how-it-works', 'ViralTees\Controller\HomeController@works');
Route::get('/track-order', 'ViralTees\Controller\customer\CustomerOrderController@index');
Route::post('/track-me', 'ViralTees\Controller\customer\CustomerOrderController@track');
Route::post('/track-find','ViralTees\Controller\customer\CustomerOrderController@trackFind');
Route::get('/about-us', 'ViralTees\Controller\HomeController@about');
Route::get('/faq', 'ViralTees\Controller\HomeController@faq');
Route::get('/terms', 'ViralTees\Controller\HomeController@terms');
Route::get('/privacy', 'ViralTees\Controller\HomeController@privacy');
Route::get('/contact-us', 'ViralTees\Controller\HomeController@contact');
Route::post('/contact-us/send', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\HomeController@contact_email'));

Route::group(
    array('before' => 'auth'),
    function () {
        Route::get('/design', 'ViralTees\Controller\client\ClientCampaignController@create'); //Beta Link

        Route::get('/client', 'ViralTees\Controller\client\ClientCampaignController@index');
        Route::get('/client/campaign', 'ViralTees\Controller\client\ClientCampaignController@index');
        Route::post('/client/campaign/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@store'));
        Route::get('/client/campaign/{id}', 'ViralTees\Controller\client\ClientCampaignController@edit');
        Route::post('/client/campaign/{id}/update', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@update'));
        Route::post('/client/campaign/{id}/end-early', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@endEarly'));
        Route::post('/client/campaign/{id}/message-buyers', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@messageBuyers'));
        Route::post('/client/campaign/{id}/conversion-track', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@updateConversionTracking'));
        Route::post('/client/campaign/{id}/drop-goal', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@dropGoal'));
        Route::post('/client/campaign/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@listCampaigns'));

        Route::get('/client/payout', 'ViralTees\Controller\client\ClientPayoutController@index');
        Route::post('/client/payout/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientPayoutController@listPayouts'));
        Route::post('/client/payout/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientPayoutController@store'));

        Route::any('/client/settings', 'ViralTees\Controller\client\ClientSettingController@index');
        Route::post('/client/settings/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientSettingController@store'));

        Route::get('/admin', 'ViralTees\Controller\admin\DashboardController@index');
        Route::get('/admin/registerbeta', 'ViralTees\Controller\HomeController@user_register'); // Beta Link - remove after beta

        Route::any('/admin/products', 'ViralTees\Controller\admin\ProductController@index');
        Route::any('/admin/products/new', 'ViralTees\Controller\admin\ProductController@create');
        Route::get('/admin/products/{id}/edit', 'ViralTees\Controller\admin\ProductController@edit');
        Route::post('/admin/products/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ProductController@listProducts'));
        Route::any('/admin/products/store', 'ViralTees\Controller\admin\ProductController@store');
        Route::any('/admin/products/{id}/update', 'ViralTees\Controller\admin\ProductController@update');
        Route::get('/admin/products/{app_product_id}/import/{shirts_io_product_id}', 'ViralTees\Controller\admin\ProductController@shirtsIOImport');

        Route::any('/admin/shirts-io-mapping', 'ViralTees\Controller\admin\ProductController@shirtsIoMapping');
        Route::get('/admin/shirts-io-mapping/categories', 'ViralTees\Controller\admin\ProductController@fetchCategories');
        Route::any('/admin/shirts-io-mapping/store', 'ViralTees\Controller\admin\ProductController@shirtsIoMappingStore');


        Route::any('/admin/fulfillment/fulfillment-centers', 'ViralTees\Controller\admin\FulfillmentController@index');
        Route::any('/admin/fulfillment/fulfillment-centers/new', 'ViralTees\Controller\admin\FulfillmentController@create');
        Route::get('/admin/fulfillment/fulfillment-centers/{id}/edit', 'ViralTees\Controller\admin\FulfillmentController@edit');
        Route::post('/admin/fulfillment/fulfillment-centers/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\FulfillmentController@listFulfillment'));
        Route::any('/admin/fulfillment/fulfillment-centers/store', 'ViralTees\Controller\admin\FulfillmentController@store');
        Route::any('/admin/fulfillment/fulfillment-centers/{id}/update', 'ViralTees\Controller\admin\FulfillmentController@update');

        Route::get('/admin/fulfillment/upload-tracking', 'ViralTees\Controller\admin\FulfillmentController@uploadTrackingView');
        Route::get('/admin/fulfillment/download-template', 'ViralTees\Controller\admin\FulfillmentController@downloadTrackingtemplate');
        Route::post('/admin/fulfillment/upload-tracking', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\FulfillmentController@uploadTracking'));

        Route::any('/admin/artwork', 'ViralTees\Controller\admin\ArtWorkController@index');
        Route::get('/admin/artwork/new', 'ViralTees\Controller\admin\ArtWorkController@create');
        Route::post('/admin/artwork/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ArtWorkController@listArtworks'));
        Route::any('/admin/artwork/store', 'ViralTees\Controller\admin\ArtWorkController@store');
        Route::get('/admin/artwork/{id}/edit', 'ViralTees\Controller\admin\ArtWorkController@edit');
        Route::any('/admin/artwork/{id}/update', 'ViralTees\Controller\admin\ArtWorkController@update');

        Route::any('/admin/email-provider', 'ViralTees\Controller\admin\EmailProvider@index');
        Route::post('/admin/email-provider/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\EmailProvider@listProviders'));
        Route::get('/admin/email-provider/new', 'ViralTees\Controller\admin\EmailProvider@create');
        Route::get('/admin/email-provider/{id}/edit', 'ViralTees\Controller\admin\EmailProvider@edit');
        Route::post('/admin/email-provider/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\EmailProvider@store'));
        Route::post('/admin/email-provider/{id}/update', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\EmailProvider@update'));

        Route::any('/admin/payout-request', 'ViralTees\Controller\admin\PayoutRequest@index');
        Route::post('/admin/payout-request/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\PayoutRequest@listPayouts'));
        Route::post('/admin/payout-request/pay', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\PayoutRequest@payClient'));

        Route::any('/admin/trigger-emails', 'ViralTees\Controller\admin\TriggerMails@index');
        Route::get('/admin/trigger-emails/{id}/edit', 'ViralTees\Controller\admin\TriggerMails@edit');
        Route::post('/admin/trigger-emails/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\TriggerMails@listEmailTriggers'));
        Route::post('/admin/trigger-emails/email-logs', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\TriggerMails@listEmailLogs'));
        Route::post('/admin/trigger-emails/{id}/update', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\TriggerMails@update'));

        Route::any('/admin/newsletter', 'ViralTees\Controller\admin\NewsLetter@index');
        Route::post('/admin/newsletter/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\NewsLetter@listNewsLetters'));
        Route::get('/admin/newsletter/new', 'ViralTees\Controller\admin\NewsLetter@create');
        Route::post('/admin/newsletter/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\NewsLetter@store'));

        Route::any('/admin/printers', 'ViralTees\Controller\admin\PrintersController@index');
        Route::get('/admin/printers/new', 'ViralTees\Controller\admin\PrintersController@create');
        Route::post('/admin/printers/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\PrintersController@listPrinters'));
        Route::any('/admin/printers/store', 'ViralTees\Controller\admin\PrintersController@store');
        Route::get('/admin/printers/{id}/edit', 'ViralTees\Controller\admin\PrintersController@edit');
        Route::any('/admin/printers/{id}/update', 'ViralTees\Controller\admin\PrintersController@update');

        Route::any('/admin/users', 'ViralTees\Controller\admin\UserController@index');
        Route::post('/admin/users/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\UserController@listUsers'));
        Route::get('/admin/users/new', 'ViralTees\Controller\admin\UserController@create');
        Route::get('/admin/users/{id}/edit', 'ViralTees\Controller\admin\UserController@edit');
        Route::post('/admin/users/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\UserController@store'));
        Route::post('/admin/users/{id}/update', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\UserController@update'));
        Route::post('/admin/users/get-role-access', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\UserController@getRoleAccess'));

        Route::any('/admin/campaigns', 'ViralTees\Controller\admin\CampaignController@index');
        Route::post('/admin/campaigns/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@listCampaigns'));
        Route::post('/admin/campaigns/orders/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@listOrders'));
        Route::post('/admin/campaigns/customers/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@listCustomers'));
        Route::post('/admin/campaigns/update-goal-drop', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@updateGoalDrop'));
        Route::post('/admin/campaigns/fetch-goal-drop', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@fetchGoalDrop'));
        Route::post('/admin/campaigns/handle-featured', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@handleFeatured'));
        Route::post('/admin/campaigns/suspend', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@Suspend'));
        Route::post('/admin/campaigns/end', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@End'));
        Route::post('/admin/campaigns/request-quote', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@requestQuote'));
        Route::post('/admin/campaigns/{id}/update', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@update'));
        Route::get('/admin/campaigns/{id}', 'ViralTees\Controller\admin\CampaignController@edit');
        Route::post('/admin/campaigns/{id}/change-product-price', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\CampaignController@changeProductPrice'));
        Route::post('/admin/campaigns/send-email', 'ViralTees\Controller\admin\CampaignController@emailToCustomers');
        
        Route::get('/admin/registerbeta', 'ViralTees\Controller\HomeController@user_register'); // Beta Link - remove after beta

        Route::any('/admin/clients', 'ViralTees\Controller\admin\ClientsController@index');
        Route::post('/admin/clients/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ClientsController@listClients'));
        Route::get('/admin/clients/{id}/edit', 'ViralTees\Controller\admin\ClientsController@edit');
        Route::get('/admin/clients/{id}/details', 'ViralTees\Controller\admin\ClientsController@clientDetails');
        Route::post('/admin/clients/{id}/reset-password', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ClientsController@resetPassword'));
        Route::post('/admin/clients/{id}/suspend-account', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ClientsController@suspendAccount'));
        Route::post('/admin/clients/{id}/delete-account', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ClientsController@deleteAccount'));

        Route::post('/admin/clients/{id}/notes/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ClientsController@store_notes'));
        Route::get('/admin/clients/{id}/notes', 'ViralTees\Controller\admin\ClientsController@notes');
        Route::get('/admin/clients/{id}/notes/new/{last_id}', 'ViralTees\Controller\admin\ClientsController@new_notes');

        Route::any('/admin/application-logs', 'ViralTees\Controller\admin\ApplicationLogsController@index');
        Route::post('/admin/application-log/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ApplicationLogsController@listLogs'));
        Route::post('/admin/application-log/delete', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ApplicationLogsController@deleteLogs'));

        Route::any('/admin/settings/application', 'ViralTees\Controller\admin\SettingsController@index');
        Route::post('/admin/settings/application/save', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\SettingsController@save'));
        Route::post('/admin/settings/application/{printer_type}/save-printers-price', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\SettingsController@savePrintersPrice'));

        Route::any('/admin/packaging', 'ViralTees\Controller\admin\PackagingController@index');

        Route::any('/admin/product-categories', 'ViralTees\Controller\admin\ProductCategoriesController@index');
        Route::get('/admin/product-categories/new', 'ViralTees\Controller\admin\ProductCategoriesController@create');
        Route::post('/admin/product-categories/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ProductCategoriesController@listProductsCategory'));
        Route::post('/admin/product-categories/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\ProductCategoriesController@store'));
        Route::get('/admin/product-categories/{id}/edit', 'ViralTees\Controller\admin\ProductCategoriesController@edit');
        Route::any('/admin/product-categories/{id}/update', 'ViralTees\Controller\admin\ProductCategoriesController@update');

        Route::get('/admin/orders', 'ViralTees\Controller\admin\OrderController@index');
        Route::post('/admin/orders/list', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\OrderController@listOrders'));
        Route::get('/admin/orders/{id}', 'ViralTees\Controller\admin\OrderController@view');
        Route::post('/admin/orders/{id}/details', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\OrderController@getOrdersDetails'));
        Route::post('/admin/orders/{id}/cancel-order', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\OrderController@cancel_order'));
        Route::post('/admin/orders/{id}/save-order', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\OrderController@save_order'));
        Route::post('/admin/orders/{id}/save-customer-details', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\OrderController@saveCustomerDetails'));
        Route::post('/admin/orders/{id}/list-charges', 'ViralTees\Controller\admin\OrderController@list_charges');

        Route::get('/admin/faq', 'ViralTees\Controller\admin\ContentManagementController@faq_index');
        Route::post('/design/store', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@store'));

        Route::post('/admin/account/reset-password', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\admin\AccountController@resetPassword'));

        Route::get('/admin/tracking-codes', 'ViralTees\Controller\admin\TrackingCodeController@index');

    }
);

Route::get('/test',function(){
        echo Hash::make('ab030485');
    });

Route::get('/designbetatest', 'ViralTees\Controller\client\ClientCampaignController@create'); //Original Link
// Route::get('/design', 'ViralTees\Controller\customer\CustomerCampaignController@beta'); //Beta Link
Route::post('/design/info', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@campaignData'));
Route::post('/design/check-url', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\client\ClientCampaignController@check_url'));
Route::post('/remote/app-validator', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\ValidationController@validate'));

//Route::get('/reprocess-mails', 'ViralTees\Controller\customer\CustomerCampaignController@reprocessOrderEmails');

Route::post('/purchase/checkout', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\customer\CustomerCampaignController@checkout'));
Route::post('/purchase/place-order', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\customer\CustomerCampaignController@placeOrder'));
Route::post('/purchase/thank-you', array('before' => 'csrf', 'uses' => 'ViralTees\Controller\customer\CustomerCampaignController@thankYou'));
Route::get('/purchase/summary/{order_num}', 'ViralTees\Controller\customer\CustomerCampaignController@orderSummary');
Route::get('/beta', 'ViralTees\Controller\customer\CustomerCampaignController@beta');
Route::get('/{public_name}/{slug}', 'ViralTees\Controller\customer\CustomerCampaignController@index');


