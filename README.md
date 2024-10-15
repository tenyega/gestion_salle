CREATING NEW WEB PROJECT SYMFONY 
    symfony new gestion_salle --webapp

    
INSTALLING TAILWIND
	composer require symfonycasts/tailwind-bundle
	php bin/console tailwind:init
	php bin/console tailwind:build --watch











FIXTURES 
	composer require orm-fixtures --dev
	composer require fakerphp/faker



CREATION BDD
	create.env.local and change the necessary BDD
	symfony console d:d:c
	symfony console make:migration
	symfony console d:m:m  


LOADED THE FIXTURES 
	symfony console d:f:l


CREATING SECURITY CONTROLLER AND REGISTRATION FORM
	symfony console make:security:form-login 
		SecurityController with /logout and no phpUnit test
	symfony console make:registration-form
		 composer require symfonycasts/verify-email-bundle 

	 symfony console make:entity User
		added is_verified

INSTALLED UX ICON FROM SYMFONY 
	composer require symfony/ux-twig-component
	composer require symfony/ux-icon


