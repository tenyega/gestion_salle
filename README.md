CREATING NEW WEB PROJECT SYMFONY 
    symfony new gestion_salle --webapp

    
INSTALLING TAILWIND
	composer require symfonycasts/tailwind-bundle
	php bin/console tailwind:init
	php bin/console tailwind:build --watch


ENTITIES
	
	EVENTTYPE
		symfony console make:entity EventType
		name varchar 255 not null
		description varchar 255 nullable 

	ADDRESS
		symfony console make:entity Address
		number int not null
		street varchar 255 not null
		country varchar120 not null
		city varchar120 not null
		codePostal varchar120 not null 
		
	ERGONOMY 
		symfony console make:entity Ergonomy
		name varchar180 not null
		description varchar255  nullable

	EQUIPMENT
		symfony console make:entity Equipment
		name varchar180 not null
		description varchar255  nullable
		type varchar180 not null

	USER 
		symfony console make:user

	NOTIFICATION
		symfony console make:entity Notification
		message varchar255 not null
		createdAt datetime_immutable not null
		isRead boolean not null
		userId M21 with User (Notification.userId allowed nullable?: No, OrphanRemoval?: no)


	HALL
		symfony console make:entity Hall
		name varchar255 not null
		area varchar120 not null
		accessibility varchar255 not null
		capacityMax int not null
		pricePerHour decimal not null (Precision 5, scale 2)
		openingTime Time not null
		closingTime Time not null
	  	eventTypeId 121 with EventType(Hall.eventTypeId nullable?: No)
	  	addresseId 121 with Address(Hall.addressId nullable?: No)
	  	listEquipment M2M with Equipment
	  	listErgonomy M2M with Ergonomy

	RESERVATION
		symfony console make:entity Reservation
		startDate date not null
		endDate date not null
		startTime time not null
		endTime time not null
		isConfirmed boolean not null
		specialRequest varchar 255 nullable 
		userId ManyToOne with User (Reservation.userId nullable?: No, OrphanRemoval? :no)
		hallId ManyToOne with Hall( Reservation.hallId nullable? : No, OrphanRemoval? : no)
		createdAt datetime_immutable  not null
		updatedAt datetime_immutable  not null
		
.env.local
	database name db_hall_management

CREATION BDD
	symfony console d:d:c
	symfony console make:migration
	symfony console d:m:m  

	
FIXTURES 
	composer require orm-fixtures --dev
	composer require fakerphp/faker


	EVENTYPE FIXTURES 
		php bin/console make:fixture EventType
	ADDRESS FIXTURES
		php bin/console make:fixture Address
	ERGONOMY FIXTURES
		php bin/console make:fixture Ergonomy
	EQUIPMENT FIXTURES
		php bin/console make:fixture Equipment
	NOTIFICATION FIXTURES
		php bin/console make:fixture Notification
	HALL FIXTURES
		php bin/console make:fixture Hall
	RESERVATION FIXTURES
		php bin/console make:fixture Reservation
	USER FIXTURES
		php bin/console make:fixture User
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


