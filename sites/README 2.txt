1. forked the repo
2. started MAMP with repo folder
3. imported DB from repo
4. apache port is 8888 my sql port is 8889
5. still getting a PDOexception error

PDOException: SQLSTATE[HY000] [1045] Access denied for user 'cameron'@'localhost' (using password: YES) in lock_may_be_available() (line 167 of /Users/benjamincasalino/Desktop/cameron_bakery/includes/lock.inc).

6. tried fixing errors in module, maybe that was the reason for the error?
7. made a new user with all privs named u:cameron/p:cameron
