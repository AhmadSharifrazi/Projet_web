CREATE TABLE events 
( event_no              integer          PRIMARY KEY,
  title                 varchar(20)      NOT NULL,
  starting_date         date             ,
  ending_date           date             ,
  place                 varchar(20)      ,
  URL                   varchar(30)      ,
  approximative_cost    decimal			 ,
  registered_number     integer          ,
  interested_number     integer
  description			text(100)		 
  )
  
  
CREATE TABLE members
 ( email                 varchar(30)    PRIMARY KEY,  
   last_name             varchar(20)    NOT NULL,
   first_name            varchar(20)    NOT NULL, 
   phone_number          varchar(20)    ,
   adress                varchar(50)    ,
   account_number        varchar(30)    ,
   profil_picture        varchar(30)    ,
   validated             boolean        ,
   training_no           integer(5)     NOT NULL REFERENCES FOLLOWS (email)
   responsability_level  varchar(20)    NOT NULL 
  )
  
CREATE TABLE registered_people
( email         varchar(30)              NOT NULL,
  event_no      integer                  NOT NULL,        
  has_payed     boolean                  ,
  PRIMARY KEY (email,event_no)
  FOREIGN KEY (email,event_no)      
  REFERENCES members, events
  
CREATE TABLE interested_poeple
( email         varchar(30)              NOT NULL,
  event_no      integer                  NOT NULL,
  PRIMARY KEY (email, event_no)
  FOREIGN KEY (email, event_no)
  REFERENCES members, events
  )
  
 CREATE TABLE payements
 (email 	    varchar(30)				NOT NULL,
 year			integer                 NOT NULL,
 amount_payed	decimal	
 PRIMARY KEY (email, year)
 FOREIGN KEY (email, year)
 REFERENCES members, subscription
 )
 
 CREATE TABLE suscriptions
 (year			integer					PRIMARY KEY,
 amount			decimal					
 )
 
 CREATE TABLE follows
 (email			varchar(30)				NOT NULL,
 training_no	integer					NOT NULL
 PRIMARY KEY (email, workout_no)
 FOREIGN KEY (email, workout_no)
 REFERENCES members, workout_plan
 )
 
 CREATE TABLE workout_plan
 (workout_no		integer				PRIMARY KEY, 
 workout_name		varchar(20)			NOT NULL,
 starting_date		date				,
 ending_date		date				
 )
 
 CREATE TABLE day_workout
 (day 				date				NOT NULL,
  workout_no		integer				FOREIGN KEY REFERENCES workout_plan
  description		text(100)
  PRIMARY KEY  (day,workout_no)  
  )
 
 
 
 
 