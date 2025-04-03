create TABLE customer(
	customerID int AUTO_INCREMENT,
    f_name varchar(50),
    l_name varchar(50),
    dob date,
    phone varchar(15),
    email  varchar(50),
    address varchar(100),
    nationality varchar(20),
    pp_no varchar(15),
    user_name varchar(15),
    pass varchar(20),
    CONSTRAINT PRIMARY KEY (customerID)
);
