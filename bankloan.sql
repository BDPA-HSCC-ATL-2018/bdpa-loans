drop database if exists bankloan;
create database if not exists bankloan;
use bankloan;

drop table if exists customers;
create table if not exists customers (
  customer_id int(11) not null auto_increment,
  email_id varchar(255) not null,
  login_pw varchar(255) not null,
  first_name varchar(255) not null,
  last_name varchar(255) not null,
  address_line_one varchar(255) not null,
  city_name varchar(255) not null,
  state_cd varchar(2) not null,
  postal_cd varchar(64) not null,
  pri_phone varchar(255) not null,
  alt_phone varchar(255) default null,
  employer_name varchar(255) default null,
  annual_income decimal(9,2) not null,
  bad_login_count int(11) not null default 0,
  account_locked_sw int(1) not null default 0,
  lastmod timestamp not null default current_timestamp on update current_timestamp,
  primary key (customer_id),
  unique key (email_id)
) Engine=InnoDB auto_increment=110000 Default Charset=latin1;

drop table if exists customer_references;
create table if not exists customer_references (
  reference_id int(11) not null auto_increment,
  customer_id int(11) not null,
  first_name varchar(255) not null,
  last_name varchar(255) not null,
  pri_phone varchar(255) not null,
  address_line_one varchar(255) not null,
  city_name varchar(255) not null,
  state_cd varchar(2) not null,
  postal_cd varchar(64) not null,
  lastmod timestamp not null default current_timestamp on update current_timestamp,
  primary key (reference_id),
  foreign key (customer_id) references customers(customer_id) on update cascade on delete restrict
) Engine=InnoDB Default Charset=latin1;

drop table if exists loan_types;
create table if not exists loan_types (
  loan_type_cd varchar(1) not null,
  loan_type_cd_desc varchar(255) not null,
  loan_type_image longblob,
  primary key (loan_type_cd)
) Engine=InnoDB Default Charset=latin1;

insert into loan_types (
  loan_type_cd,
  loan_type_cd_desc,
  loan_type_image
) values
('A','Auto Loan',null),
('B','Boat Loan',null),
('M','Motorcycle Loan',null),
('S','Student Loan',null),
('H','Home Loan',null);

drop table if exists loan_interest_terms;
create table if not exists loan_interest_terms (
  loan_type_cd varchar(1) not null,
  loan_term_months int(11) not null,
  interest_rate decimal(9,4) not null,
  active_sw varchar(1) not null default 'Y',
  primary key (loan_type_cd,loan_term_months),
  foreign key (loan_type_cd) references loan_types(loan_type_cd) on update cascade on delete restrict
) Engine=InnoDB Default Charset=latin1;

insert into loan_interest_terms (
  loan_type_cd,
  loan_term_months,
  interest_rate,
  active_sw
) values
('A',24,5.0000,'Y'),
('A',36,4.7500,'Y'),
('A',48,4.0000,'Y'),
('A',60,3.2500,'Y'),
('A',72,2.7500,'Y'),
('B',24,5.0000,'Y'),
('B',36,4.7500,'Y'),
('B',48,4.0000,'Y'),
('B',60,3.2500,'Y'),
('B',72,2.7500,'Y'),
('M',24,6.0000,'Y'),
('M',36,5.7500,'Y'),
('M',48,5.0000,'Y'),
('M',60,4.2500,'Y'),
('M',72,3.7500,'Y'),
('S',120,3.2500,'Y'),
('S',180,2.5000,'Y'),
('H',120,3.7700,'Y'),
('H',180,3.8900,'Y'),
('H',360,4.4500,'Y');

drop table if exists loan_application_status;
create table if not exists loan_application_status (
  loan_application_status_cd varchar(1) not null,
  loan_application_status_cd_desc varchar(255) not null,
  active_sw varchar(1) not null default 'Y',
  primary key (loan_application_status_cd)
) Engine=InnoDB Default Charset=latin1;

insert into loan_application_status (
  loan_application_status_cd,
  loan_application_status_cd_desc,
  active_sw
) values
('P','In Progress','Y'),
('S','Submitted','Y'),
('Y','Approved - Ready to Fund','Y'),
('A','Approved/Funded - Active','Y'),
('R','Rejected - Not Qualified','Y'),
('W','Withdrawn/Cancelled by Customer','Y');

