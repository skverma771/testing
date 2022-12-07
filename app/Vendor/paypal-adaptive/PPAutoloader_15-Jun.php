<?php
	 /**
      * Basic class-map auto loader generated by install.php.
	  * Do not modify.
	  */
	//define('PAYPAL_REDIRECT_URL', 'https://www.sandbox.paypal.com/webscr&cmd=');
	define('DEVELOPER_PORTAL', 'https://developer.paypal.com');
	 require_once 'Configuration.php';
	 class PPAutoloader {
	 	private static $map = array (
		  'accountidentifier' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'adaptivepaymentsservice' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePaymentsService.php',
		  'address' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'addresslist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'attributecomplexxmltestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'attributecontainertestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPMessageTest.php',
		  'attributecontainerxmltestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'attributetestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPMessageTest.php',
		  'attributexmltestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'authsignature' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'baseaddress' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'cancelpreapprovalrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'cancelpreapprovalresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'clientdetailstype' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'configuration' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/samples/Configuration.php',
		  'confirmpreapprovalrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'confirmpreapprovalresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'containermodeltestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPModelTest.php',
		  'conversionrate' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'convertcurrencyrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'convertcurrencyresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'currencycodelist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'currencyconversion' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'currencyconversionlist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'currencyconversiontable' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'currencylist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'currencytype' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'displayoptions' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'errordata' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'errorlist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'errorparameter' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'executepaymentrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'executepaymentresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'faultdetailstype' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'faultmessage' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'feedisclosure' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'formatterfactory' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/formatters/FormatterFactory.php',
		  'formatterfactorytest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/formatters/FormatterFactoryTest.php',
		  'fundingconstraint' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'fundingplan' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'fundingplancharge' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'fundingsource' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'fundingtypeinfo' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'fundingtypelist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getallowedfundingsourcesrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getallowedfundingsourcesresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getavailableshippingaddressesrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getavailableshippingaddressesresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getfundingplansrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getfundingplansresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getpaymentoptionsrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getpaymentoptionsresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getprepaymentdisclosurerequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getprepaymentdisclosureresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getshippingaddressesrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getshippingaddressesresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getuserlimitsrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'getuserlimitsresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'initiatingentity' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'institutioncustomer' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'invoicedata' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'invoiceitem' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'ippcredential' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/IPPCredential.php',
		  'ippformatter' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/formatters/IPPFormatter.php',
		  'ipphandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/handlers/IPPHandler.php',
		  'ippthirdpartyauthorization' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/IPPThirdPartyAuthorization.php',
		  'listmodeltestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPModelTest.php',
		  'mockhandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPAPIServiceTest.php',
		  'mocknvpclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPAPIServiceTest.php',
		  'mocknvpobject' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/formatters/PPNVPFormatterTest.php',
		  'mockoauthdatastore' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/AuthUtil.php',
		  'mockreflectiontesttype' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPUtilsTest.php',
		  'mocksoapobject' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/formatters/PPSOAPFormatterTest.php',
		  'oauthconsumer' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthdatastore' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthexception' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthrequest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthserver' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthsignaturemethod' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthsignaturemethod_hmac_sha1' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthsignaturemethod_plaintext' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthsignaturemethod_rsa_sha1' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthtoken' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'oauthutil' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPAuth.php',
		  'payerror' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'payerrorlist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'paymentdetailsrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'paymentdetailsresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'paymentinfo' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'paymentinfolist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'payrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'payresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'phonenumber' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'phonenumbertype' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'postpaymentdisclosure' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'postpaymentdisclosurelist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'ppapicontext' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/common/PPApiContext.php',
		  'ppapiservice' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPAPIService.php',
		  'ppapiservicetest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPAPIServiceTest.php',
		  'pparrayutil' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/common/PPArrayUtil.php',
		  'ppauthenticationhandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/handlers/PPAuthenticationHandler.php',
		  'ppauthenticationhandlertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/handlers/PPAuthenticationHandlerTest.php',
		  'ppbaseservice' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPBaseService.php',
		  'ppbaseservicetest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPBaseServiceTest.php',
		  'ppcertificateauthhandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/handlers/PPCertificateAuthHandler.php',
		  'ppcertificateauthhandlertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/handlers/PPCertificateAuthHandlerTest.php',
		  'ppcertificatecredential' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPCertificateCredential.php',
		  'ppcertificatecredentialtest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPCertificateCredentialTest.php',
		  'ppconfigmanager' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPConfigManager.php',
		  'ppconfigmanagertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPConfigManagerTest.php',
		  'ppconfigurationexception' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/exceptions/PPConfigurationException.php',
		  'ppconfigurationexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/exception/PPConfigurationExceptionTest.php',
		  'ppconnectionexception' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/exceptions/PPConnectionException.php',
		  'ppconnectionexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/exception/PPConnectionExceptionTest.php',
		  'ppconnectionmanager' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPConnectionManager.php',
		  'ppconnectionmanagertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPConnectionManagerTest.php',
		  'ppconstants' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPConstants.php',
		  'ppcredentialmanager' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPCredentialManager.php',
		  'ppcredentialmanagertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPCredentialManagerTest.php',
		  'ppgenericservicehandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/handlers/PPGenericServiceHandler.php',
		  'ppgenericservicehandlertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/handlers/PPGenericServiceHandlerTest.php',
		  'pphttpconfig' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPHttpConfig.php',
		  'pphttpconfigtest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPHttpConfigTest.php',
		  'pphttpconnection' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPHttpConnection.php',
		  'ppinvalidcredentialexception' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/exceptions/PPInvalidCredentialException.php',
		  'ppinvalidcredentialexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/exception/PPInvalidCredentialExceptionTest.php',
		  'ppipnmessage' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/ipn/PPIPNMessage.php',
		  'ppipnmessagetest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPIPNMessageTest.php',
		  'pplogginglevel' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPLoggingLevel.php',
		  'pploggingmanager' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPLoggingManager.php',
		  'pploggingmanagertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPLoggingManagerTest.php',
		  'ppmerchantservicehandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/handlers/PPMerchantServiceHandler.php',
		  'ppmerchantservicehandlertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/handlers/PPMerchantServiceHandlerTest.php',
		  'ppmessage' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPMessage.php',
		  'ppmessagetest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPMessageTest.php',
		  'ppmissingcredentialexception' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/exceptions/PPMissingCredentialException.php',
		  'ppmissingcredentialexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/exception/PPMissingCredentialExceptionTest.php',
		  'ppmodel' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/common/PPModel.php',
		  'ppmodeltest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPModelTest.php',
		  'ppnvpformatter' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/formatters/PPNVPFormatter.php',
		  'ppnvpformattertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/formatters/PPNVPFormatterTest.php',
		  'ppopenidaddress' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/openid/PPOpenIdAddress.php',
		  'ppopenidaddresstest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/openid/PPOpenIdAddressTest.php',
		  'ppopeniderror' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/openid/PPOpenIdError.php',
		  'ppopeniderrortest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/openid/PPOpenIdErrorTest.php',
		  'ppopenidhandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/handlers/PPOpenIdHandler.php',
		  'ppopenidhandlertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/handlers/PPOpenIdHandlerTest.php',
		  'ppopenidsession' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/openid/PPOpenIdSession.php',
		  'ppopenidsessiontest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/openid/PPOpenIdSessionTest.php',
		  'ppopenidtokeninfo' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/openid/PPOpenIdTokeninfo.php',
		  'ppopenidtokeninfotest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/openid/PPOpenIdTokeninfoTest.php',
		  'ppopeniduserinfo' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/openid/PPOpenIdUserinfo.php',
		  'ppopeniduserinfotest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/openid/PPOpenIdUserinfoTest.php',
		  'ppplatformservicehandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/handlers/PPPlatformServiceHandler.php',
		  'ppplatformservicehandlertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/handlers/PPPlatformServiceHandlerTest.php',
		  'ppreflectionutil' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/common/PPReflectionUtil.php',
		  'pprequest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPRequest.php',
		  'pprestcall' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/transport/PPRestCall.php',
		  'ppsignatureauthhandler' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/handlers/PPSignatureAuthHandler.php',
		  'ppsignatureauthhandlertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/handlers/PPSignatureAuthHandlerTest.php',
		  'ppsignaturecredential' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPSignatureCredential.php',
		  'ppsignaturecredentialtest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPSignatureCredentialTest.php',
		  'ppsoapformatter' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/formatters/PPSOAPFormatter.php',
		  'ppsoapformattertest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/formatters/PPSOAPFormatterTest.php',
		  'ppsubjectauthorization' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPSubjectAuthorization.php',
		  'pptokenauthorization' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/auth/PPTokenAuthorization.php',
		  'pptransformerexception' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/exceptions/PPTransformerException.php',
		  'pptransformerexceptiontest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/exception/PPTransformerExceptionTest.php',
		  'ppuseragent' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/common/PPUserAgent.php',
		  'pputils' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPUtils.php',
		  'pputilstest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPUtilsTest.php',
		  'ppxmlfaultmessage' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPXmlFaultMessage.php',
		  'ppxmlmessage' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/lib/PPXmlMessage.php',
		  'ppxmlmessagetest' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'preapprovaldetailsrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'preapprovaldetailsresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'preapprovalrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'preapprovalresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'receiver' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'receiverdisclosure' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'receiverdisclosurelist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'receiveridentifier' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'receiverinfo' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'receiverinfolist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'receiverlist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'receiveroptions' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'refundinfo' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'refundinfolist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'refundrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'refundresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'requestenvelope' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'responseenvelope' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'senderdisclosure' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'senderidentifier' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'senderoptions' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'setpaymentoptionsrequest' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'setpaymentoptionsresponse' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'shippingaddressinfo' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'simplecontainertestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPMessageTest.php',
		  'simplecontainerxmltestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'simplemodeltestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPModelTest.php',
		  'simpletestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPMessageTest.php',
		  'simplexmltestclass' => 'vendor/paypal/paypal-sdk-core-php-016a8e4/tests/PPXMLMessageTest.php',
		  'stateregulatoryagencyinfo' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'taxiddetails' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'userlimit' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'warningdata' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		  'warningdatalist' => 'vendor/paypal/paypal-adaptivepayments-sdk-php-c3059a7/lib/services/AdaptivePayments/AdaptivePayments.php',
		);

		public static function loadClass($class) {
	        $class = strtolower(trim($class, '\\'));

    	    if (isset(self::$map[$class])) {
            	require dirname(__FILE__) . '/' . self::$map[$class];
        	}
    	}
		public static function register($mode) {				
			if($mode == 1){
				define('PAYPAL_REDIRECT_URL', 'https://www.sandbox.paypal.com/webscr&cmd=');
			}else{
				define('PAYPAL_REDIRECT_URL', 'https://www.paypal.com/webscr&cmd=');				
			}
	        spl_autoload_register(array(__CLASS__, 'loadClass'), true);
    	}
}