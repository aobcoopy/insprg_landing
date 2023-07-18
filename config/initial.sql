


INSERT INTO groups(id,name,created,updated,role) VALUES(
	DEFAULT,
	'Administrator',
	NOW(),
	NOW(),
	NULL
);

INSERT INTO contacts(id,title,name,surname,dob,gender,email,phone,mobile,joined,created,updated,status,website,skype,facebook,citizen_id,avatar,nickname) VALUES(
	1,
	'Mr.',
	'',
	'',
	'0000-00-00',
	'male',
	'',
	'',
	'',
	NOW(),
	NOW(),
	NOW(),
	1,
	NULL,
	NULL,
	NULL,
	NULL,
	NULL,
	''
);

INSERT INTO address(id,address,states,country,city,district,subdistrict,postal,created,updated,contact,organization,priority,latitude,longitude,altitude) VALUES(
	1,
	'',
	NULL,
	218, 1, 1, 1,
	'',
	NOW(),
	NOW(),
	1,
	NULL,
	1,
	0,
	0,
	0
);


INSERT INTO users(id,name,password,status,created,updated,validated,last_login,gid,contact,setting) VALUES(
	1,
	'admin',
	PASSWORD('admin'),
	1,
	NOW(),
	NOW(),
	NOW(),
	NULL,
	1,
	1,
	'[]'
);

	
