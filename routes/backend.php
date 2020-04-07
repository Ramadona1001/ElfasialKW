<?php

Route::prefix('dashboard')->group(function(){
    
    
    Route::get('/lang/{lang}','LanguageController@index')->name('dashboard_lang');
    
    Route::group(['middleware' => 'Lang'], function () {
        
        //Dashboard
        Route::get('/','HomeController@index')->name('dashboard_index');
        Route::get('/home', 'HomeController@index')->name('home_index');
        Route::get('/calendar/orders', 'HomeController@calendar_orders')->name('calendar_orders');


        Route::get('/users','UsersController@index')->name('users');
        Route::get('/users/create','UsersController@create')->name('create_users');
        Route::post('/users/create','UsersController@store')->name('store_users');
        Route::get('/users/edit/{id}','UsersController@edit')->name('edit_users');
        Route::post('/users/update/{id}','UsersController@update')->name('update_users');
        Route::get('/users/profile/{id}','UsersController@profile')->name('profile_users');
        Route::post('/users/profile/{id}','UsersController@profile_update')->name('profile_update_users');
        Route::get('/users/delete/{id}','UsersController@destroy')->name('delete_users');
        Route::get('/users/show/{id}','UsersController@show')->name('show_users');
        Route::get('/users/permissions/{id}','UsersController@permissions')->name('permissions_users');
        Route::post('/users/permissions','UsersController@permissionsAssign')->name('assign_permissions_users');
        Route::post('/users/departments','UsersController@departments')->name('assign_departments_users');

        //Customers

        Route::get('/customers','CustomersController@index')->name('customers');
        Route::get('/customers/create','CustomersController@create')->name('create_customers');
        Route::post('/customers/create','CustomersController@store')->name('store_customers');
        Route::get('/customers/edit/{id}','CustomersController@edit')->name('edit_customers');
        Route::post('/customers/update/{id}','CustomersController@update')->name('update_customers');
        Route::get('/customers/delete/{id}','CustomersController@destroy')->name('delete_customers');
        Route::get('/customers/show/{id}','CustomersController@show')->name('show_customers');
        Route::get('/customers/roles/assign/{id}','CustomersController@assignRoles')->name('assign_users_roles');
        Route::get('/customers/roles/assign/{id}','CustomersController@assignRolesPost')->name('assign_users_roles');

        //Departments Routes
        
        Route::get('/departments','DepartmentsController@index')->name('departments');
        Route::get('/departments/create','DepartmentsController@create')->name('create_departments');
        Route::post('/departments/create','DepartmentsController@store')->name('store_departments');
        Route::get('/departments/edit/{id}','DepartmentsController@edit')->name('edit_departments');
        Route::post('/departments/update/{id}','DepartmentsController@update')->name('update_departments');
        Route::get('/departments/show/{id}','DepartmentsController@show')->name('show_departments');
        Route::get('/departments/delete/{id}','DepartmentsController@destroy')->name('delete_departments');
        Route::get('/departments/users/create/{id}','DepartmentsController@createusers')->name('create_users_departments');
        Route::post('/departments/users/store/{id}','DepartmentsController@storesers')->name('store_users_departments');
        Route::get('/departments/users/delete/{id}','DepartmentsController@destroyusers')->name('delete_users_departments');

        //Departments Tasks Routes
        
        Route::get('/department_tasks','DepartmentTaskController@index')->name('department_tasks');
        Route::get('/department_tasks/create','DepartmentTaskController@create')->name('create_department_tasks');
        Route::post('/department_tasks/create','DepartmentTaskController@store')->name('store_department_tasks');
        Route::get('/department_tasks/edit/{id}','DepartmentTaskController@edit')->name('edit_department_tasks');
        Route::post('/department_tasks/update/{id}','DepartmentTaskController@update')->name('update_department_tasks');
        Route::get('/department_tasks/show/{id}','DepartmentTaskController@show')->name('show_department_tasks');
        Route::get('/department_tasks/delete/{id}','DepartmentTaskController@destroy')->name('delete_department_tasks');

        //Categories Routes
        
        Route::get('/category','CategoryController@index')->name('category');
        Route::get('/category/create','CategoryController@create')->name('create_category');
        Route::post('/category/create','CategoryController@store')->name('store_category');
        Route::get('/category/edit/{id}','CategoryController@edit')->name('edit_category');
        Route::post('/category/update/{id}','CategoryController@update')->name('update_category');
        Route::get('/category/show/{id}','CategoryController@show')->name('show_category');
        Route::get('/category/delete/{id}','CategoryController@destroy')->name('delete_category');

        //Catalogs Routes
        
        Route::get('/catalogs','CatalogsController@index')->name('catalogs');
        Route::get('/catalogs/create','CatalogsController@create')->name('create_catalogs');
        Route::post('/catalogs/create','CatalogsController@store')->name('store_catalogs');
        Route::get('/catalogs/edit/{id}','CatalogsController@edit')->name('edit_catalogs');
        Route::post('/catalogs/update/{id}','CatalogsController@update')->name('update_catalogs');
        Route::get('/catalogs/show/{id}','CatalogsController@show')->name('show_catalogs');
        Route::get('/catalogs/delete/{id}','CatalogsController@destroy')->name('delete_catalogs');

        //Catalogs Items Routes
        
        Route::get('/items/create/{id}','CatalogItemsController@create')->name('create_items');
        Route::post('/items/create/{id}','CatalogItemsController@store')->name('store_items');
        Route::get('/items/delete/{id}','CatalogItemsController@destroy')->name('delete_items');

        //Buffets Items Routes
        
        Route::get('/buffets','BuffetController@index')->name('buffets');
        Route::get('/buffets/create','BuffetController@create')->name('create_buffets');
        Route::post('/buffets/create','BuffetController@store')->name('store_buffets');
        Route::get('/buffets/edit/{id}','BuffetController@edit')->name('edit_buffets');
        Route::post('/buffets/update/{id}','BuffetController@update')->name('update_buffets');
        Route::get('/buffets/show/{id}','BuffetController@show')->name('show_buffets');
        Route::get('/buffets/delete/{id}','BuffetController@destroy')->name('delete_buffets');
        Route::get('/buffets/create/items/{id}','BuffetController@createItems')->name('create_items_buffets');
        Route::post('/buffets/create/items/{id}','BuffetController@storeItems')->name('store_items_buffets');
        Route::get('/buffets/deleteItemBuffet/{id}','BuffetController@deleteItemBuffet')->name('delete_item_buffets');
        Route::get('/buffets/deleteImg/{id}','BuffetController@deleteImg')->name('delete_image');

        //Packages Routes
        
        Route::get('/packages','PackageController@index')->name('packages');
        Route::get('/packages/create','PackageController@create')->name('create_packages');
        Route::post('/packages/create','PackageController@store')->name('store_packages');
        Route::get('/packages/edit/{id}','PackageController@edit')->name('edit_packages');
        Route::post('/packages/update/{id}','PackageController@update')->name('update_packages');
        Route::post('/packages/update/items/{id}','PackageController@updateItems')->name('update_items_packages');
        Route::get('/packages/delete/items/{id}','PackageController@deleteItems')->name('delete_items_packages');
        Route::get('/packages/create/items/{id}','PackageController@createItemsPackage')->name('create_items_packages');
        Route::post('/packages/create/items/{id}','PackageController@createItemsPackagePost')->name('create_items_packages_post');

        Route::get('/packages/show/{id}','PackageController@show')->name('show_packages');
        Route::get('/packages/delete/{id}','PackageController@destroy')->name('delete_packages');
        Route::get('/packages/delete/package/{id}','PackageController@destroyPackage')->name('destroy_packages');
        // Route::get('/packages/create/items/{id}','PackageController@createItems')->name('create_items_packages');
        // Route::get('/packages/deleteItemBuffet/{id}','PackageController@deleteItemBuffet')->name('delete_item_packages');

        //From Choices Routes
        
        Route::get('/fromchoices','FromChoiveController@index')->name('fromchoices');
        Route::get('/fromchoices/create','FromChoiveController@create')->name('create_fromchoices');
        Route::post('/fromchoices/create','FromChoiveController@store')->name('store_fromchoices');
        Route::get('/fromchoices/items/create/{id}','FromChoiveController@itemsCreate')->name('create_items_fromchoices');
        Route::post('/fromchoices/items/create','FromChoiveController@itemsStore')->name('store_items_fromchoices');
        Route::post('/fromchoices/items/update/{id}','FromChoiveController@itemsUpdate')->name('update_items_fromchoices');
        Route::get('/fromchoices/edit/{id}','FromChoiveController@edit')->name('edit_fromchoices');
        Route::post('/fromchoices/update/{id}','FromChoiveController@update')->name('update_fromchoices');
        Route::get('/fromchoices/show/{id}','FromChoiveController@show')->name('show_fromchoices');
        Route::get('/fromchoices/delete/{id}','FromChoiveController@destroy')->name('delete_fromchoices');
        Route::get('/fromchoices/deleteItemBuffet/{id}','FromChoiveController@deleteItemBuffet')->name('delete_item_fromchoices');
        Route::get('/fromchoices/deleteimg/{id}','FromChoiveController@deleteimg')->name('delete_img_fromchoices');

        //Inventory Routes
        
        Route::get('/inventory','InventoryController@index')->name('inventory');
        Route::get('/inventory/create','InventoryController@create')->name('create_inventory');
        Route::post('/inventory/create','InventoryController@store')->name('store_inventory');
        Route::get('/inventory/edit/{id}','InventoryController@edit')->name('edit_inventory');
        Route::post('/inventory/update/{id}','InventoryController@update')->name('update_inventory');
        Route::get('/inventory/show/{id}','InventoryController@show')->name('show_inventory');
        Route::get('/inventory/delete/{id}','InventoryController@destroy')->name('delete_inventory');
        Route::get('/inventory/items/{id}','InventoryController@items')->name('items_inventory');
        Route::get('/inventory/withdraw/items/{id}','InventoryController@withdraw_items')->name('withdraw_items');
        Route::get('/inventory/withdraw/show','InventoryController@withdrawShow')->name('withdraw_inventory_show');
        Route::post('/inventory/withdraw','InventoryController@withdraw')->name('withdraw_inventory');
        Route::post('/inventory/updatequantity/{id}','InventoryController@updateQuantity')->name('updatequantity_inventory');

        //Items Inventory Routes
        
        Route::get('/iteminventory','ItemInventoryController@index')->name('iteminventory');
        Route::get('/iteminventory/create','ItemInventoryController@create')->name('create_iteminventory');
        Route::post('/iteminventory/create','ItemInventoryController@store')->name('store_iteminventory');
        Route::get('/iteminventory/edit/{id}','ItemInventoryController@edit')->name('edit_iteminventory');
        Route::post('/iteminventory/update/{id}','ItemInventoryController@update')->name('update_iteminventory');
        Route::get('/iteminventory/show/{id}','ItemInventoryController@show')->name('show_iteminventory');
        Route::get('/iteminventory/delete/{id}','ItemInventoryController@destroy')->name('delete_iteminventory');
        

        //Orders Routes
        
        Route::get('/orders','OrdersController@index')->name('orders');
        Route::get('/orders/create','OrdersController@create')->name('create_orders');
        Route::post('/orders/create','OrdersController@store')->name('store_orders');
        Route::get('/orders/edit/{id}','OrdersController@edit')->name('edit_orders');
        // Route::post('/orders/update/{id}','OrdersController@update')->name('update_orders');
        Route::post('/orders/update/items','OrdersController@updateItemOrder')->name('update_items_orders');
        Route::post('/orders/delete/items','OrdersController@deleteItemOrder')->name('delete_items_orders');
        Route::get('/orders/return/items/{id}','OrdersController@returnItemOrder')->name('return_items_orders');
        Route::post('/orders/return/items','OrdersController@returnItemOrderPost')->name('return_items_orders_post');


        Route::get('/orders/show/{id}','OrdersController@show')->name('show_orders');
        Route::get('/orders/delete/{id}','OrdersController@destroy')->name('delete_orders');
        Route::get('/orders/customer/data/{id}','OrdersController@customers')->name('customers_orders');
        Route::get('/orders/catalog/data/{id}','OrdersController@catalogs')->name('catalogs_orders');
        Route::get('/orders/tasksorders/{id}','OrdersController@tasksOrders')->name('tasksorders_inventory');
        Route::post('/orders/tasksorders','OrdersController@storeTasksOrders')->name('store_tasksorders_inventory');
        
        Route::get('/orders/contracts/{id}','OrdersController@contractsTerms')->name('contractsTerms');
        
        //Print Order
        Route::post('/orders/print','OrdersController@printOrder')->name('printOrder');

        
        
        //profitstatistic
        Route::get('/profitstatistic','HomeController@profitstatistic')->name('profitstatistic');


        //statistic
        Route::get('/statistic','HomeController@statistic')->name('statistic');



        Route::get('/profits','OrdersController@profits')->name('profits');




        // order_review
        Route::get('/orders/reviews/{id}','OrdersController@reviews')->name('reviews_orders');
        Route::get('/order_review/create','OrdersController@create_order_review')->name('create_order_review');
        Route::post('/order_review/store','OrdersController@store_order_review')->name('store_order_review');



        //contact us
        Route::get('/contactus', 'ContactUsController@index')->name('contactus');
        Route::get('/contactus/create','ContactUsController@create')->name('create_contactus');
        Route::post('/contactus/send','ContactUsController@store')->name('store_contactus');



        // setting

        Route::get('/settings', 'SettingsController@index')->name('settings_index');
        Route::post('/settings/update', 'SettingsController@update')->name('settings_update');


        // end setting

        // social_media

        Route::get('/social_media', 'SocialMediasController@index')->name('social_media_index');
        Route::post('/social_media/update', 'SocialMediasController@update')->name('social_media_update');


        //Tasks Routes
        
        Route::get('/tasks','TasksController@index')->name('tasks');
        Route::get('/tasks/create','TasksController@create')->name('create_tasks');
        Route::post('/tasks/create','TasksController@store')->name('store_tasks');
        Route::get('/tasks/show/{id}','TasksController@show')->name('show_tasks');
        Route::get('/tasks/delete/{id}','TasksController@destroy')->name('delete_tasks');
        Route::get('/tasks/order/data/{id}','TasksController@orders')->name('orders_tasks');
        Route::get('/tasks/decode_data/{id}','TasksController@decode_data')->name('decode_data_tasks');
        Route::get('/tasks/catalog/data/{id}','TasksController@catalogs')->name('catalogs_tasks');
        Route::get('/tasks/catalogItems/data/{id}','TasksController@catalogsItems')->name('catalogsitems_tasks');
        Route::get('/tasks/customers/data/{id}','TasksController@customers')->name('customers_tasks');
        Route::get('/tasks/users/data/{id}','TasksController@users')->name('users_tasks');
        Route::get('/tasks/departments/data/{id}','TasksController@departments')->name('departments_tasks');
        Route::get('/tasks/departments/tasks/{id}','TasksController@departmentTasks')->name('departments_tasks_tasks');

        Route::get('/mytasks','TasksController@mytasks')->name('departments_mytasks');
        Route::get('/mytasks/changestatus/pending/{id}','TasksController@pendingMyTasks')->name('departments_pending_mytasks');
        Route::get('/mytasks/changestatus/finish/{id}','TasksController@finishMyTasks')->name('departments_finish_mytasks');
        
        //Feedback
        Route::get('/feedbacks','HomeController@feedbacks')->name('feedbacks');

        //Contracts Routes
        
        Route::get('/contracts','ContractController@index')->name('contracts');
        Route::get('/contracts/create','ContractController@create')->name('create_contracts');
        Route::post('/contracts/create','ContractController@store')->name('store_contracts');
        Route::get('/contracts/edit/{id}','ContractController@edit')->name('edit_contracts');
        Route::post('/contracts/update/{id}','ContractController@update')->name('update_contracts');
        Route::get('/contracts/show/{id}','ContractController@show')->name('show_contracts');
        Route::get('/contracts/delete/{id}','ContractController@destroy')->name('delete_contracts');

        //Terms Routes
        
        Route::get('/terms','ContractController@terms_index')->name('terms_index');
        Route::get('/terms/create','ContractController@terms_create')->name('terms_create');
        Route::post('/terms/create','ContractController@terms_store')->name('terms_store');
        Route::get('/terms/edit/{id}','ContractController@terms_edit')->name('terms_edit');
        Route::post('/terms/update/{id}','ContractController@terms_update')->name('terms_update');
        Route::get('/terms/show/{id}','ContractController@terms_show')->name('terms_show');
        Route::get('/terms/delete/{id}','ContractController@terms_destroy')->name('terms_destroy');

        Route::get('/contract/delete/terms/{id}','ContractController@contract_terms_delete')->name('contract_terms_delete');


        //Roles Routes

        // Route::get('/roles','RolesController@index')->name('roles');
        // Route::get('/roles/create','RolesController@create')->name('create_roles');
        // Route::get('/roles/edit/{id}','RolesController@edit')->name('edit_roles');
        // Route::post('/roles/create','RolesController@store')->name('store_roles');
        // Route::post('/roles/update/{id}','RolesController@update')->name('update_roles');
        // Route::get('/roles/delete/{id}','RolesController@destroy')->name('delete_roles');
        // Route::get('/roles/show/{id}','RolesController@show')->name('show_roles');
        // Route::get('/roles/revoke/{user}/{role}','RolesController@revoke')->name('revoke_users');
        // Route::get('/roles/assign/permissions/{id}','RolesController@assignPermission')->name('assign_permissions');
        // Route::post('/roles/assign/permissions/{id}','RolesController@assignPermissionPost')->name('assign_permissions_post');
        
        //Premissions Routes
        
        // Route::get('/permissions','PermissionsController@index')->name('permissions');
        // Route::get('/permissions/create','PermissionsController@create')->name('create_permissions');
        // Route::post('/permissions/create','PermissionsController@store')->name('store_permissions');
        // Route::get('/permissions/edit/{id}','PermissionsController@edit')->name('edit_permissions');
        // Route::post('/permissions/update/{id}','PermissionsController@update')->name('update_permissions');
        // Route::get('/permissions/show/{id}','PermissionsController@show')->name('show_permissions');
        // Route::get('/permissions/delete/{id}','PermissionsController@destroy')->name('delete_permissions');

        // Route::get('/users/roles/assign/{id}','UsersController@assignRoles')->name('assign_users_roles');
        // Route::get('/users/roles/assign/{id}','UsersController@assignRolesPost')->name('assign_users_roles');
        
    });
    
    

        //Route::group(['middleware' => ['role:Admin']], function () {
        //Users Routes

        
    //});

//    contact us





});