create table if not exists domains
(
	id bigint unsigned auto_increment
		primary key,
	title varchar(255) not null,
	code enum('memory', 'reasoning', 'speed', 'attention') not null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint domains_code_unique
		unique (code),
	constraint domains_title_unique
		unique (title)
)
collate=utf8mb4_unicode_ci;

create table if not exists assessments
(
	id bigint unsigned auto_increment
		primary key,
	title varchar(255) not null,
	description text null,
	domain_id bigint unsigned not null,
	score int null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint ad_domain_id
		foreign key (domain_id) references domains (id)
			on delete cascade
)
collate=utf8mb4_unicode_ci;

create table if not exists exercises
(
	id bigint unsigned auto_increment
		primary key,
	title varchar(255) not null,
	description text null,
	memory_weight int default 0 not null,
	reasoning_weight int default 0 not null,
	speed_weight int default 0 not null,
	attention_weight int default 0 not null,
	score int not null,
	created_at timestamp null,
	updated_at timestamp null
)
collate=utf8mb4_unicode_ci;

create table if not exists migrations
(
	id int unsigned auto_increment
		primary key,
	migration varchar(255) not null,
	batch int not null
)
collate=utf8mb4_unicode_ci;

create table if not exists session_exercises
(
	id bigint unsigned auto_increment
		primary key,
	session_id bigint unsigned not null,
	exercise_id bigint unsigned not null,
	is_completed tinyint(1) default 0 not null,
	created_at timestamp null,
	updated_at timestamp null
)
collate=utf8mb4_unicode_ci;

create table if not exists users
(
	id bigint unsigned auto_increment
		primary key,
	email varchar(255) not null,
	name varchar(255) not null,
	password varchar(255) not null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint users_email_unique
		unique (email),
	constraint users_name_unique
		unique (name)
)
collate=utf8mb4_unicode_ci;

create table if not exists plans
(
	id bigint unsigned auto_increment
		primary key,
	title varchar(255) not null,
	user_id bigint unsigned not null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint p_user_id
		foreign key (user_id) references users (id)
			on delete cascade
)
collate=utf8mb4_unicode_ci;

create table if not exists sessions
(
	id bigint unsigned auto_increment
		primary key,
	plan_id bigint unsigned not null,
	start_date timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
	created_at timestamp null,
	updated_at timestamp null,
	constraint s_plan_id
		foreign key (plan_id) references plans (id)
			on delete cascade
)
collate=utf8mb4_unicode_ci;

create table if not exists user_assessments
(
	id bigint unsigned auto_increment
		primary key,
	user_id bigint unsigned not null,
	assessment_id bigint unsigned not null,
	is_completed tinyint(1) default 0 null,
	start_date timestamp null,
	created_at timestamp null,
	updated_at timestamp null,
	constraint uassessment_uq
		unique (user_id, assessment_id),
	constraint ua_assessment_id
		foreign key (assessment_id) references assessments (id)
			on delete cascade,
	constraint ua_user_id
		foreign key (user_id) references users (id)
			on delete cascade
)
collate=utf8mb4_unicode_ci;

