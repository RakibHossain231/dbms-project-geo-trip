--first creating the tables and avoiding the foreign keys
create table if not EXISTS cancellations(
	id int PRIMARY key AUTO_INCREMENT,
    cancelled_on int,
    refund_amount float,
    reason varchar(255),
    booking_id int
);
create table if not exists coupons(
	id int PRIMARY KEY AUTO_INCREMENT,
    coupon_code varchar(20),
    percentage float,
    expire_date DATE
);
create table if not exists payments(
	id int PRIMARY KEY AUTO_INCREMENT,
    amount float,
    paid_on DATE,
    transaction_id varchar(50),
    coupon_id int
);
create table if not exists admin(
	id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(50),
    email varchar(100),
    admin_pass varchar(30),
	join_date  DATE
);
create table if not exists visa_application(
	id int PRIMARY KEY AUTO_INCREMENT,
    submission_date DATE DEFAULT CURRENT_DATE,   --  submission date should be manually updated by the admin based on embassy submission date--
    visa_status varchar(20),
    admin_comment varchar(255),
    payment_id int,
    admin_id int,
    customer_id int
);
create table if not exists package(
	id int PRIMARY KEY AUTO_INCREMENT,
    price float,
    duration int,
    descriptions TEXT,
    availability int,
    commission_rate float,
    image_url varchar(255),
    location_id int,
    booking_id int
);
create table if not exists package_hotel(
	package_id int,
    hotel_id int,
    check_in DATE,
    check_out DATE,
    CONSTRAINT pk1 PRIMARY KEY (package_id, hotel_id)
); -- hotel_id and package_id will be foreign key--

create table if not exists package_location(
	location_id int AUTO_INCREMENT,
    package_id int,
    CONSTRAINT pk2 PRIMARY KEY (location_id,package_id)
);

create table if not exists locations(
	location_id int PRIMARY KEY AUTO_INCREMENT,
    country varchar(50),
    city varchar(50),
    hotel_id int
);

create table if not exists hotels(
	id int PRIMARY key AUTO_INCREMENT,
    name varchar(100),
    address varchar(100),
    stars int,
    availability int
    
);

create table if not exists affiliate(
	id int primary key AUTO_INCREMENT,
    name varchar(50),
	contact_name varchar(59),
    phone varchar(20),
    email varchar(50),
    address varchar(255),
    discount_rate float,
    speciality varchar(50),
    affiliate_status int,
    aggreement_duration int,
    expiry_date DATE,
    hotel_id int 
);
-- adding the foreign keys after we have all the tables in place
ALTER TABLE visa_application
ADD CONSTRAINT payment_fk FOREIGN KEY (payment_id) REFERENCES payments(id);

ALTER TABLE visa_application
ADD CONSTRAINT admin_fk FOREIGN KEY (admin_id) REFERENCES admin(id);

ALTER TABLE visa_application
ADD CONSTRAINT customer_fk FOREIGN KEY (customer_id) REFERENCES customer(customerID);

ALTER TABLE bookings
ADD CONSTRAINT cancel_fk FOREIGN KEY (cancellation_id) REFERENCES cancellations(id);
ALTER TABLE bookings
ADD CONSTRAINT booking_payment_fk FOREIGN KEY (payment_id) REFERENCES payments(id);
ALTER TABLE bookings
ADD CONSTRAINT booking_admin_fk FOREIGN KEY (admin_id) REFERENCES admin(id);
alter TABLE cancellations
add CONSTRAINT cancel_boooking_fk FOREIGN KEY (booking_id) REFERENCES bookings(id);


ALTER TABLE payments
add CONSTRAINT payment_coupon FOREIGN KEY (coupon_id) REFERENCES coupons(id)

ALTER TABLE hotels
add CONSTRAINT hotel_affiliate FOREIGN KEY (affiliate_id) REFERENCES affiliate(id);


ALTER TABLE hotels 
add COLUMN location_id int;

ALTER TABLE hotels
add CONSTRAINT hotel_location FOREIGN KEY (location_id) REFERENCES locations(location_id);

alter TABLE package_location
add CONSTRAINT location_in_package FOREIGN KEY (location_id) REFERENCES locations(location_id);

alter TABLE package_location
add CONSTRAINT package_for_location FOREIGN KEY (package_id) REFERENCES package(id);
ALTER TABLE package_hotel
ADD CONSTRAINT fk_package_hotel
FOREIGN KEY (package_id) REFERENCES package(id),
ADD CONSTRAINT fk_hotel_package
FOREIGN KEY (hotel_id) REFERENCES hotels(id);
alter TABLE package
add CONSTRAINT package_location_fk FOREIGN KEY (location_id) REFERENCES locations(location_id);
ALTER TABLE package
add CONSTRAINT package_booking FOREIGN KEY (booking_id) REFERENCES bookings(id);


