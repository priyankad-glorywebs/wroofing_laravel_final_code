<?php

use Illuminate\Support\Facades\Route;
// auth routes  for customer and contractor 
use App\Http\Controllers\Front\Auth\LoginController;
use App\Http\Controllers\Front\Auth\ContractorLoginController;
use App\Http\Controllers\Front\Auth\RegistrationController;
use App\Http\Controllers\CustomVerificationController;
use App\Http\Controllers\SocialFacebookController;
use App\Http\Controllers\SocialGoogleController;
use App\Http\Controllers\Front\Auth\ForgotPasswordController;
use App\Http\Controllers\Front\Auth\ResetPasswordController;
use App\Http\Controllers\Front\Auth\ContractorForgotPasswordController;
use App\Http\Controllers\Front\Auth\ContractorResetPasswordController;
use App\Http\Controllers\Front\ChatController;
use App\Http\Controllers\Front\Contractor\ContractorPortfolioController;
use App\Http\Controllers\QuotationInformationController;
use App\Http\Controllers\Front\ContactusController;
use App\Http\Controllers\Front\ChangePasswordController;
use App\Http\Controllers\Front\Customer\ProjectController;
use App\Http\Controllers\Front\Contractor\ContractorController;
use App\Http\Controllers\Front\QuotationController;
use App\Http\Controllers\Front\StripeController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\BrandingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportSectionController;


/*********************************************************/
//   -------------Guest route start ----------------
/*********************************************************/
Route::group(['middleware' => ['cache']], function () {
Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/test', [ProjectController::class, 'test'])->name('test');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    echo '<pre>';
    echo \Artisan::output();
    echo '</pre>';
});

Route::get('about-us',[ContactusController::class,'aboutus'])->name('about-us');
Route::get('pdfview/{quoteid}',[QuotationController::class,'pdfview'])->name('pdfview');
Route::get('/register', [RegistrationController::class, 'registerStepOne'])->name('register.one');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');

//contact us page && term and condition page  guest routes
Route::get('/contact-us',[ContactusController::class,'contactus'])->name('contact-us');
Route::post('contact/store',[ContactusController::class,'store'])->name('contact.submit');
Route::get('terms-and-conditions',[ContactusController::class,'term'])->name('term.and.condition');

Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout/contractor', [ContractorLoginController::class, 'logoutContractor'])->name('logout.contractor');

// change password
Route::get('change-password',[ChangePasswordController::class,'index'])->name('front.password.index');
Route::post('front-update-password',[ChangePasswordController::class,'changePassword'])->name('front.password.update');

