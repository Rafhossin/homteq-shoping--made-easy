


DROP TABLE IF EXISTS Order_Line;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Signup;



-- Create the product table
CREATE TABLE Product
(
	prodid 	          INTEGER      AUTO_INCREMENT,
	prodName	          VARCHAR(200) unique not null,
	prodPicNameSmall	VARCHAR(200) not null,
	prodPicNameLarge	VARCHAR(200) not null,
	prodDescripShort	VARCHAR(1000) ,
	prodDescripLong	VARCHAR(3000) ,
          prodPrice           DECIMAL(8,2)  not null default "0.00",
          prodQuantity        INTEGER       not null default "100" ,
	constraint 	p_prodid_pk PRIMARY KEY (prodid)
);

-- SQL INSERT INTO statement
INSERT INTO Product(prodName,prodPicNameSmall,prodPicNameLarge,
prodDescripShort,prodDescripLong,prodPrice, prodQuantity )

VALUES 
('Tapo C310 Smart Camera','wifiSmartCameraSmall.webp','wifiSmartCameraLarge.webp','TP-Link Tapo C310 Outdoor Wi-Fi Smart Security Camera','Tapo Indoor/Outdoor Camera Tapo C310 is a full-featured weatherproof security camera that you can access from anywhere. With 3MP high resolution',35.99,10),
('Amazon Echo Show 8','amazonEchoShowSmall.webp','amazonEchoShowLarge.jpg','2nd generation (2021 release), HD smart display with Alexa and 13 MP camera | Charcoal','Alexa can show you even more: 8" HD touchscreen, adaptive colour and stereo speakers bring entertainment to life. Make video calls with a 13 MP camera that uses auto-framing to keep you centred.',119.99,12),
('Echo Dot(5th Gen)','echoDotSmall.webp','echoDotLarge.jpg','All-new Echo Dot (5th generation, 2022 release) smart speaker with Alexa | Charcoal','Our best-sounding Echo Dot yet: enjoy an improved audio experience compared to any previous Echo Dot with Alexa for clearer vocals, deeper bass and vibrant sound in any room.',54.99,12),
('Qiumi Smart Heating Thermostat','QiumiSmartSmall.jpg','QiumiSmartLarge.jpg','Qiumi Smart WiFi Boiler Heating Thermostat Programmable Temperature Touch Controller Thermoregulator 5A 95-240V, Interated with Amazon Echo, Google Home.','A mini temperature controller with touch button and large ultra thin LCD screen, simple to operate and easy to read even in the dark. 65.9*48.6 mm display area helps to protect your eyes.86mm hidden box and european 60mm round box is suitable',39.69,13),
('Smart Smoke Alarm','SmokeAlarmSmall.webp','SmokeAlarmLarge.jpg','Smoke Alarm with 10 Year Lithium Battery Smart WiFi Fire Detector with Mute Function by App, EN 14604 Test Fire Alarm for Fire Warning 1Pack (White)','Remote Monitor Fire Anytime Anywhere: The smoke detector can be connected with ＇Tuya＇ and ＇SmartLife ＇App. Once the alarm is triggered, you can receive the message on your phone and take action to deal with it in a timely manner.',40.00,10);



-- Create the SignupSignup table
CREATE TABLE Signup (
   signupId        int(11)      NOT NULL AUTO_INCREMENT,
   userType        VARCHAR(50)  NOT NULL DEFAULT 'Customer';
   fName           varchar(50)  NOT NULL,
   lName           varchar(50)  NOT NULL,
   userAddress     varchar(100) NOT NULL,
   postCode        varchar(10)  NOT NULL,
   telNo           varchar(15)  NOT NULL,
   email           varchar(50)  UNIQUE NOT NULL,
   userPassword    varchar(200) NOT NULL,
   

   constraint 	s_signupid_pk PRIMARY KEY (signupId)
 
) 

   ALTER TABLE users MODIFY COLUMN userType VARCHAR(50) NOT NULL DEFAULT 'customer';


   -- Create Orders table
   CREATE TABLE Orders
   (
      orderNo          INT            AUTO_INCREMENT,
      signupId         INT            NOT NULL,
      orderDateTime    DATETIME       NOT NULL,
      orderTotal       DECIMAL(8,2)   NOT NULL DEFAULT '0.00',
      orderStatus      VARCHAR(50)    NOT NULL,
      shippingDate     DATETIME       NOT NULL,
      CONSTRAINT  o_ono_pk            PRIMARY KEY(orderNo),
      CONSTRAINT  o_suid_fk           FOREIGN KEY(signupId)
      REFERENCES  Signup(signupId)    ON DELETE CASCADE

   );
   -- ON DELETE CASCADE: If we want to remove parent table, we also need to remove child table

   -- Create Order_Line (line of every single order) table
   CREATE TABLE Order_Line
   (
      orderLineId          INT           AUTO_INCREMENT,
      orderNo              INT           NOT NULL,
      prodid               INT           NOT NULL,
      quantityOrdered      INT           NOT NULL,
      subTotal             DECIMAL(8,2)  NOT NULL DEFAULT '0.00',
      CONSTRAINT  ol_olid_pk             PRIMARY KEY(orderLineId),
      CONSTRAINT  ol_ono_fk              FOREIGN KEY(orderNo)
      REFERENCES  Orders(orderNo)        ON DELETE CASCADE,
      CONSTRAINT  ol_pid_fk              FOREIGN KEY(prodid)
      REFERENCES  Product(prodid )       ON DELETE CASCADE

   );