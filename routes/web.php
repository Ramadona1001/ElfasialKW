<?php

Route::get('/lang/{lang}','LanguageController@index')->name('dashboard_lang');
    
    Route::group(['middleware' => 'Lang'], function () {
        Route::get('/home', 'Frontend\FrontendController@index')->name('frontend_index');
        Route::get('/', 'Frontend\FrontendController@index')->name('frontend_index');

        Route::get('/about-us', 'Frontend\FrontendController@aboutus')->name('frontend_aboutus');

        //Services
        Route::get('/services', 'Frontend\ServicesController@index')->name('frontend_services');
        Route::get('/services/fromchoice/{id}', 'Frontend\ServicesController@fromchoice')->name('frontend_services_fromchoice');
        
        //Services Buffet
        Route::get('/services/buffets/{id}', 'Frontend\ServicesController@buffet_services')->name('frontend_buffet_services');
        Route::get('/services/buffets/single/{id}', 'Frontend\ServicesController@singleBuffets')->name('frontend_services_single_buffets');

        
        //Services Catalogs
        Route::get('/services/catalogs/{id}', 'Frontend\ServicesController@catalogs')->name('frontend_services_catalogs');
        Route::get('/services/catalogs/single/{id}', 'Frontend\ServicesController@singleCatalog')->name('frontend_services_single_catalogs');
        

        //Services Packages
        Route::get('/services/packages/{id}', 'Frontend\ServicesController@packages')->name('frontend_services_packages');
        Route::get('/services/packages/single/{id}', 'Frontend\ServicesController@packagesDetails')->name('frontend_services_packages_details');
        
        //Cart
        Route::get('/cart', 'Frontend\CartController@cart')->name('cart_index');
        Route::post('/cart/add', 'Frontend\CartController@store')->name('cart_store');
        Route::post('/cart/update/{id}', 'Frontend\CartController@update')->name('cart_update');
        Route::get('/cart/remove/{id}', 'Frontend\CartController@remove')->name('cart_remove');
        Route::get('/cart/destroy', 'Frontend\CartController@destroy')->name('cart_destroy');
        Route::get('/cart/checkout', 'Frontend\CartController@checkout')->name('cart_checkout');
        Route::post('/cart/checkout', 'Frontend\CartController@checkoutPost')->name('cart_checkout_post');
        Route::get('/cart/invoices/{id}', 'Frontend\CartController@invoices')->name('cart_invoices');



        

        // Route::get('/services/{id}', 'Frontend\FrontendController@single_services')->name('frontend_single_services');
        // Route::get('/services-details/{id}', 'Frontend\FrontendController@single_services_details')->name('frontend_single_services_details');
        
        // Route::get('/buffet-services-details/{id}', 'Frontend\FrontendController@buffet_services_details')->name('frontend_buffet_services_details');
        // Route::get('/buffet-choice/{id}', 'Frontend\FrontendController@buffet_services_choice')->name('frontend_buffet_services_choice');
        // Route::get('/buffet-choice-details/{id}', 'Frontend\FrontendController@buffet_services_choice_details')->name('frontend_buffet_services_choice_details');
        // Route::get('/buffet-choice-items/{id}', 'Frontend\FrontendController@buffet_services_choice_items')->name('frontend_buffet_services_choice_items');

        // Route::get('/order-view/{id}', 'Frontend\FrontendController@view_order')->name('frontend_order_view');


        // Route::post('/add-to-cart','Frontend\FrontendController@addToCart')->name('frontend_add_to_cart');
        // Route::get('/view-cart','Frontend\FrontendController@viewCart')->name('frontend_view_cart');

        // Route::post('/send-mobile-number','Frontend\FrontendController@sendMobileNumber')->name('frontend_send_mobile');
        // Route::post('/send-mobile-number-post','Frontend\FrontendController@sendMobileNumberPost')->name('frontend_send_mobile_post');
        // Route::post('/save-order-mobile','Frontend\FrontendController@saveOrderMobile')->name('frontend_save_order_mobile');


        // Route::post('/checkout-cart','Frontend\FrontendController@checkoutCart')->name('frontend_checkout_cart');
        // Route::post('/charge-cart','Frontend\FrontendController@chargeCart')->name('frontend_charge_cart');
        // Route::get('/remove-cart-item/{id}','Frontend\FrontendController@removeChartItem')->name('frontend_remove_cart_item');
        Route::post('/send-feedback','Frontend\FrontendController@sendFeedback')->name('frontend_feedback');



        Route::post('/create-new-account', 'Frontend\FrontendController@register')->name('frontend_register');

        Route::get('/portfolio', 'Frontend\FrontendController@portfolio')->name('frontend_portfolio');

        Route::get('/order-rate','Frontend\FrontendController@orderRate')->name('frontend_order_rate')->middleware('auth');


        Route::get('/contact-us','Frontend\FrontendController@contactus')->name('frontend_contactus');
        Route::post('/contactus/send','Frontend\FrontendController@store_contactus')->name('frontend_store_contactus');


        Route::get('/my-account', 'Frontend\FrontendController@myAccount')->name('frontend_myaccount');
        Route::post('/my-account', 'Frontend\FrontendController@myAccountPost')->name('frontend_myaccount_post');
        
        // Route::get('/my-orders', 'Frontend\FrontendController@myorders')->name('frontend_myorders');


        Route::get('/terms-conditions','Frontend\FrontendController@termsConditions')->name('frontend_terms_conditions');






        Auth::routes();

    });