drop table if exists loan_application;
create table if not exists loan_application (
  loan_id int(11) not null auto_increment,
  customer_id int(11) not null,
  loan_type_cd varchar(1) not null,
  loan_amount decimal(19,2) not null,
  monthly_payment decimal(19,2) not null,
  interest_rate decimal(4,4) not null,
  loan_status_date datetime default null,
  loan_acceptance_date datetime default null,
  loan_term_months int(11) not null,
  loan_application_status_cd varchar(1) not null default 'P',
  lastmod timestamp not null default current_timestamp on update current_timestamp,
  primary key (loan_id),
  foreign key (customer_id) references customers(customer_id) on update cascade on delete restrict,
  foreign key (loan_type_cd) references loan_types(loan_type_cd) on update cascade on delete restrict,
  foreign key (loan_application_status_cd) references loan_application_status(loan_application_status_cd) on update cascade on delete restrict
) Engine=InnoDB Default Charset=latin1;

drop table if exists optional_products;
create table if not exists optional_products (
  optional_product_cd varchar(2) not null,
  optional_product_cost decimal(9,2) not null,
  optional_product_desc varchar(30) not null,
  primary key (optional_product_cd)
) Engine=InnoDB Default Charset=latin1;

insert into optional_products (
  optional_product_cd,
  optional_product_cost,
  optional_product_desc
) values
('PI',3.2500,'Payoff Insurance'),
('EW',3.7500,'Extended Warranty'),
('MI',2.7500,'Monthly Payment Insurance');

drop table if exists loan_options_selected;
drop table if exists customer_loan_options;
create table if not exists customer_loan_options (
  loan_id int(11) not null,
  optional_product_cd varchar(2) not null,
  optional_product_cost decimal(9,2) not null,
  primary key (loan_id,optional_product_cd),
  foreign key (loan_id) references loan_application(loan_id) on update cascade on delete restrict,
  foreign key (optional_product_cd) references optional_products(optional_product_cd) on update cascade on delete restrict
) Engine=InnoDB Default Charset=latin1;

drop table if exists appl_states;
create table if not exists appl_states (
  state_cd char(2) not null,
  state_cd_desc varchar(64) not null,
  active_sw varchar(1) not null default 'Y',
  primary key (state_cd)
) Engine=InnoDB Default Charset=latin1 Comment='All States';

-- load reference table: states
insert into appl_states (
  state_cd,
  state_cd_desc,
  active_sw
) values
('AK', 'Alaska', 'Y'),
('AL', 'Alabama', 'Y'),
('AR', 'Arkansas', 'Y'),
('AZ', 'Arizona', 'Y'),
('CA', 'California', 'Y'),
('CO', 'Colorado', 'Y'),
('CT', 'Connecticut', 'Y'),
('DC', 'District of Columbia', 'Y'),
('DE', 'Delaware', 'Y'),
('FL', 'Florida', 'Y'),
('GA', 'Georgia', 'Y'),
('HI', 'Hawaii', 'Y'),
('IA', 'Iowa', 'Y'),
('ID', 'Idaho', 'Y'),
('IL', 'Illinois', 'Y'),
('IN', 'Indiana', 'Y'),
('KS', 'Kansas', 'Y'),
('KY', 'Kentucky', 'Y'),
('LA', 'Louisiana', 'Y'),
('MA', 'Massachusetts', 'Y'),
('MD', 'Maryland', 'Y'),
('ME', 'Maine', 'Y'),
('MI', 'Michigan', 'Y'),
('MN', 'Minnesota', 'Y'),
('MO', 'Missouri', 'Y'),
('MS', 'Mississippi', 'Y'),
('MT', 'Montana', 'Y'),
('NC', 'North Carolina', 'Y'),
('ND', 'North Dakota', 'Y'),
('NE', 'Nebraska', 'Y'),
('NH', 'New Hampshire', 'Y'),
('NJ', 'New Jersey', 'Y'),
('NM', 'New Mexico', 'Y'),
('NV', 'Nevada', 'Y'),
('NY', 'New York', 'Y'),
('OH', 'Ohio', 'Y'),
('OK', 'Oklahoma', 'Y'),
('OR', 'Oregon', 'Y'),
('PA', 'Pennsylvania', 'Y'),
('PR', 'Puerto Rico', 'Y'),
('RI', 'Rhode Island', 'Y'),
('SC', 'South Carolina', 'Y'),
('SD', 'South Dakota', 'Y'),
('TN', 'Tennessee', 'Y'),
('TX', 'Texas', 'Y'),
('UT', 'Utah', 'Y'),
('VA', 'Virginia', 'Y'),
('VT', 'Vermont', 'Y'),
('WA', 'Washington', 'Y'),
('WI', 'Wisconsin', 'Y'),
('WV', 'West Virginia', 'Y'),
('WY', 'Wyoming', 'Y');

\. load-images.sql
