# im663 Stream Site
A front-end for streaming services.

1. `composer require "twig/twig:^3.0"`

2. `sudo mysql_secure_installation`

3. `sudo mysql < install.sql`

4. `sudo mysql` \
	`create user "user"@"localhost" identified by "Pass";`\
	`grant all privileges on defstream.* to "user"@"localhost";`\
	`flush privileges;`\
	`quit`