--Dummy Data---
--affiliate table 
INSERT INTO affiliate (name, contact_name, phone, email, address, discount_rate, speciality, affiliate_status, aggreement_duration, expiry_date) 
VALUES 
('Affiliate 1', 'John Smith', '+8801712345678', 'affiliate1@example.com', 'Paris, France', 0.12, 'Luxury', 1, 2, '2028-06-15'),
('Affiliate 2', 'Jane Johnson', '+8801712345123', 'affiliate2@example.com', 'London, UK', 0.15, 'Budget', 1, 3, '2029-04-21'),
('Affiliate 3', 'Alice Brown', '+8801712345345', 'affiliate3@example.com', 'Berlin, Germany', 0.08, 'Adventure', 0, 1, '2027-11-12'),
('Affiliate 4', 'Bob Davis', '+8801712345567', 'affiliate4@example.com', 'Tokyo, Japan', 0.20, 'Luxury', 1, 4, '2030-02-28'),
('Affiliate 5', 'Carol Wilson', '+8801712345789', 'affiliate5@example.com', 'New York, USA', 0.10, 'Budget', 0, 2, '2027-08-19'),
('Affiliate 6', 'David Taylor', '+8801712345901', 'affiliate6@example.com', 'Paris, France', 0.18, 'Adventure', 1, 5, '2030-12-05'),
('Affiliate 7', 'Eva Miller', '+8801712345012', 'affiliate7@example.com', 'London, UK', 0.13, 'Luxury', 1, 3, '2028-05-09'),
('Affiliate 8', 'Frank Williams', '+8801712345234', 'affiliate8@example.com', 'Berlin, Germany', 0.09, 'Budget', 0, 2, '2029-07-23'),
('Affiliate 9', 'Grace Davis', '+8801712345456', 'affiliate9@example.com', 'Tokyo, Japan', 0.11, 'Adventure', 1, 4, '2028-10-02'),
('Affiliate 10', 'Henry Brown', '+8801712345670', 'affiliate10@example.com', 'New York, USA', 0.16, 'Luxury', 0, 5, '2030-01-15');
--admin table--
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('Frank Doe', 'admin1@example.com', '$2b$12$7zPUJoW4nuw35Ml27HGj1eX3vO6QeFqRVbnrpYxpc/KVEOODI3LA.', '2019-05-16');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('David Smith', 'admin2@example.com', '$2b$12$LXMTWQKrvma0EXnjEZPytOeRaETZhDlQDSyG80gKkMSvxmvSHLLRK', '2020-12-09');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('Grace Taylor', 'admin3@example.com', '$2b$12$b8kr.DUIk0/FwVOkbDXn/eMDIgouCHJO9mubu5zuDOpYZt8oym53a', '2023-03-07');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('Eva Williams', 'admin4@example.com', '$2b$12$x26NnfQq2mizNC6AQOwTWOIopxwdyf1x9KvzjHlS6XNJMiZW/VAGu', '2022-09-07');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('Henry Johnson', 'admin5@example.com', '$2b$12$LZ1fXWOEjd2YRQAcJVt.U.ObEbiIJH/bQZEJUJzfa9TIzZ/lVKvpS', '2025-04-02');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('Bob Brown', 'admin6@example.com', '$2b$12$tPlCtmxKG1IlNoR2OAHNjehgXY7TckRqsAWqY6lb5kOTXh0leeEfG', '2021-08-25');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('Grace Wilson', 'admin7@example.com', '$2b$12$r8NtWgTBTkP9DVlJCj7C3enVCYMgnzXWXrr5HJYkB1Mh9BY.GWZH.', '2025-12-25');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('Jane Miller', 'admin8@example.com', '$2b$12$XYvDD9fQ3s/EFDP7V8KCiuLq7H4Lc9tRH/7O7lWAyeKvmASVJvT9C', '2020-04-18');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('Henry Wilson', 'admin9@example.com', '$2b$12$3OMIqXzanHMZN8pPFrej5.worw94B8wwT/0XZuIZo1jKH5/Emh4Gm', '2023-07-12');
INSERT INTO admin (name, email, admin_pass, join_date) VALUES ('John Williams', 'admin10@example.com', '$2b$12$S.BpM3K940s/pleeLZXCTucdrFzEauuzBiWGnOH/w3uOtdblcyzzS', '2019-04-14');
--coupon table--
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE1', 5, '2025-11-20');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE2', 15, '2026-03-19');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE3', 15, '2026-05-08');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE4', 25, '2025-10-14');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE5', 10, '2026-10-18');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE6', 25, '2026-12-14');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE7', 10, '2025-11-26');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE8', 5, '2025-01-05');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE9', 15, '2025-02-22');
INSERT INTO coupons (coupon_code, percentage, expire_date) VALUES ('CODE10', 20, '2026-11-01');
--hotel table --
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 1', 'Berlin, France', 1, 0);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 2', 'London, France', 4, 0);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 3', 'Tokyo, France', 2, 0);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 4', 'Berlin, France', 5, 1);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 5', 'Tokyo, USA', 3, 1);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 6', 'New York, UK', 2, 0);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 7', 'Berlin, Japan', 1, 1);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 8', 'London, UK', 3, 1);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 9', 'Paris, Germany', 3, 0);
INSERT INTO hotels (name, address, stars, availability) VALUES ('Hotel 10', 'Tokyo, Japan', 2, 1);
--locations table --
INSERT INTO locations (country, city, hotel_id) VALUES ('Japan', 'Tokyo', 9);
INSERT INTO locations (country, city, hotel_id) VALUES ('Germany', 'Berlin', 9);
INSERT INTO locations (country, city, hotel_id) VALUES ('France', 'Berlin', 4);
INSERT INTO locations (country, city, hotel_id) VALUES ('Japan', 'New York', 5);
INSERT INTO locations (country, city, hotel_id) VALUES ('Germany', 'London', 8);
INSERT INTO locations (country, city, hotel_id) VALUES ('Germany', 'Tokyo', 8);
INSERT INTO locations (country, city, hotel_id) VALUES ('Germany', 'London', 10);
INSERT INTO locations (country, city, hotel_id) VALUES ('USA', 'Berlin', 2);
INSERT INTO locations (country, city, hotel_id) VALUES ('UK', 'Tokyo', 6);
INSERT INTO locations (country, city, hotel_id) VALUES ('France', 'Berlin', 4);