/*********************************************************/
//   -------------Authentication Google Sign In -----------
/*********************************************************/
Route::get('/login/google', [SocialGoogleController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [SocialGoogleController::class, 'handleGoogleCallback']);

/*********************************************************/
//   -------------Authentication Facebook Sign In -----------
/*********************************************************/
Route::get('/login/facebook', [SocialFacebookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [SocialFacebookController::class, 'handleFacebookCallback']);

/*********************************************************/
//   -------------Authentication customer  Routes ----------------
/*********************************************************/
Route::group(['namespace' => 'Front\Auth','prefix'=>'customer','middleware' => ['auth.redirect']], function () {
// custom authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/email/custom-verify/{id}', [CustomVerificationController::class, 'customVerify'])->name('verification.customVerify')->middleware('signed');
    Route::get('/forgot/password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot.password');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('send.reset.link');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ResetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

/*********************************************************/
//   -------------END Authentication customer  Routes ----------------
/*********************************************************/

/*********************************************************/
//   -------------Authentication contarctor  Routes ----------------
/*********************************************************/
Route::group(['namespace' => 'Front\Auth','prefix'=>'contractor','middleware' => ['auth.redirect']], function () {
    // Add project from controller side 
    Route::post('add/project/contractor',[ProjectController::class,'addProjectContractor'])->name('add.project.contractor'); // add project 
    // end add project from controller
    // custom authentication routes
    Route::get('/login', [ContractorLoginController::class, 'ContractorshowLoginForm'])->name('contractor.login');
    Route::post('/login', [ContractorLoginController::class, 'Contractorlogin']);
   Route::get('/email/custom-verify/{id}', [CustomVerificationController::class, 'customVerify'])->name('verification.customVerify')->middleware('signed');

    Route::post('remove/image',[ProjectController::class,'removeImage'])->name('remove.image');

    Route::get('/forgot/password', [ContractorForgotPasswordController::class, 'contractorforgotPassword'])->name('contractor.forgot.password');
    Route::post('/forgot-password', [ContractorForgotPasswordController::class, 'contractorsendResetLinkEmail'])->name('contractor.send.reset.link');

    Route::get('/reset-password/{token}', [ContractorResetPasswordController::class, 'contractorshowResetPasswordForm'])->name('contractor.reset.password.get');
    Route::post('/reset-password', [ContractorResetPasswordController::class, 'contractorsubmitResetPasswordForm'])->name('contractor.reset.password.post');
    //update profile page customer
    // Route::get('/update/customer/profile',[ProjectController::class,'customerprofileView'])->name('customer.profile');
    // Route::post('/update/customer/profile/post',[ProjectController::class,'customerprofileUpdate'])->name('customer.profile.update');
});

/***********************************************************************************/
//   -------------END Authentication contarctor  Routes ---------------------------
/***********************************************************************************/

/*********************************************************/
//   -------------All Contractor Routes ----------------
/*********************************************************/
Route::group(['middleware' => ['contractor.middleware:contractor'],'namespace' => 'Front\Auth'], function () {


// Add project from controller side 
Route::post('add/project/contractor',[ProjectController::class,'addProjectContractor'])->name('add.project.contractor'); // add project 
Route::post('/project/{id}/update', [ProjectController::class, 'updateProjectInfo'])->name('update.projectinfo');
// end add project from controller

/* start branding */
Route::get('your/branding',[BrandingController::class, 'index'])->name('branding.page');
Route::post('your/addbranding', [BrandingController::class, 'brandingAdd'])->name('contractor.branding.add');

Route::get('your/theme',[BrandingController::class, 'indexTheme'])->name('branding.theme');
Route::post('your/addtheme',[BrandingController::class, 'themeAdd'])->name('branding.theme.add');
Route::post('your/pdfstyle',[BrandingController::class, 'generateStylePdf'])->name('branding.gen.pdf');

// strat report section routes

Route::post('store/report',[ReportController::class,'store'])->name('create-report');
Route::any('edit/report/{id}',[ReportController::class,'view'])->name('report-view');
Route::post('/post/order-change', [ReportController::class, 'changeOrder'])->name('post.order_change'); // update order

// Route::post('/store-inspection-info', [ReportController::class, 'storeInspectionInfo'])->name('storeInspectionInfo');

Route::post('/store-inspection-info', [ReportSectionController::class, 'storeInspectionData'])->name('inspection.store');




Route::post('/report_sections/store', [ReportSectionController::class, 'store'])->name('report_sections.store');

//send Report in email format
Route::post('/send-report', [ReportSectionController::class, 'sendReport'])->name('send.report');


// delete banner image 
Route::post('/delete-banner-image', [ReportSectionController::class, 'deleteBannerImage'])->name('delete.banner.image');
Route::post('/delete-company-logo-image',[ReportSectionController::class, 'deleteCompanyLogoImage'])->name('delete.company.logo.image');

//thaNK YOU PAGE 
Route::post('/thank-you-page/store', [ReportSectionController::class, 'ThankyouSection'])->name('thank-you-page');


Route::post('introduction/store',[ReportSectionController::class, 'storeIntroduction'])->name('reports.introduction');
Route::post('/store/quotationinfo',[ReportSectionController::class, 'storeQuotationInfo'])->name('reports.quotationInfo');


Route::post('/delete-inspection-item', [ReportSectionController::class, 'deleteInspectionItem'])->name('deleteInspectionItem');

Route::post('/upload-inspection-image', [ReportSectionController::class, 'uploadImage'])->name('uploadInspectionImage');


Route::post('/delete-image', [ReportSectionController::class, 'deleteImage'])->name('deleteImage');


// Route::post('view/pdf',[ReportSectionController::class, 'viewPDFData'])->name('view.pdf');
Route::post('/view-pdf', [ReportSectionController::class, 'generatePdf1'])->name('view.pdf');


Route::post('report-pdf', [ReportSectionController::class, 'generatePDFReport'])->name('report-pdf-view');

Route::post('store-warranty-info',[ReportSectionController::class, 'storeWarrantyInformation'])->name('store.warranty');
Route::post('store-termpage/info',[ReportSectionController::class, 'storeTermpageInformation'])->name('term.page.store');

// delete image 
// Route::delete('/report-section/{id}/delete-image', [ReportSectionController::class, 'deleteImage'])->name('report-section.delete-image');
//change the page status
Route::post('changePageStatus',[ReportSectionController::class, 'changePageStatus'])->name('change.page.status');

// end report routes
/* end branding */

Route::get('/hailmaps',[QuotationInformationController::class,'hailMap'])->name('hali.map');
Route::get('contractor/dashboard',[ContractorController::class,'contractorProjectList'])->name('contractor.dashboard'); //contractor dashboard and Filter

//Save notes
Route::post('/save-notes', [ContractorController::class, 'saveNotes'])->name('save.notes');
Route::get('/detail/page',[ContractorController::class,'detailPage'])->name('design.studio.detailspage');



// customer chat board
Route::get('contractor/chat-customer-board/{project_id}/{customer_id}',[ChatController::class,'IndexCustomer'])->name('customer.chat');


Route::get('contractor/project/details/{project_id}',[ContractorController::class,'projectDetailsContractor'])->name('contractor.project.list'); // project details 
Route::post('contractor/documentation/{project_id}',[ContractorController::class,'documentationStore'])->name('contractor.documentation.store'); //step 3
Route::post('contractor/remove/documents',[ContractorController::class,'removeDocuments'])->name('contractor.remove.document'); // remove documents 
Route::get('/{filename}', [ContractorController::class, 'download'])->name('download.file');  //download a file 

//update contractor profile
Route::get('/update/profile',[ContractorController::class,'profileView'])->name('contractor.profile');  //update profile page contractor
Route::post('/update/profile/post',[ContractorController::class,'profileUpdate'])->name('contractor.profile.update'); // update profile page contractor
Route::post('/del/profile/image', [ContractorController::class, 'deleteProfileImage'])->name('contractor.delete.image');

// Route::post('/remove-image', [ContractorController::class, 'remove'])->name('remove.image.contractor.designstudio'); // default link remove image 
Route::post('/remove-image', [ContractorController::class, 'removeImage'])->name('remove.image.contractor');


// Route::post('/remove/image/contractor',[ContractorController::class,'removeImageContractor'])->name('remove.image.contractor'); // remove image 
Route::POST('/delete-image/contractor/{project_id}/{file}',[ContractorController::class,'deleteImagesContractor'])->name('delete.image.designstudio.contractor'); // delete images
Route::post('design/studio/contractor/{project_id}',[ContractorController::class,'designStudioStoreContractor'])->name('design.studio.post.contractor'); // store image and videos
Route::post('design/studio/filterdata/{project_id}',[ContractorController::class,'DesignstuidoContractorFilter'])->name('design.studio.filter.contractor');//Filter design studio contractor 
Route::get('design/studio/filterdata/{project_id}',[ContractorController::class,'getImageData'])->name('get.image.data');
//QUOTATION ROUTES 
Route::get('send/quotation/{quote_id}',[QuotationController::class,'sendQuotation'])->name('send.quotation.view'); // send quotation
Route::post('/quotation/store/{quote_id}', [QuotationController::class, 'store'])->name('quotation.store'); // store quote items 
Route::get('/preview/quotation/{quote_id}',[QuotationController::class,'previewQuote'])->name('preview.quotation'); // preview quote
Route::post('sent/quotation',[QuotationController::class,'sentQuote'])->name('send.quote'); //send quote 
Route::post('/sent/new/quote',[QuotationController::class,'sendnewquote'])->name('send.new.quote'); // after reject send new quote 

//Contrcator Portfolio
Route::get('contractor/portfolio',[ContractorPortfolioController::class, 'portfolio'])->name('contractor.portfolio');
Route::post('contractor/portfolio/post',[ContractorPortfolioController::class,'portfolioStore'])->name('contractor.portfolio.post'); // step 2
Route::post('delete/contractor/portfolio/{file}',[ContractorPortfolioController::class,'portfolioDelete'])->name('delete.image.contractor.portfolio');


//Quotation About us 
Route::get('quotation-information/create', [QuotationInformationController::class, 'create'])->name('quotation_information.create');
Route::post('quotation-information/store', [QuotationInformationController::class, 'store'])->name('quotation_information.store');

/* payment management */
Route::get('your/payments',[PaymentController::class, 'index'])->name('your.payments');
Route::get('your/payments/data', [PaymentController::class, 'getPaymentsData'])->name('payments.data');

}); 
/*********************************************************/
//   -------------End Contractor Routes ----------------
/*********************************************************/

/*********************************************************/
//   -------------All customer Routes ----------------
/*********************************************************/
Route::group(['middleware' => ['customAuth']], function () {
    // Route::get('add/project/{project_id}',[ProjectController::class,'create'])->name('add.project');  // create project
    // Route::post('add/project',[ProjectController::class,'addProject'])->name('add.project'); // add project 
    // Route::get('/project/list',[ProjectController::class,'list'])->name('project.list'); // get project list 
    // /* project create steps route */
    // Route::get('/general/info/{project_id}',[ProjectController::class,'generalInformation'])->name('general.info'); //step 1
    // Route::post('/general/info/{project_id}',[ProjectController::class,'generalInformationPost'])->name('general.info.store'); // step 1
    // Route::get('design/studio/{project_id}',[ProjectController::class,'designStudio'])->name('design.studio'); //step 2
    // Route::post('design/studio/{project_id}',[ProjectController::class,'designStudioStore'])->name('design.studio.post'); // step 2
    // Route::get('/documentation/{project_id}',[ProjectController::class,'documentation'])->name('documentation'); //step 3
    // Route::post('/documentation/{project_id}',[ProjectController::class,'documentationStore'])->name('documentation.store'); //step 3
    // Route::post('remove/documents',[ProjectController::class,'removeDocuments'])->name('remove.document'); // remove documents 
    // Route::any('contractor/list/{project_id}',[ProjectController::class,'index'])->name('contractor.list'); // step 4 display contractor list
    // Route::POST('/delete-image/{project_id}/{file}',[ProjectController::class,'deleteImages'])->name('delete.image.designstudio'); // design studio delete image
    // //update profile page customer
    // Route::get('/update/customer/profile',[ProjectController::class,'customerprofileView'])->name('customer.profile');
    // Route::post('/update/customer/profile/post',[ProjectController::class,'customerprofileUpdate'])->name('customer.profile.update');
  

     // contractor chat board
    Route::get('contractor/chat-board/{project_id}/{contractor_id}',[ChatController::class,'IndexContractor'])->name('contractor.chat');
    Route::controller(ProjectController::class)->group(function(){
        Route::get('add/project/{project_id}','create')->name('add.project');  // create project
        Route::post('add/project','addProject')->name('add.project'); // add project 
        Route::get('/project/list','list')->name('project.list'); // get project list 
        /* project create steps route */
        Route::get('/general/info/{project_id}','generalInformation')->name('general.info'); //step 1
        Route::post('/general/info/{project_id}','generalInformationPost')->name('general.info.store'); // step 1
        Route::get('design/studio/{project_id}','designStudio')->name('design.studio'); //step 2
        Route::post('design/studio/{project_id}','designStudioStore')->name('design.studio.post'); // step 2
        Route::get('/documentation/{project_id}','documentation')->name('documentation'); //step 3
        Route::post('/documentation/{project_id}','documentationStore')->name('documentation.store'); //step 3
        Route::post('remove/documents','removeDocuments')->name('remove.document'); // remove documents 
        Route::any('contractor/list/{project_id}','index')->name('contractor.list'); // step 4 display contractor list
        Route::POST('/delete-image/{project_id}/{file}','deleteImages')->name('delete.image.designstudio'); // design studio delete image
        //update profile page customer
        Route::get('/update/customer/profile','customerprofileView')->name('customer.profile');
        Route::post('/update/customer/profile/post','customerprofileUpdate')->name('customer.profile.update');
        Route::post('delete/profile/image','deleteProfileImage')->name('delete.image');
    });


    //QUOTATION ROUTES 

    Route::controller(QuotationController::class)->group(function(){
        Route::post('send/quote/request','sendRequestContractor')->name('send.quote.contractor');
        Route::get('view/quote/{quote_id}','viewQuotation')->name('view.quote');
        Route::post('customer/quotation/status','customerQuotationStatus')->name('customer.quotation.status');
        
        Route::get('customer/quotation/{quote_id}/make-payment','customerQuotationPaynow')->name('customer.quotation.paynow');
    });
    Route::controller(StripeController::class)->group(function(){
        Route::post('customer/quotation/stripe-pay','stripequotePost')->name('customer.stripe.status');
    });
    // Route::post('send/quote/request',[QuotationController::class,'sendRequestContractor'])->name('send.quote.contractor');
    // Route::get('view/quote/{quote_id}',[QuotationController::class,'viewQuotation'])->name('view.quote');
    // Route::post('customer/quotation/status',[QuotationController::class,'customerQuotationStatus'])->name('customer.quotation.status');
    
});

}); // PREVENT BACK HISTORY MIDDLEWARE
/*********************************************************/
//   ------------- END customer Routes ----------------
/*********************************************************/

Route::controller(ChatController::class)->group(function(){
    Route::post('/message-sent','addMessage');
    Route::post('/customer-load-more-messages','customerloadMoreMessages')->name('customer.load.more.conversations');   
    Route::post('/contractor-load-more-messages','contractorloadMoreMessages')->name('contractor.load.more.conversations');   
    
    Route::post('/user-status-update','updateStatus');
    Route::post('/get-message-count','getMessageCount');
    Route::post('update-message-count','updateMessageCount');
    
    //customer side get message count
    Route::post('get-message-count-customer','getCustomerMessageCount');
    Route::post('update-message-count','updateCustomerMessageCount');
});

/* pdf viewer */
Route::get('your/viewer',[BrandingController::class, 'viewer'])->name('branding.viewer');

// Route::post('/message-sent',[ChatController::class,'addMessage']);
// Route::post('/customer-load-more-messages',[ChatController::class,'customerloadMoreMessages'])->name('customer.load.more.conversations');   
// Route::post('/contractor-load-more-messages',[ChatController::class,'contractorloadMoreMessages'])->name('contractor.load.more.conversations');   

// Route::post('/user-status-update', [ChatController::class, 'updateStatus']);
// Route::post('/get-message-count', [ChatController::class, 'getMessageCount']);
// Route::post('update-message-count',[ChatController::class, 'updateMessageCount']);

// //customer side get message count
// Route::post('get-message-count-customer',[ChatController::class, 'getCustomerMessageCount']);
// Route::post('update-message-count',[ChatController::class, 'updateCustomerMessageCount']);

/* START STRIPE PAYMENT PUBLIC */
Route::get('/quote-pay/review/{quote_id}/{project_id}/{customer_id}', [QuotationController::class, 'reviewAndSignQuote'])->name('review.sign.quote'); // Ensure the link is signed and expires
Route::controller(StripeController::class)->group(function(){
    Route::post('/quote/stripe-pay','publicstripePay')->name('quote.stripe.pay');
});
Route::get('/quote-pay/expired', function () {
    return view('layouts.front.quotes.expired');
})->name('quote.expired');
/* END STRIPE PAYMENT PUBLIC */


